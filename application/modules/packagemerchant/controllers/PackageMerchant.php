<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PackageMerchant extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    //jika tidak ada session,lempar ke auth
    // is_logged_in();
    date_default_timezone_set('Asia/Jakarta');
    $this->load->model('PackageMerchant_model', 'packageModel');
    $this->load->model('merchant/Merchant_model', 'merchantModel');
  }

  public function index()
  {
    $data['title'] = 'Package Merchant';

    $data['data_packagemerchant'] = $this->packageModel->getDataPackageMerchant()->result_array();
    $data['data_merchant'] = $this->merchantModel->getDataMerchants()->result_array();

    $this->load->view('templates/header/header', $data);
    $this->load->view('packagemerchant/packagemerchant', $data);
    $this->load->view('templates/footer/footer', $data);
  }

  public function addPage()
  {
    $data['title'] = 'Package Merchant';

    $data['data_merchant'] = $this->merchantModel->getDataMerchants()->result_array();
    $this->load->view('templates/header/header', $data);
    $this->load->view('packagemerchant/addpage', $data);
    $this->load->view('templates/footer/footer', $data);
  }

  public function add()
  {
    $nama_merchant = htmlspecialchars($this->input->post('nama_merchant'));
    $nama_service = $this->input->post('nama_service');
    $harga_paket_service = htmlspecialchars($this->input->post('harga_paket_service'));

    $hitung_jml_service = count($nama_service);
    for ($i = 0; $i < $hitung_jml_service; $i++) {
      $data = [
        'id_merchant' => $nama_merchant,
        'nama_service' => $nama_service[$i],
        'delete_sts' => 0,
        'created_at' => date('Y-m-d H:i:s')
      ];
      $insert = $this->packageModel->insertDataMerchant($data);
    }

    $data_update = [
      'total_harga_package_merchant' => (int)$harga_paket_service
    ];

    $this->merchantModel->updateDataMerchant($nama_merchant, $data_update);

    $this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">
    <strong>Data Berhasil di Tambah!</strong></div>');
    redirect('packagemerchant');
  }

  public function delete_data()
  {
    $id_merchant = htmlspecialchars($this->input->post('id_merchant'));

    $data = [
      'delete_sts' => 1,
      'updated_at' => date('Y-m-d H:i:s')
    ];

    $qryUpdate = $this->packageModel->updateDataPackageService($id_merchant, $data);

    $status = "OK";
    $message = "Berhasil Menghapus Data!";
    $log = "";

    $response = array(
      "status" => $status,
      "message" => $message,
      "log" => $log
    );
    echo json_encode($response);
  }

  public function detailPackageMerchant($id_merchant)
  {
    $data['title'] = 'Detail Package Merchant';

    $data['data_packagemerchant'] = $this->packageModel->getDataPackageMerchantById($id_merchant)->result_array();
    $data['data_merchant'] = $this->merchantModel->getDataMerchantById($id_merchant)->row_array();

    $this->load->view('templates/header/header', $data);
    $this->load->view('packagemerchant/detailpackagemerchant', $data);
    $this->load->view('templates/footer/footer', $data);
  }
}
