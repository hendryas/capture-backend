<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Auth extends MX_Controller
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
    $this->load->library('Authorization_Token');

    // Configure limits on our controller methods
    // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
    $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
    $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
    $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
  }

  public function login_post()
  {
    $content_type = $this->input->server('HTTP_CONTENT_TYPE', true);
    $data = [];

    if (stripos($content_type, 'application/json') !== false) {
      // Pengolahan JSON
      $json_input = file_get_contents('php://input');
      $data = json_decode($json_input, true);
    } else {
      // Pengolahan form-data
      $data['email'] = $this->input->post('email');
      $data['password'] = $this->input->post('password');
    }

    // Set validation rules
    $this->form_validation->set_data($data);
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
    $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');

    if ($this->form_validation->run() == FALSE) {
      // Validation failed
      $this->response(['status' => false, 'error' => $this->form_validation->error_array()], 422);
    } else {
      // Validation passed, proceed with authentication
      $email = $data['email'];
      $password = $data['password'];

      $user = $this->userModel->getDataUserByEmail($email)->row_array();
      if ($user) {
        if (password_verify($password, $user['password'])) {
          $payload = [
            'id_user' => $user['id_user'],
            'email' => $user['email'],
            'id_role' => $user['id_role'],
            'nama' => $user['nama']
          ];
          $token = $this->authorization_token->generateToken($payload);
          $this->response(['status' => true, 'token' => $token], 200);
        } else {
          $this->response(['status' => false, 'error' => ['password' => 'Invalid password']], 422);
        }
      } else {
        $this->response(['status' => false, 'error' => ['email' => 'Invalid email']], 422);
      }
    }
  }


  public function register_post()
  {
    // Periksa tipe konten permintaan
    $content_type = $this->input->server('HTTP_CONTENT_TYPE', true);

    // Inisialisasi data
    $data = [];

    if (stripos($content_type, 'application/json') !== false) {
      // Pengolahan JSON
      $json_input = file_get_contents('php://input');
      $data = json_decode($json_input, true);
    } else {
      // Pengolahan form-data
      $data['nama'] = $this->input->post('nama');
      $data['email'] = $this->input->post('email');
      $data['password'] = $this->input->post('password');
      $data['confirm_password'] = $this->input->post('confirm_password');
    }

    // Set validation rules
    $this->form_validation->set_data($data);
    $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
    $this->form_validation->set_rules('email', 'Email', 'required|trim|is_unique[user.email]|valid_email');
    $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[8]|matches[confirm_password]');
    $this->form_validation->set_rules('confirm_password', 'Password', 'required|trim|matches[password]');

    if ($this->form_validation->run() == FALSE) {
      // Validation failed
      $this->response(['status' => false, 'error' => $this->form_validation->error_array()], 422);
    } else {
      // Validation passed, proceed with registration
      $cekEmail = $this->userModel->cekEmailAuth($data['email'])->result();
      $isEmail = count($cekEmail);

      if ($isEmail > 0) {
        $this->response(['status' => false, 'error' => ['email' => 'Email sudah pernah dibuat!']], 422);
      } else {
        $password = password_hash($data['confirm_password'], PASSWORD_DEFAULT);

        $insertData = [
          'nama' => $data['nama'],
          'email' => $data['email'],
          'password' => $password,
          'id_role' => 3,
          'is_active' => 1,
          'delete_sts' => 0,
          'created_at' => date('Y-m-d H:i:s')
        ];

        $user = $this->userModel->insertDataRegister($insertData);

        $payload = [
          'id_user' => $user['id_user'],
          'email' => $user['email'],
          'id_role' => $user['id_role'],
          'nama' => $user['nama']
        ];
        $token = $this->authorization_token->generateToken($payload);
        $this->response([
          'status' => true,
          'message' => 'Berhasil Registrasi Akun', 'token' => $token,
        ], 200);
      }
    }
  }
}
