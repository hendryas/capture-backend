<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */

//To Solve File REST_Controller not found
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Register extends MX_Controller
{
  use REST_Controller {
    REST_Controller::__construct as private __resTraitConstruct;
  }

  public function __construct()
  {
    parent::__construct();
    $this->__resTraitConstruct();

    date_default_timezone_set('Asia/Jakarta');
    $this->load->model('register/Register_model', 'registerModel');

    $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
    $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
    $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
  }

  public function index_post()
  {
    $nama = $this->post('nama');
    $email = $this->post('email');
    $password = $this->post('password');
    $confirm_password = $this->post('confirm_password');

    $this->form_validation->set_rules('nama', 'Nama', 'required|trim', [
      'required' => 'Nama tidak boleh kosong.'
    ]);

    $this->form_validation->set_rules('email', 'Email', 'required|trim|is_unique[user.email]', [
      'required' => 'Email tidak boleh kosong.',
      'is_unique' => 'Email ini sudah terdaftar!'
    ]);

    $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[8]|matches[confirm_password]', [ //bener
      'matches' => 'Password tidak sama!',
      'min_length' => 'Password terlalu pendek!',
      'required' => 'Password tidak boleh kosong.',
    ]);

    $this->form_validation->set_rules('confirm_password', 'Password', 'required|trim|matches[password]', [ //bener
      'required' => 'Password tidak boleh kosong.',
      'matches' => 'Password tidak sama!',
    ]);

    $password = password_hash($confirm_password, PASSWORD_DEFAULT);

    $cekEmail = $this->registerModel->cekEmailAuth($email)->result();
    $isEmail = count($cekEmail);

    if ($isEmail > 0) {
      $this->response([
        'status' => false,
        'message' => 'Email sudah pernah dibuat!'
      ], 404);
    } else {
      $data = [
        'nama' => $nama,
        'email' => $email,
        'password' => $password,
        'id_role' => 3,
        'is_active' => 1,
        'delete_sts' => 0,
        'created_at' => date('Y-m-d H:i:s')
      ];
      $this->registerModel->insertDataRegister($data);
      $this->response([
        'status' => true,
        'message' => 'Berhasil Registrasi Akun'
      ], 200);
    }
  }
}
