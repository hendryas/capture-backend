<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */

//To Solve File REST_Controller not found
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class HistoryPayment extends MX_Controller
{

  use REST_Controller {
    REST_Controller::__construct as private __resTraitConstruct;
  }

  private $authentication;

  public function __construct()
  {
    parent::__construct();
    $this->__resTraitConstruct();

    date_default_timezone_set('Asia/Jakarta');
    $this->load->model('user/User_model', 'userModel');
    $this->load->model('payment/Payment_model', 'paymentModel');
    $this->authentication = new AuthenticationJWT($this);
    $this->authentication->authenticateUser(); // Call here If authentication is required for all endpoints
  }

  public function index_get()
  {
    $id = $this->userData['id_user'];
    $list_history_payment = $this->paymentModel->getDatahistoryPaymentByIdUser($id)->result_array();

    if ($list_history_payment) {
      $this->response([
        'message' => 'Data Berhasil Diambil!',
        'status' => true,
        'data' => $list_history_payment
      ], 200);
    } else {
      $this->response([
        'status' => false,
        'message' => 'Belum Ada History Payment'
      ], 404);
    }
  }
}
