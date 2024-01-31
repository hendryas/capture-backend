<?php

use Midtrans\Notification;
use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';
// my code goes here
class Midtrans extends MX_Controller
{
    use REST_Controller {
        REST_Controller::__construct as private __resTraitConstruct;
    }

    private $midtrans;
    private $authentication;

    public function __construct()
    {
        parent::__construct();
        $this->__resTraitConstruct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('user/User_model', 'userModel');
        $this->load->model('merchant/Merchant_model', 'merchantModel');
        $this->load->model('payment/Payment_model', 'paymentModel');
        $this->load->model('notification/Notification_model', 'notificationModel');
        $this->authentication = new AuthenticationJWT($this);
        $this->midtrans = new MyMidtrans();
    }

    public function create_post()
    {
        $this->authentication->authenticateUser();

        // Periksa tipe konten permintaan
        $content_type = $this->input->server('HTTP_CONTENT_TYPE', true);

        // Inisialisasi data
        $data = [];

        if (stripos($content_type, 'application/json') !== false) {
            // Pengolahan JSON
            $json_input = file_get_contents('php://input');
            $data = json_decode($json_input, true);
        } else {
            // Pengolahan form-data
            $data['merchant_id'] = $this->input->post('merchant_id');
        }

        $this->form_validation->set_data($data);
        $this->form_validation->set_rules('merchant_id', 'Merchant ID', 'required|trim');

        $merchant = $this->merchantModel->getDataMerchantById($data['merchant_id'])->row_array();
        // Validate input data
        if ($this->form_validation->run() == FALSE) {
            $this->response(['status' => false, 'error' => $this->form_validation->error_array()], 422);
        } elseif ($merchant == null) {
            $this->response(['status' => false, 'error' => array(
                "merchant_id" => 'merchant tidak ditemukan'
            )], 422);
        } else {

            // Lakukan proses pembuatan transaksi di sini
            $no_order = date('YmdHis') . strtoupper(random_string('alnum', 8));

            // $enable_payments = array('shopee');

            $payload = array(
                // 'enabled_payments' => $enable_payments,
                "transaction_details" => array(
                    "order_id" =>  $no_order,
                    "gross_amount" => (int) $merchant['total_harga_package_merchant'],
                    "currency" => "IDR",
                ),
                "customer_details" => array(
                    "first_name" => $this->userData['nama'],
                    "email" =>  $this->userData['email'],
                    "phone" => $this->userData['phone'],
                ),
            );

            $token = $this->midtrans->createTransaction($payload);

            if ($token) {
                $data = null;
                $dataTransaction = [
                    'id_merchant' => $merchant['id_merchant'],
                    'id_user' => $this->userData['id_user'],
                    'no_order' => $no_order,
                    'tgl_order' => date('Y-m-d H:i:s'),
                    'total_bayar' => $merchant['total_harga_package_merchant'],
                    'status_pembayaran' => 'waiting',
                    'token' => $token,
                    'delete_sts' => 0,
                    'created_at' => date('Y-m-d H:i:s'),
                ];
                $insertTransaction = $this->paymentModel->insertDataPayment($dataTransaction);

                $dataNotificationCustomer = [
                    'id_user' => $this->userData['id_user'],
                    'id_merchant' => $merchant['id_merchant'],
                    'name_user' => $this->userData['nama'],
                    'fill_notification' => 'Pembelian berhasil, segera melakukan pembayaran!',
                    'sts_notif' => 0,
                    'delete_sts' => 0,
                    'created_at' => date('Y-m-d H:i:s')
                ];
                $insertNotificationCustomer = $this->notificationModel->insertDataNotificationCustomer($dataNotificationCustomer);

                $nama_merchant = $merchant['nama_merchant'];
                $dataNotificationAdmin = [
                    'id_user' => $this->userData['id_user'],
                    'id_merchant' => $merchant['id_merchant'],
                    'name_user' => $this->userData['nama'],
                    'fill_notification' => "Nomor Order : ' .$no_order.' Melakukan Pembelian Paket Pada Merchant ' . $nama_merchant . ' !",
                    'sts_notif' => 0,
                    'delete_sts' => 0,
                    'created_at' => date('Y-m-d H:i:s')
                ];
                $insertNotificationAdmin = $this->notificationModel->insertDataNotificationAdmin($dataNotificationAdmin);

                unset($dataTransaction['token']);
                $data = array_merge($data, $dataTransaction);
                // If success
                $this->response([
                    'message' => 'Berhasil membuat transaction',
                    'status' => true,
                    'data' => $data,
                ], 200);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Gagal membuat token'
                ], 500);
            }
        }
    }

    public function callback_post()
    {
        $content_type = $this->input->server('HTTP_CONTENT_TYPE', true);
        $data = [];
        if (stripos($content_type, 'application/json') !== false) {
            $json_input = file_get_contents('php://input');
            $data = json_decode($json_input, true);
        } else {
            // Pengolahan form-data
            $data['transactionStatus'] = $this->input->post('transactionStatus');
            $data['transactionId'] = $this->input->post('transactionId');
            $data['orderId'] = $this->input->post('orderId');
            $data['paymentType'] = $this->input->post('paymentType');
        }
        // TODO : lakukkan apa yang harus kamu lakukan
        $no_order = isset($data['orderId']) ? $data['orderId'] : '';
        $dataTransaction = [
            'status_pembayaran' => $data['transactionStatus'],
            'payment_type' => $data['paymentType'],
            'transactionId' => $data['transactionId']
        ];
        $transaction = $this->paymentModel->getData($no_order)->row_array();
        if ($transaction) {
            $updateDataTransaction = $this->paymentModel->updateDataTransaction($no_order, $dataTransaction);
            $transaction = $this->paymentModel->getData($no_order)->row_array();

            $getDataHistoryPaymentCustomer = $this->paymentModel->getDataHistoryPaymentCustomerByNoOrder($no_order)->row_array();
            $id_merchant = $getDataHistoryPaymentCustomer['id_merchant'];
            $id_user = $getDataHistoryPaymentCustomer['id_user'];

            if ($data['transactionStatus'] == 'settlement') {
                $fill_notification = 'Terimakasih sudah melakukan pembayaran, silahkan tunggu kami menghubungi anda';
            }
            if ($data['transactionStatus'] == 'pending') {
                $fill_notification = 'Pembayaran anda sedang dalam proses, silahkan tunggu kami menghubungi anda';
            }
            $dataNotificationCustomer = [
                'id_user' => $id_user,
                'id_merchant' => $id_merchant,
                'fill_notification' => $fill_notification,
                'sts_notif' => 0,
                'delete_sts' => 0,
                'created_at' => date('Y-m-d H:i:s')
            ];
            $insertNotificationCustomer = $this->notificationModel->insertDataNotificationCustomer($dataNotificationCustomer);

            $dataNotificationAdmin = [
                'id_user' => $id_user,
                'id_merchant' => $id_merchant,
                'fill_notification' => "Nomor Order : ' .$no_order.' Telah Melakukan Pembayaran !",
                'sts_notif' => 0,
                'delete_sts' => 0,
                'created_at' => date('Y-m-d H:i:s')
            ];
            $insertNotificationAdmin = $this->notificationModel->insertDataNotificationAdmin($dataNotificationAdmin);

            $this->response([
                'message' => 'Berhasil update transaction dan membuat notifikasi customer',
                'status' => true,
                'data' => $transaction,
            ], 200);
        } else {
            $this->response([
                'message' => 'Gagal mendapatkan data',
                'status' => false,
            ], 404);
        }
    }

    /**
     * Use this if you want to use the notification_post method, and set webhook in your midtrans account
     * 
     */
    /*
    public function notification_post()
    {
        $notif = $this->midtrans->notification();

        if ($notif) {
            $transaction = $notif->transaction_status;
            $type = $notif->payment_type;
            $order_id = $notif->order_id;
            $fraud = $notif->fraud_status;

            if ($transaction == 'capture') {
                // For credit card transaction, we need to check whether transaction is challenge by FDS or not
                if ($type == 'credit_card') {
                    if ($fraud == 'challenge') {
                        // TODO set payment status in merchant's database to 'Challenge by FDS'
                        // TODO merchant should decide whether this transaction is authorized or not in MAP
                        echo "Transaction order_id: " . $order_id . " is challenged by FDS";
                    } else {
                        // TODO set payment status in merchant's database to 'Success'
                        echo "Transaction order_id: " . $order_id . " successfully captured using " . $type;
                    }
                }
            } else if ($transaction == 'settlement') {
                // TODO set payment status in merchant's database to 'Settlement'
                echo "Transaction order_id: " . $order_id . " successfully transfered using " . $type;
            } else if ($transaction == 'pending') {
                // TODO set payment status in merchant's database to 'Pending'
                echo "Waiting customer to finish transaction order_id: " . $order_id . " using " . $type;
            } else if ($transaction == 'deny') {
                // TODO set payment status in merchant's database to 'Denied'
                echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is denied.";
            } else if ($transaction == 'expire') {
                // TODO set payment status in merchant's database to 'expire'
                echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is expired.";
            } else if ($transaction == 'cancel') {
                // TODO set payment status in merchant's database to 'Denied'
                echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is canceled.";
            }
        } else {
            $this->response([
                'status' => false,
                'message' => 'Gagal membuat token'
            ], 500);
        }
    }
    */
}
