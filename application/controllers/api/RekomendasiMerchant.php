<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class RekomendasiMerchant extends MX_Controller
{
  use REST_Controller {
    REST_Controller::__construct as private __resTraitConstruct;
  }

  function __construct()
  {
    // Construct the parent class
    parent::__construct();
    $this->__resTraitConstruct();

    date_default_timezone_set('Asia/Jakarta');
    $this->load->model('merchant/Merchant_model', 'merchantModel');
    $this->load->model('packagemerchant/PackageMerchant_model', 'packageModel');

    // Configure limits on our controller methods
    // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
    $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
    $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
    $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
  }

  public function index_get()
  {
    $id = $this->get('id');
    $package_merchant = "";
    if ($id === null) {
      $merchant = $this->merchantModel->getDataRekomendasiMerchant()->result_array();
    } else {
      $merchant = $this->merchantModel->getDataMerchantById($id)->row_array();
      $package_merchant = $this->packageModel->getDataPackageMerchantById($id)->result_array();
    }

    if ($package_merchant) {
      $data = [
        'data_merchant' => $merchant,
        'data_packagemerchant' => $package_merchant,
      ];
    } else {
      $data = [
        'data_merchant' => $merchant
      ];
    }

    if ($package_merchant) {
      if ($merchant) {
        $this->response([
          'status' => true,
          'data' => $data
        ], 200);
      } else {
        $this->response([
          'status' => false,
          'message' => 'id tidak ditemukan'
        ], 404);
      }
    } else {
      if ($merchant) {
        $this->response([
          'status' => true,
          'data' => $data
        ], 200);
      } else {
        $this->response([
          'status' => false,
          'message' => 'id tidak ditemukan'
        ], 404);
      }
    }
  }
}
