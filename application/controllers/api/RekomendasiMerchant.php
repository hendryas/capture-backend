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
    $page = $this->input->get('page') ? $this->input->get('page') : 1;
    $limit = 20; // Jumlah data per halaman

    $offset = ($page - 1) * $limit;

    $merchants = $this->merchantModel->getDataRekomendasiMerchant($limit, $offset)->result_array();
    $total_rows = count($merchants);

    $total_pages = ceil($total_rows / $limit);

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
