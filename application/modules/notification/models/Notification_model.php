<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Notification_model extends CI_Model
{
  public function insertDataNotificationCustomer($data)
  {
    $this->db->insert('customer_notification', $data);

    $insert = $this->db->affected_rows();

    if ($insert == 1) {
      return TRUE;
    } else {
      return FALSE;
    }
  }

  public function insertDataNotificationAdmin($data)
  {
    $this->db->insert('admin_notification', $data);

    $insert = $this->db->affected_rows();

    if ($insert == 1) {
      return TRUE;
    } else {
      return FALSE;
    }
  }

  public function getDataNotificationCustomerByIdUser($id)
  {
    $this->db->select('a.id_user,a.name_user,a.fill_notification,a.sts_notif,b.nama_merchant,b.logo,b.total_harga_package_merchant');
    $this->db->where('a.id_user', $id);
    $this->db->from('customer_notification a');
    $this->db->join('merchant b', 'a.id_merchant = b.id_merchant', 'left');

    $query = $this->db->get();
    return $query;
  }

  public function getDataNotificationAdmin()
  {
    $this->db->select('a.id_user,a.name_user,a.fill_notification,a.sts_notif,b.nama_merchant,b.logo,b.total_harga_package_merchant');
    $this->db->from('customer_notification a');
    $this->db->join('merchant b', 'a.id_merchant = b.id_merchant', 'left');

    $query = $this->db->get();
    return $query;
  }
}
