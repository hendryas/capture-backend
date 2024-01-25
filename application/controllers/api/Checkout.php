<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */

//To Solve File REST_Controller not found
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Checkout extends MX_Controller
{

  use REST_Controller {
    REST_Controller::__construct as private __resTraitConstruct;
  }

  public function __construct()
  {
    parent::__construct();
    $this->__resTraitConstruct();

    date_default_timezone_set('Asia/Jakarta');
    $this->load->library('Authorization_Token');
    $this->load->model('category/Category_model', 'categoryModel');
    $this->load->model('merchant/Merchant_model', 'merchantModel');
    $this->load->model('packagemerchant/PackageMerchant_model', 'packageModel');

    $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
    $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
    $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
  }

  public function index_get()
  {
    // Logic Start Here
    $id = $this->get('id');
    $merchant = $this->merchantModel->getDataMerchantById($id)->row_array();
    $package_merchant = $this->packageModel->getDataPackageMerchantById($id)->result_array();
    $no_order = date('Ymd') . strtoupper(random_string('alnum', 8));

    $data = array_merge($merchant, $package_merchant, $no_order);

    if ($merchant) {
      $this->response([
        'message' => 'data berhasil di dapatkan!',
        'status' => true,
        'data' => $data
      ], 200);
    } else {
      $this->response([
        'status' => false,
        'message' => 'id tidak ditemukan'
      ], 404);
    }

    // Logic End
  }
}
