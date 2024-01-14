<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */

//To Solve File REST_Controller not found
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Users extends MX_Controller
{
  use REST_Controller {
    REST_Controller::__construct as private __resTraitConstruct;
  }

  public function __construct()
  {
    parent::__construct();
    $this->__resTraitConstruct();

    date_default_timezone_set('Asia/Jakarta');
    $this->load->model('user/User_model', 'userModel');

    $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
    $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
    $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
  }

  public function index_get()
  {
    $id = $this->get('id');
    if ($id === null) {
      $user = $this->userModel->getDataUser()->result_array();
    } else {
      $user = $this->userModel->getDataUserById($id)->row_array();
    }

    if ($user) {
      $this->response([
        'status' => true,
        'data' => $user
      ], 200);
    } else {
      $this->response([
        'status' => false,
        'message' => 'id tidak ditemukan'
      ], 404);
    }
  }

  public function index_put()
  {
    $id = $this->get('id');

    $nama = htmlspecialchars($this->input->post('nama'));
    $username = htmlspecialchars($this->input->post('username'));
    $email = htmlspecialchars($this->input->post('email'));
    $phone = htmlspecialchars($this->input->post('phone'));
    $password = htmlspecialchars($this->input->post('password'));
    $updated_at = date('Y-m-d H:i:s');

    if ($password != '' || $password != null) {
      $password_hash = password_hash($password, PASSWORD_DEFAULT);
      $data = [
        'nama' => $nama,
        'username' => $username,
        'email' => $email,
        'password' => $password_hash,
        'phone' => $phone,
        'updated_at' => $updated_at
      ];
    } else {
      $data = [
        'nama' => $nama,
        'username' => $username,
        'email' => $email,
        'phone' => $phone,
        'updated_at' => $updated_at
      ];
    }
    var_dump($data);
    die;
  }
}
