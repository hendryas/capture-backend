<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
  public function index()
  {
    $data['title'] = 'User';

    $this->load->view('templates/header/header', $data);
    $this->load->view('user/user', $data);
    $this->load->view('templates/footer/footer', $data);
  }
}
