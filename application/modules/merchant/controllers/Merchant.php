<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Merchant extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    //jika tidak ada session,lempar ke auth
    // is_logged_in();
    date_default_timezone_set('Asia/Jakarta');
    $this->load->model('Merchant_model', 'merchantModel');
    $this->load->model('category/Category_model', 'categoryModel');
  }

  public function index()
  {
    $data['title'] = 'Merchant';

    $data['data_categories'] = $this->categoryModel->getDataCategory()->result_array();
    $data['data_merchant'] = $this->merchantModel->getDataMerchants()->result_array();
    $this->load->view('templates/header/header', $data);
    $this->load->view('merchant/merchant', $data);
    $this->load->view('templates/footer/footer', $data);
  }

  public function insert_data()
  {
    $id_kategori = htmlspecialchars($this->input->post('id_kategori'));
    $nama_merchant = htmlspecialchars($this->input->post('nama_merchant'));
    $deskripsi = htmlspecialchars($this->input->post('deskripsi'));
    $link_youtube = htmlspecialchars($this->input->post('link_youtube'));
    $logo = $_FILES['logo']['name'];

    $his    = date("His");
    $thbl   = date("Ymd");

    $dname = explode(".", $_FILES['logo']['name']);
    $ext = end($dname);
    $new_image = $_FILES['logo']['name'] = strtolower('logo' . '_' . $thbl . '-' . $his . '.' . $ext);

    if ($logo != null) {
      $file_name1 = 'logo' . '_' . $thbl . '-' . $his;
      $config1['upload_path']          = './assets/images/logo/';
      $config1['allowed_types']        = 'jpg|png|jpeg';
      $config1['max_size']             = 3023;
      $config1['remove_space']         = TRUE;
      $config1['file_name']            = $file_name1;

      $this->load->library('upload', $config1);

      if ($this->upload->do_upload('logo')) {
        $this->upload->data();

        $data = [
          'id_kategori' => $id_kategori,
          'nama_merchant' => $nama_merchant,
          'logo' => $new_image,
          'deskripsi' => $deskripsi,
          'link_youtube' => $link_youtube,
          'delete_sts' => 0,
          'created_at	' => date('Y-m-d H:i:s'),
          'updated_at' => date('Y-m-d H:i:s')
        ];

        $qryInsert = $this->merchantModel->insertDataMerchant($data);

        if ($qryInsert == 1) {
          $status = "OK";
          $message = "Berhasil Tambah Data!";
          $log = "";
        } else {
          $status = "ERROR";
          $message = "Query Tambah Data Gagal!";
          $log = "";
        }
      } else {
        $status = "ERROR";
        $message = "Query Tambah Data Gagal & Gagal Insert Gambar!";
        $log = "";
      }
    } else {
      $status = "ERROR";
      $message = "Gambar Logo Kosong!";
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
    $id_kategori = htmlspecialchars($this->input->post('id_kategori'));
    $id_merchant = htmlspecialchars($this->input->post('id_merchant'));
    $nama_merchant = htmlspecialchars($this->input->post('nama_merchant'));
    $deskripsi = htmlspecialchars($this->input->post('deskripsi'));
    $link_youtube = htmlspecialchars($this->input->post('link_youtube'));
    $logo = isset($_FILES['logo']) ? $_FILES['logo']['name'] : "";

    $his    = date("His");
    $thbl   = date("Ymd");

    if ($logo == NULL || $logo == "") {
      $merchant_logo = $this->db->get_where('merchant', ['id_merchant' => $id_merchant])->row_array();
      $new_image = $merchant_logo['logo'];
    } else {
      $merchant_logo = $this->db->get_where('merchant', ['id_merchant' => $id_merchant])->row_array();
      $old_file = $merchant_logo['logo'];

      $dname = explode(".", $_FILES['logo']['name']);
      $ext = end($dname);
      $new_image = $_FILES['logo']['name'] = strtolower('logo' . '_' . $thbl . '-' . $his . '.' . $ext);
    }

    if ($logo != null) {
      $file_name1 = 'logo' . '_' . $thbl . '-' . $his;
      $config1['upload_path']          = './assets/images/logo/';
      $config1['allowed_types']        = 'jpg|png|jpeg';
      $config1['max_size']             = 3023;
      $config1['remove_space']         = TRUE;
      $config1['file_name']            = $file_name1;

      $this->load->library('upload', $config1);

      if ($this->upload->do_upload('logo')) {
        unlink(FCPATH . '/assets/images/logo/' . $old_file);
        $this->upload->data();

        $data = [
          'id_kategori' => $id_kategori,
          'nama_merchant' => $nama_merchant,
          'logo' => $new_image,
          'deskripsi' => $deskripsi,
          'link_youtube' => $link_youtube,
          'updated_at' => date('Y-m-d H:i:s')
        ];

        $qryUpdate = $this->merchantModel->updateDataMerchant($id_merchant, $data);

        if ($qryUpdate == 1) {
          $this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">
                    <strong>Berhasil Ubah Data!</strong></div>');
          redirect('merchant');
        } else {
          $this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">
          <strong>Query Ubah Data Gagal!</strong></div>');
          redirect('merchant');
        }
      } else {
        $this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">
                <strong>Query Tambah Data Gagal & Gagal Insert Gambar!</strong></div>');
        redirect('merchant');
      }
    } else {
      $data = [
        'id_kategori' => $id_kategori,
        'nama_merchant' => $nama_merchant,
        'logo' => $new_image,
        'deskripsi' => $deskripsi,
        'link_youtube' => $link_youtube,
        'updated_at' => date('Y-m-d H:i:s')
      ];

      $qryUpdate = $this->merchantModel->updateDataMerchant($id_merchant, $data);

      if ($qryUpdate == 1) {
        $this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">
                  <strong>Berhasil Ubah Data!</strong></div>');
        redirect('merchant');
      } else {
        $this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">
        <strong>Query Ubah Data Gagal!</strong></div>');
        redirect('merchant');
      }
    }
  }

  public function delete_data()
  {
    $id_merchant = htmlspecialchars($this->input->post('id_merchant'));

    $data = [
      'delete_sts' => 1,
    ];

    $qryUpdate = $this->merchantModel->updateDataMerchant($id_merchant, $data);

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

  public function rekomendasi_merchant()
  {
    $data['title'] = 'Rekomendasi Merchant';

    $data['data_merchant'] = $this->merchantModel->getDataMerchants()->result_array();
    $this->load->view('templates/header/header', $data);
    $this->load->view('merchant/rekomendasimerchant', $data);
    $this->load->view('templates/footer/footer', $data);
  }

  public function insert_rekomendasi_merchant()
  {
    $id_merchant = htmlspecialchars($this->input->post('id_merchant'));

    $data = [
      'sts_rekomendasi' => 1,
    ];

    $qry_insert = $this->merchantModel->insertRekomendasiMerchant($data, $id_merchant);

    if ($qry_insert == 1) {
      $status = "OK";
      $message = "Berhasil Ubah Status Rekomendasi!";
      $log = "";
    } else {
      $status = "ERROR";
      $message = "Query Ubah Status Data Gagal!";
      $log = "";
    }

    $response = array(
      "status" => $status,
      "message" => $message,
      "log" => $log
    );
    echo json_encode($response);
  }

  public function update_dont_rekomendasi_merchant()
  {
    $id_merchant = htmlspecialchars($this->input->post('id_merchant'));

    $data = [
      'sts_rekomendasi' => 0,
    ];

    $qry_insert = $this->merchantModel->insertRekomendasiMerchant($data, $id_merchant);

    if ($qry_insert == 1) {
      $status = "OK";
      $message = "Berhasil Ubah Status Rekomendasi!";
      $log = "";
    } else {
      $status = "ERROR";
      $message = "Query Ubah Status Data Gagal!";
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
