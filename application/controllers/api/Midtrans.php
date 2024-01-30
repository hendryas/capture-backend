<?php

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

            $payload = array(
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
                // TODO : Create Transaction - Save Database
                $data = null;
                $dataTransaction = [
                    'id_merchant' => $merchant['id_merchant'],
                    'id_user' => $this->userData['id_user'],
                    'no_order' => $no_order,
                    'tgl_order' => date('Y-m-d H:i:s'),
                    'total_bayar' => $merchant['total_harga_package_merchant'],
                    'status_pembayaran' => 1,
                    'token' => $token,
                    'delete_sts' => 0,
                    'created_at' => date('Y-m-d H:i:s'),
                ];
                $insertTransaction = $this->paymentModel->insertDataPayment($dataTransaction);
                // $data = $this->transactionModel

                $data['token'] = $token;
                // If success
                $this->response([
                    'message' => 'Berhasil membuat transaction',
                    'status' => true,
                    'data' => $data,
                    'data_transaction' => $dataTransaction
                ], 200);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Gagal membuat token'
                ], 500);
            }
        }
    }
}
