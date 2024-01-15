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

  public function index_post()
  {
    $id = $this->post('id');

    $nama = $this->post('nama');
    $username = $this->post('username');
    $email = $this->post('email');
    $phone = $this->post('phone');
    $password =  $this->post('password');
    $updated_at = date('Y-m-d H:i:s');

    $foto_user = isset($_FILES['foto_user']) ? $_FILES['foto_user']['name'] : '';

    $his    = date("His");
    $thbl   = date("Ymd");

    if ($foto_user != null || $foto_user != "") {
      $foto_user = explode(".", $_FILES['foto_user']['name']);
      $ext = end($foto_user);
      $new_image = $_FILES['foto_user']['name'] = strtolower('foto_user' . '_' . $thbl . '-' . $his . '.' . $ext);
    }

    if ($foto_user != null || $foto_user != "") {
      $file_name1 = 'foto_user' . '_' . $thbl . '-' . $his;
      $config1['upload_path']          = './assets/images/uplouds/';
      $config1['allowed_types']        = 'jpg|png|jpeg';
      $config1['max_size']             = 3023;
      $config1['remove_space']         = TRUE;
      $config1['file_name']            = $file_name1;

      $this->load->library('upload', $config1);

      if ($this->upload->do_upload('foto_user')) {
        $this->upload->data();

        if ($password != '' || $password != null) {
          $password_hash = password_hash($password, PASSWORD_DEFAULT);
          $data = [
            'nama' => $nama,
            'username' => $username,
            'email' => $email,
            'password' => $password_hash,
            'phone' => $phone,
            'foto_user' => $new_image,
            'updated_at' => $updated_at
          ];
        } else {
          $data = [
            'nama' => $nama,
            'username' => $username,
            'email' => $email,
            'phone' => $phone,
            'foto_user' => $new_image,
            'updated_at' => $updated_at
          ];
        }

        $qryUpdate = $this->userModel->updateDataUserById($id, $data);

        if ($qryUpdate == 1) {
          $this->response([
            'status' => true,
            'message' => 'Berhasil update profile user!'
          ], 200);
        } else {
          $this->response([
            'status' => false,
            'message' => 'Query ubah data gagal!'
          ], 404);
        }
      } else {
        $this->response([
          'status' => false,
          'message' => 'Query ubah data gagal dan gagal insert gambar!'
        ], 404);
      }
    } else {
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

      $qryUpdate = $this->userModel->updateDataUserById($id, $data);

      if ($qryUpdate == 1) {
        $this->response([
          'status' => true,
          'message' => 'Berhasil update profile user!'
        ], 200);
      } else {
        $this->response([
          'status' => false,
          'message' => 'Query ubah data tanpa ubah password gagal!'
        ], 404);
      }
    }
  }
}
