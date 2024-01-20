<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Merchant_model extends CI_Model
{
  public function getDataMerchant()
  {
    $this->db->select('a.*');
    $this->db->where('delete_sts', 0);
    $this->db->from('merchant a');

    $query = $this->db->get();
    return $query;
  }

  public function insertDataMerchant($data)
  {
    $this->db->insert('merchant', $data);

    $insert = $this->db->affected_rows();

    if ($insert == 1) {
      return TRUE;
    } else {
      return FALSE;
    }
  }

  public function updateDataMerchant($id, $data)
  {
    $this->db->where('id_merchant', $id);
    $this->db->update('merchant', $data);

    $update = $this->db->affected_rows();

    if ($update == 1) {
      return TRUE;
    } else {
      return FALSE;
    }
  }

  public function searchDataMerchant($search)
  {
    $qry = "SELECT * FROM merchant WHERE nama_merchant LIKE '%$search%' and delete_sts = 0";
    $execute = $this->db->query($qry);
    $query = $execute;
    return $query;
  }

  public function getDataMerchantById($id)
  {
    $this->db->select('a.nama_merchant,a.logo,a.deskripsi,a.link_youtube,a.total_harga_package_merchant');
    $this->db->where('a.delete_sts', 0);
    $this->db->where('a.id_merchant', $id);
    $this->db->from('merchant a');

    $query = $this->db->get();
    return $query;
  }

  public function insertRekomendasiMerchant($data, $id)
  {
    $this->db->where('id_merchant', $id);
    $this->db->update('merchant', $data);

    $update = $this->db->affected_rows();

    if ($update == 1) {
      return TRUE;
    } else {
      return FALSE;
    }
  }

  public function getDataRekomendasiMerchant()
  {
    $this->db->select('a.*');
    $this->db->where('delete_sts', 0);
    $this->db->where('sts_rekomendasi', 1);
    $this->db->from('merchant a');

    $query = $this->db->get();
    return $query;
  }
}
