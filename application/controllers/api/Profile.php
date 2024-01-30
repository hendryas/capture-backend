<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */

//To Solve File REST_Controller not found
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Profile extends MX_Controller
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

        $this->authentication = new AuthenticationJWT($this);
        $this->authentication->authenticateUser(); // Call here If authentication is required for all endpoints
    }

    public function index_get()
    {
        $user = $this->userModel->getDataUserById($this->userData['id_user'])->row_array();
        unset($user['password']);
        $this->response($user, 200);
    }

    public function index_post()
    {
        // Periksa tipe konten permintaan
        $content_type = $this->input->server('HTTP_CONTENT_TYPE', true);

        // Inisialisasi data
        $data = [];

        if (stripos($content_type, 'application/json') !== false) {
            // Pengolahan JSON
            $json_input = file_get_contents('php://input');
            $data = json_decode($json_input, true);
        } else {
            // Pengolahan form-data
            $data['nama'] = $this->input->post('nama');
            $data['username'] = $this->input->post('username');
            $data['email'] = $this->input->post('email');
            $data['phone'] = $this->input->post('phone');
            $data['password'] = $this->input->post('password');
            $data['updated_at'] = date('Y-m-d H:i:s');
            $data['foto_user'] = isset($_FILES['foto_user']) ? $_FILES['foto_user']['name'] : '';
        }

        // Set validation rules
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('phone', 'Phone', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'trim|min_length[6]');
        // $this->form_validation->set_rules('foto_user', 'Foto User', 'callback_check_upload');

        // Validate input data
        if ($this->form_validation->run() == FALSE) {
            $this->response(['status' => false, 'error' => $this->form_validation->error_array()], 422);
        } else {
            // Image Save
            $his = date("His");
            $thbl = date("Ymd");

            $foto_user = isset($_FILES['foto_user']) ? $_FILES['foto_user']['name'] : '';
            if (!empty($foto_user)) {
                $file_name1 = 'user' . '_' . $thbl . '-' . $his;
                $config1['upload_path']          = './assets/images/uplouds/';
                $config1['allowed_types']        = 'jpg|png|jpeg';
                $config1['max_size']             = 3023;
                $config1['remove_space']         = TRUE;
                $config1['file_name']            = $file_name1;

                $this->load->library('upload', $config1);

                if ($this->upload->do_upload('foto_user')) {
                    $data['foto_user'] = $this->upload->data('file_name');
                } else {
                    $this->response(['status' => false, 'error' => $this->upload->display_errors()], 422);
                }
            } else {
                $data['foto_user'] = $this->userData['foto_user'];
            }

            if (!empty($data['password'])) {
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            } else {
                unset($data['password']);
            }
            
            $update = $this->userModel->updateDataUserById($this->userData['id_user'], $data);
            if ($update) {
                $cek = $this->userModel->getDataUserById($this->userData['id_user'])->row_array();
                unset($cek['password']);
                $this->response([
                    'status' => true,
                    'message' => 'Berhasil update profile!',
                    'data' => $cek
                ], 200);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Gagal update profile'
                ], 500);
            }
        }
    }
}
