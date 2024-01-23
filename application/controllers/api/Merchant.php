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
          $limit = 20; // Jumlah data per halaman
          $offset = ($page - 1) * $limit;

          $merchant = $this->merchantModel->getDataMerchant($limit, $offset)->result_array();
          $total_rows = count($merchant);
          $total_pages = ceil($total_rows / $limit);

          if ($merchant) {
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
            $this->response([
              'status' => false,
              'message' => 'id tidak ditemukan'
            ], 404);
          }
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

  public function recomendation_get()
  {
    $headers = $this->input->request_headers();

    if (isset($headers['authorization'])) {
      $decodedToken = $this->authorization_token->validateToken($headers['authorization']);
      if ($decodedToken['status']) {

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
      } else {
        $this->response($decodedToken, 401);
      }
    } else {
      $this->response(['status' => false, 'message' => 'Authentication failed'], 401);
    }
  }
}
