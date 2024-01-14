<?php
defined('BASEPATH') or exit('No direct script access allowed');
class PackageMerchant_model extends CI_Model
{
  public function getDataPackageMerchant()
  {
    $this->db->select('a.*');
    $this->db->where('delete_sts', 0);
    $this->db->from('packagemerchant a');

    $query = $this->db->get();
    return $query;
  }

  public function insertDataMerchant($data)
  {
    $this->db->insert('packagemerchant', $data);

    $insert = $this->db->affected_rows();

    if ($insert == 1) {
      return TRUE;
    } else {
      return FALSE;
    }
  }

  public function updateDataPackageService($id, $data)
  {
    $this->db->where('id_merchant', $id);
    $this->db->update('packagemerchant', $data);

    $update = $this->db->affected_rows();

    if ($update == 1) {
      return TRUE;
    } else {
      return FALSE;
    }
  }
}
