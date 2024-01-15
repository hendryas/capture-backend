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
    // Set validation rules
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
    $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
    $email = $this->post('email');
    $password = $this->post('password');

    $user = $this->userModel->getDataUserByEmail($email)->row_array();

    if ($this->form_validation->run() == FALSE) {
      // Validation failed
      $this->response(['status' => false, 'error' => $this->form_validation->error_array()], 402);
    } else {
      // Validation passed, proceed with authentication
      $email = $this->input->post('email');
      $password = $this->input->post('password');
      
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
          $this->response(['status' => false, 'error' => ['email' => 'Invalid password']], 402);
        }
      } else {
        $this->response(['status' => false, 'error' => ['email' => 'Invalid email']], 402);
      }
    }
  }

  public function register_post(){
      // TODO : ..
  }


}
