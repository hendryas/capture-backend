<?php
defined('BASEPATH') or exit('No direct script access allowed');
class User_model extends CI_Model
{
  public function getAllDataUsers()
  {
    $this->db->select('a.*');
    $this->db->from('user a');

    $query = $this->db->get();
    return $query;
  }
  public function getDataUsers()
  {
    $this->db->select('a.*');
    $this->db->where('delete_sts', 0);
    $this->db->from('user a');

    $query = $this->db->get();
    return $query;
  }

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
  public function insertDataRegister($data)
  {
    $this->db->insert('user', $data);

    $insert = $this->db->affected_rows();

    if ($insert == 1) {
      $data = $this->getDataUserByEmail($data['email'])->row_array();
      return $data;
    } else {
      return FALSE;
    }
  }

  public function cekEmailAuth($email)
  {
    $this->db->select('a.*');
    $this->db->from('user a');
    $this->db->where('a.email', $email);

    $result = $this->db->get();
    return $result;
  }

  public function getDataUsersActive()
  {
    $this->db->select('a.*');
    $this->db->where('is_active', 1);
    $this->db->from('user a');

    $query = $this->db->get();
    return $query;
  }

  public function getDataUsersNotActive()
  {
    $this->db->select('a.*');
    $this->db->where('is_active', 2);
    $this->db->from('user a');

    $query = $this->db->get();
    return $query;
  }
}
