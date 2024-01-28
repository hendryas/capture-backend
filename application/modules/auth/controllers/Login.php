<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    //jika tidak ada session,lempar ke auth
    // is_logged_in();
    date_default_timezone_set('Asia/Jakarta');
    $this->load->model('Auth_model', 'authModel');
  }

  public function index()
  {
    $data['title'] = 'Login';

    $this->load->view('templates/header/header', $data);
    $this->load->view('auth/login', $data);
    $this->load->view('templates/footer/footer', $data);
  }

  public function signin()
  {
    $email = htmlspecialchars($this->input->post('email'));
    $password = htmlspecialchars($this->input->post('password'));

    $user = $this->authModel->getDataUserByEmail($email)->row_array();

    //Buat rules ketika login
    $this->form_validation->set_rules('email', 'email', 'required|trim', [
      'required' => 'E-mail tidak boleh kosong'
    ]);
    $this->form_validation->set_rules('password', 'Password', 'required|trim', [
      'required' => 'Password tidak boleh kosong'
    ]);

    if ($this->form_validation->run() == false) {
      redirect('auth/login');
    } else {
      // Jika usernya ada
      if ($user) {
        //jika usernya aktif
        if ($user['is_active'] == 1) {
          // cek password
          if (password_verify($password, $user['password'])) {
            // jika data benar
            $data = [
              'id' => $user['id_user'],
              'email' => $user['email'],
              'id_role' => $user['id_role'],
              'nama' => $user['nama'],
            ];
            $this->session->set_userdata($data);
            if ($user['id_role'] == 1) {
              redirect('dashboard');
            } elseif ($user['id_role'] == 2) {
              redirect('dashboard');
            } else {
              redirect('auth/login/notfound');
            }
          } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger text-center" role="alert">
              <strong>Password salah!</strong> Silahkan coba lagi.</div>');
            redirect('auth/login');
          }
        } else {
          $this->session->set_flashdata('message', '<div class="alert alert-danger text-center" role="alert">
            <strong>E-mail ini belum di aktivasi!</strong></div>');
          redirect('auth/login');
        }
      } else {
        $this->session->set_flashdata('message', '<div class="alert alert-danger text-center" role="alert">
          <strong>E-mail belum terdaftar!</strong></div>');
        redirect('auth/login');
      }
    }
  }

  public function notfound()
  {
    $data['title'] = 'Halaman Tidak ditemukan';

    $this->load->view('templates/header/header', $data);
    $this->load->view('auth/notfound', $data);
    $this->load->view('templates/footer/footer', $data);
  }

  public function logout()
  {
    $this->session->unset_userdata('id');
    $this->session->unset_userdata('email');
    $this->session->unset_userdata('id_role');
    $this->session->unset_userdata('nama');

    $status = "OK";
    $message = "Good Bye...";
    $log = "";

    $response = array(
      "status" => $status,
      "message" => $message,
      "log" => $log
    );
    echo json_encode($response);
  }
}
