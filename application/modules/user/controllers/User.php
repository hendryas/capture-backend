<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    //jika tidak ada session,lempar ke auth
    // is_logged_in();
    date_default_timezone_set('Asia/Jakarta');
    $this->load->model('User_model', 'userModel');
  }

  public function index()
  {
    $data['title'] = 'User';

    $data['data_user'] = $this->userModel->getDataUser()->result_array();
    $this->load->view('templates/header/header', $data);
    $this->load->view('user/user', $data);
    $this->load->view('templates/footer/footer', $data);
  }

  public function insert_data()
  {
    $nama = htmlspecialchars($this->input->post('nama'));
    $username = htmlspecialchars($this->input->post('username'));
    $email = htmlspecialchars($this->input->post('email'));
    $phone = htmlspecialchars($this->input->post('phone'));
    $tgl_lahir = htmlspecialchars($this->input->post('tgl_lahir'));
    $gender = htmlspecialchars($this->input->post('gender'));
    $role = htmlspecialchars($this->input->post('role'));
    $is_active = htmlspecialchars($this->input->post('is_active'));
    $password = htmlspecialchars($this->input->post('password'));
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    $created_at = date('Y-m-d H:i:s');
    $updated_at = date('Y-m-d H:i:s');

    $data = [
      'nama' => $nama,
      'username' => $username,
      'email' => $email,
      'password' => $password_hash,
      'phone' => $phone,
      'tgl_lahir' => $tgl_lahir,
      'gender' => $gender,
      'id_role' => $role,
      'is_active' => $is_active,
      'delete_sts' => 0,
      'created_at' => $created_at,
      'updated_at' => $updated_at
    ];

    $qryInsert = $this->userModel->insertData($data);

    if ($qryInsert == 1) {
      $status = "OK";
      $message = "Berhasil Tambah Data!";
      $log = "";
    } else {
      $status = "ERROR";
      $message = "Query Tambah Data Gagal!";
      $log = "";
    }

    $response = array(
      "status" => $status,
      "message" => $message,
      "log" => $log
    );
    echo json_encode($response);
  }

  public function edit_data()
  {
    $id_user =  htmlspecialchars($this->input->post('id_user'));
    $nama = htmlspecialchars($this->input->post('nama'));
    $username = htmlspecialchars($this->input->post('username'));
    $email = htmlspecialchars($this->input->post('email'));
    $phone = htmlspecialchars($this->input->post('phone'));
    $tgl_lahir = htmlspecialchars($this->input->post('tgl_lahir'));
    $gender = htmlspecialchars($this->input->post('gender'));
    $role = htmlspecialchars($this->input->post('role'));
    $is_active = htmlspecialchars($this->input->post('is_active'));
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
        'tgl_lahir' => $tgl_lahir,
        'gender' => $gender,
        'id_role' => $role,
        'is_active' => $is_active,
        'updated_at' => $updated_at
      ];
    } else {
      $data = [
        'nama' => $nama,
        'username' => $username,
        'email' => $email,
        'phone' => $phone,
        'tgl_lahir' => $tgl_lahir,
        'gender' => $gender,
        'id_role' => $role,
        'is_active' => $is_active,
        'updated_at' => $updated_at
      ];
    }

    $this->userModel->updateData($id_user, $data);

    $this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">
    <strong>Berhasil Edit Data!</strong></div>');
    redirect('user');
  }

  public function delete_data()
  {
    $id_user = htmlspecialchars($this->input->post('id_user'));

    $data = [
      'delete_sts' => 1,
    ];

    $qryUpdate = $this->userModel->updateDataUserById($id_user, $data);

    if ($qryUpdate == 1) {
      $status = "OK";
      $message = "Berhasil Menghapus Data!";
      $log = "";
    } else {
      $status = "ERROR";
      $message = "Query Menghapus Data Gagal!";
      $log = "";
    }

    $response = array(
      "status" => $status,
      "message" => $message,
      "log" => $log
    );
    echo json_encode($response);
  }
}
