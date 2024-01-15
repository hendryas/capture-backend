<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Register_model extends CI_Model
{
  public function insertDataRegister($data)
  {
    $this->db->insert('user', $data);

    $insert = $this->db->affected_rows();

    if ($insert == 1) {
      return TRUE;
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
}
