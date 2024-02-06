<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */

//To Solve File REST_Controller not found
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Notification extends MX_Controller
{

  use REST_Controller {
    REST_Controller::__construct as private __resTraitConstruct;
  }

  private $authentication;
  private static $paginationLimit = 20;

  public function __construct()
  {
    parent::__construct();
    $this->__resTraitConstruct();

    date_default_timezone_set('Asia/Jakarta');
    $this->load->model('user/User_model', 'userModel');
    $this->load->model('notification/Notification_model', 'notificationModel');
    $this->authentication = new AuthenticationJWT($this);
    $this->authentication->authenticateUser(); 
  }

  public function notification_customer_get()
  {
    $page = $this->input->get('page') ? $this->input->get('page') : 1;
    $id = $this->userData['id_user'];
    $offset = ($page - 1) * $this::$paginationLimit;
    $id = $this->userData['id_user'];
    $list_notification_customer = $this->notificationModel->getDataNotificationCustomerByIdUser($id, $this::$paginationLimit, $offset)->result_array();
    $total_rows = count($list_notification_customer);
    $total_pages = ceil($total_rows / $this::$paginationLimit);

    $this->response([
      'status' => true,
      'data' => $list_notification_customer,
      'pagination' => array(
        'total_pages' => $total_pages,
        'current_page' => $page,
        'total_rows' => $total_rows
      )
    ], 200);
  }

  public function notification_admin_get()
  {
    $list_notification_admin = $this->notificationModel->getDataNotificationAdmin()->result_array();

    if ($list_notification_admin) {
      $this->response([
        'message' => 'Data Berhasil Diambil!',
        'status' => true,
        'data' => $list_notification_admin
      ], 200);
    } else {
      $this->response([
        'status' => false,
        'message' => 'Belum Ada Notifikasi'
      ], 404);
    }
  }
}
