<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Category_model extends CI_Model
{
  public function getDataCategory()
  {
    $this->db->select('a.*');
    $this->db->where('delete_sts', 0);
    $this->db->from('kategori a');

    $query = $this->db->get();
    return $query;
  }

  public function insertDataCategory($data)
  {
    $this->db->insert('kategori', $data);

    $insert = $this->db->affected_rows();

    if ($insert == 1) {
      return TRUE;
    } else {
      return FALSE;
    }
  }

  public function updateDataCategory($id, $data)
  {
    $this->db->where('id_kategori', $id);
    $this->db->update('kategori', $data);

    $update = $this->db->affected_rows();

    if ($update == 1) {
      return TRUE;
    } else {
      return FALSE;
    }
  }
}
