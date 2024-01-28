<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    //jika tidak ada session,lempar ke auth
    // is_logged_in();
    date_default_timezone_set('Asia/Jakarta');
    $this->load->model('merchant/Merchant_model', 'merchantModel');
    $this->load->model('packagemerchant/PackageMerchant_model', 'packageMerchantModel');
    $this->load->model('category/Category_model', 'categoryModel');
    $this->load->model('user/User_model', 'userModel');
  }
  public function index()
  {
    $data['title'] = 'Dashboard';

    $data['data_merchant'] = $this->merchantModel->getDataMerchants()->result();
    $data['data_categories'] = $this->categoryModel->getDataCategories()->result();
    $data['data_package_merchants'] = $this->packageMerchantModel->getDataPackageMerchants()->result_array();
    $data['data_users_active'] = $this->userModel->getDataUsersActive()->result_array();
    $data['data_users_not_active'] = $this->userModel->getDataUsersNotActive()->result_array();
    $data['data_all_users'] = $this->userModel->getAllDataUsers()->result();

    $this->load->view('templates/header/header', $data);
    $this->load->view('dashboard/dashboard', $data);
    $this->load->view('templates/footer/footer', $data);
  }
}
