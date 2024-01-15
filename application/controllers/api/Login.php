<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Login extends MX_Controller
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
    $this->load->model('user/User_model', 'userModel');

    // Configure limits on our controller methods
    // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
    $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
    $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
    $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
  }

  public function index_post()
  {
    $email = $this->post('email');
    $password = $this->post('password');

    $user = $this->userModel->getDataUserByEmail($email)->row_array();

    if ($user) {
      if ($user['is_active'] == 1) {
        if (password_verify($password, $user['password'])) {
          $data = [
            'id_user' => $user['id_user'],
            'email' => $user['email'],
            'id_role' => $user['id_role'],
            'nama' => $user['nama']
          ];
          $this->session->set_userdata($data);

          $this->response([
            'status' => true,
            'data' => $data
          ], 200);
        } else {
          $this->response([
            'status' => false,
            'message' => 'Password Salah!'
          ], 404);
        }
      } else {
        $this->response([
          'status' => false,
          'message' => 'E-mail ini belum di aktivasi!'
        ], 404);
      }
    } else {
      $this->response([
        'status' => false,
        'message' => 'E-mail belum terdaftar!'
      ], 404);
    }
  }
}
