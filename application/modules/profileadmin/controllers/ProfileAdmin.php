<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ProfileAdmin extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    //jika tidak ada session,lempar ke auth
    // is_logged_in();
    date_default_timezone_set('Asia/Jakarta');
    $this->load->model('ProfileAdmin_model', 'profileAdminModel');
    $this->load->model('user/User_model', 'userModel');
  }

  public function index()
  {
    $data['title'] = 'Profile';

    $email = $this->session->userdata('email');
    $data['data_user'] = $this->userModel->getDataUserByEmail($email)->row_array();

    $this->load->view('templates/header/header', $data);
    $this->load->view('profileadmin/profileadmin', $data);
    $this->load->view('templates/footer/footer', $data);
  }
}
