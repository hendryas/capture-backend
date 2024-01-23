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

  public function __construct()
  {
    parent::__construct();
    $this->__resTraitConstruct();

    date_default_timezone_set('Asia/Jakarta');
    $this->load->library('Authorization_Token');	
    $this->load->model('category/Category_model', 'categoryModel');

    $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
    $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
    $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
  }

  public function index_get()
  {
    $headers = $this->input->request_headers(); 
    
    if (isset($headers['authorization'])) {
      $decodedToken = $this->authorization_token->validateToken($headers['authorization']);
      if ($decodedToken['status']) {
        // Logic Start Here
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

        // Logic End
      } else {
          $this->response($decodedToken, 401);
      }
    } else {
      $this->response(['status' => false, 'message' => 'Authentication failed'], 401);
    }   
  }
}
