<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Auth_model extends CI_Model
{
  public function getDataUserByEmail($email)
  {
    $this->db->select('user.*');
    $this->db->from('user');
    $this->db->where('email', $email);

    $result = $this->db->get();
    return $result;
  }
}
