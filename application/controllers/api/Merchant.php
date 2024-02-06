<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Merchant extends MX_Controller
{
  use REST_Controller {
    REST_Controller::__construct as private __resTraitConstruct;
  }

  private static $paginationLimit = 20;
  private $authentication;

  function __construct()
  {
    // Construct the parent class
    parent::__construct();
    $this->__resTraitConstruct();

    date_default_timezone_set('Asia/Jakarta');
    $this->load->library('Authorization_Token');
    $this->load->model('user/User_model', 'userModel');
    $this->load->model('merchant/Merchant_model', 'merchantModel');
    $this->load->model('packagemerchant/PackageMerchant_model', 'packageModel');
    $this->authentication = new AuthenticationJWT($this);
    $this->authentication->authenticateUser();
  }

  public function index_get()
  {
    $id = $this->get('id');
    if ($id === null) {
      // Get All merchants
      $page = $this->input->get('page') ? $this->input->get('page') : 1;
      $name = $this->input->get('name');
      $categoryId = $this->input->get('category_id');
      $offset = ($page - 1) * $this::$paginationLimit;

      $merchant = $this->merchantModel->getDataMerchant($this::$paginationLimit, $offset, $name, $categoryId)->result_array();
      $total_rows = count($merchant);
      $total_pages = ceil($total_rows / $this::$paginationLimit);

      $this->response([
        'status' => true,
        'message' => 'Data merchant berhasil didapatkan!',
        'data' => $merchant,
        'pagination' => array(
          'total_pages' => $total_pages,
          'current_page' => $page,
          'total_rows' => $total_rows
        )
      ], 200);
    } else {
      // Detail merchant
      $merchant = $this->merchantModel->getDataMerchantById($id)->row_array();
      $package_merchant = $this->packageModel->getDataPackageMerchantById($id)->result_array();
      if ($merchant) {
        $data = [
          'packagemerchant' => $package_merchant,
        ];
        $data = array_merge($merchant, $data);
        $this->response([
          'status' => true,
          'data' => $data
        ], 200);
      } else {
        $this->response([
          'status' => false,
          'message' => 'Data tidak ditemukan'
        ], 404);
      }
    }
  }

  public function recomendation_get()
  {
    $page = $this->input->get('page') ? $this->input->get('page') : 1;
    $offset = ($page - 1) * $this::$paginationLimit;

    $merchants = $this->merchantModel->getDataRekomendasiMerchant($this::$paginationLimit, $offset)->result_array();
    $total_rows = count($merchants);
    $total_pages = ceil($total_rows / $this::$paginationLimit);
    $this->response([
      'status' => true,
      'message' => 'Data rekomendasi merchant berhasil!',
      'data' => $merchants,
      'pagination' => array(
        'total_pages' => $total_pages,
        'current_page' => $page,
        'total_rows' => $total_rows
      )
    ], 200);
  }
}
