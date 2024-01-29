<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */

//To Solve File REST_Controller not found
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Categories extends MX_Controller
{

  use REST_Controller {
    REST_Controller::__construct as private __resTraitConstruct;
  }

  private $authentication;

  public function __construct()
  {
    parent::__construct();
    $this->__resTraitConstruct();

    date_default_timezone_set('Asia/Jakarta');
    $this->load->model('category/Category_model', 'categoryModel');
    $this->load->model('user/User_model', 'userModel');
    $this->authentication = new AuthenticationJWT($this);
    $this->authentication->authenticateUser(); // Call here If authentication is required for all endpoints
  }

  public function index_get()
  {
    $id = $this->get('id');
    if ($id === null) {
      $categories = $this->categoryModel->getDataCategory()->result_array();
    } else {
      $categories = $this->categoryModel->getDataCategoryByMerchant($id)->result_array();
    }

    if ($categories) {
      $this->response([
        'status' => true,
        'data' => $categories
      ], 200);
    } else {
      $this->response([
        'status' => false,
        'message' => 'id tidak ditemukan'
      ], 404);
    }
  }
}
