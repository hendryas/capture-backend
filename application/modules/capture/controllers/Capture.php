<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Capture extends CI_Controller
{
  public function index()
  {
    $data['title'] = 'Dashboard';

    $this->load->view('templates/header/header', $data);
    $this->load->view('capture/capture', $data);
    $this->load->view('templates/footer/footer', $data);
  }
}
