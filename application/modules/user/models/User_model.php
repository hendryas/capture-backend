<?php
defined('BASEPATH') or exit('No direct script access allowed');
class User_model extends CI_Model
{
  public function getDataUser()
  {
    $this->db->select('a.*');
    $this->db->where('delete_sts', 0);
    $this->db->from('user a');

    $query = $this->db->get();
    return $query;
  }

  public function insertData($data)
  {
    $this->db->insert('user', $data);

    $insert = $this->db->affected_rows();

    if ($insert == 1) {
      return TRUE;
    } else {
      return FALSE;
    }
  }

  public function updateData($id, $data)
  {
    $this->db->where('id_user', $id);
    $this->db->update('user', $data);
  }

  public function getDataUserById($id)
  {
    $this->db->select('a.*');
    $this->db->where('a.id_user', $id);
    $this->db->where('delete_sts', 0);
    $this->db->from('user a');

    $query = $this->db->get();
    return $query;
  }

  public function updateDataUserById($id, $data)
  {
    $this->db->where('id_user', $id);
    $this->db->update('user', $data);

    $update = $this->db->affected_rows();

    if ($update == 1) {
      return TRUE;
    } else {
      return FALSE;
    }
  }

  public function getDataUserByEmail($email)
  {
    $this->db->select('a.*');
    $this->db->where('a.email', $email);
    $this->db->where('delete_sts', 0);
    $this->db->from('user a');

    $query = $this->db->get();
    return $query;
  }
}
