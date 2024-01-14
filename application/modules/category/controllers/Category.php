<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Category extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    //jika tidak ada session,lempar ke auth
    // is_logged_in();
    date_default_timezone_set('Asia/Jakarta');
    $this->load->model('Category_model', 'categoryModel');
  }

  public function index()
  {
    $data['title'] = 'Category';

    $data['data_category'] = $this->categoryModel->getDataCategory()->result_array();
    $this->load->view('templates/header/header', $data);
    $this->load->view('category/category', $data);
    $this->load->view('templates/footer/footer', $data);
  }

  public function insert_data()
  {
    $nama_kategori = htmlspecialchars($this->input->post('nama_kategori'));
    $logo = $_FILES['logo']['name'];

    $his    = date("His");
    $thbl   = date("Ymd");

    $dname = explode(".", $_FILES['logo']['name']);
    $ext = end($dname);
    $new_image = $_FILES['logo']['name'] = strtolower('logo_kategori' . '_' . $thbl . '-' . $his . '.' . $ext);

    if ($logo != null) {
      $file_name1 = 'logo_kategori' . '_' . $thbl . '-' . $his;
      $config1['upload_path']          = './assets/images/logo/';
      $config1['allowed_types']        = 'jpg|png|jpeg';
      $config1['max_size']             = 3023;
      $config1['remove_space']         = TRUE;
      $config1['file_name']            = $file_name1;

      $this->load->library('upload', $config1);

      if ($this->upload->do_upload('logo')) {
        $this->upload->data();

        $data = [
          'nama_kategori' => $nama_kategori,
          'logo' => $new_image,
          'delete_sts' => 0,
          'created_at	' => date('Y-m-d H:i:s'),
          'updated_at' => date('Y-m-d H:i:s')
        ];

        $qryInsert = $this->categoryModel->insertDataCategory($data);

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
    $nama_kategori = htmlspecialchars($this->input->post('nama_kategori'));
    $logo = isset($_FILES['logo']) ? $_FILES['logo']['name'] : "";

    $his    = date("His");
    $thbl   = date("Ymd");

    if ($logo == NULL || $logo == "") {
      $kategori_logo = $this->db->get_where('kategori', ['id_kategori' => $id_kategori])->row_array();
      $new_image = $kategori_logo['logo'];
    } else {
      $kategori_logo = $this->db->get_where('kategori', ['id_kategori' => $id_kategori])->row_array();
      $old_file = $kategori_logo['logo'];

      $dname = explode(".", $_FILES['logo']['name']);
      $ext = end($dname);
      $new_image = $_FILES['logo']['name'] = strtolower('logo_kategori' . '_' . $thbl . '-' . $his . '.' . $ext);
    }

    if ($logo != null) {
      $file_name1 = 'logo_kategori' . '_' . $thbl . '-' . $his;
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
          'nama_kategori' => $nama_kategori,
          'logo' => $new_image,
          'updated_at' => date('Y-m-d H:i:s')
        ];

        $qryUpdate = $this->categoryModel->updateDataCategory($id_kategori, $data);

        if ($qryUpdate == 1) {
          $this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">
                    <strong>Berhasil Ubah Data!</strong></div>');
          redirect('category');
        } else {
          $this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">
          <strong>Query Ubah Data Gagal!</strong></div>');
          redirect('category');
        }
      } else {
        $this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">
                <strong>Query Tambah Data Gagal & Gagal Insert Gambar!</strong></div>');
        redirect('category');
      }
    } else {
      $data = [
        'nama_kategori' => $nama_kategori,
        'logo' => $new_image,
        'updated_at' => date('Y-m-d H:i:s')
      ];

      $qryUpdate = $this->categoryModel->updateDataCategory($id_kategori, $data);

      if ($qryUpdate == 1) {
        $this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">
                  <strong>Berhasil Ubah Data!</strong></div>');
        redirect('category');
      } else {
        $this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">
        <strong>Query Ubah Data Gagal!</strong></div>');
        redirect('category');
      }
    }
  }

  public function delete_data()
  {
    $id_kategori = htmlspecialchars($this->input->post('id_kategori'));

    $data = [
      'delete_sts' => 1,
    ];

    $qryUpdate = $this->categoryModel->updateDataCategory($id_kategori, $data);

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
  // hei
}
