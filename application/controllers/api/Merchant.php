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

  function __construct()
  {
    // Construct the parent class
    parent::__construct();
    $this->__resTraitConstruct();

    date_default_timezone_set('Asia/Jakarta');
    $this->load->library('Authorization_Token');
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
    $headers = $this->input->request_headers();
    if (isset($headers['authorization'])) {
      $decodedToken = $this->authorization_token->validateToken($headers['authorization']);
      if ($decodedToken['status']) {
        //
        $id = $this->get('id');
        if ($id === null) {
          // Get All merchants
          $page = $this->input->get('page') ? $this->input->get('page') : 1;
          $name = $this->input->get('name');
          $offset = ($page - 1) * $this::$paginationLimit;

          $merchant = $this->merchantModel->getDataMerchant($this::$paginationLimit, $offset, $name)->result_array();
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
      } else {
        $this->response($decodedToken, 401);
      }
    } else {
      $this->response(['status' => false, 'message' => 'Authentication failed'], 401);
    }
  }

  public function recomendation_get()
  {
    $headers = $this->input->request_headers();

    if (isset($headers['authorization'])) {
      $decodedToken = $this->authorization_token->validateToken($headers['authorization']);
      if ($decodedToken['status']) {

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
      } else {
        $this->response($decodedToken, 401);
      }
    } else {
      $this->response(['status' => false, 'message' => 'Authentication failed'], 401);
    }
  }
}
