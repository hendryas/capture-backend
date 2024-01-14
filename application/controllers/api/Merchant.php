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

  function __construct()
  {
    // Construct the parent class
    parent::__construct();
    $this->__resTraitConstruct();

    date_default_timezone_set('Asia/Jakarta');
    $this->load->model('merchant/Merchant_model', 'merchantModel');

    // Configure limits on our controller methods
    // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
    $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
    $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
    $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
  }

  public function index_get()
  {
  }

  public function index_post()
  {
    $search_studio = $this->post('search_studio');
    $qry_merchant = $this->merchantModel->searchDataMerchant($search_studio)->result_array();

    if ($qry_merchant) {
      $this->response([
        'status' => true,
        'data' => $qry_merchant
      ], 200);
    } else {
      $this->response([
        'status' => false,
        'message' => 'data tidak ada!'
      ], 404);
    }
  }
}
