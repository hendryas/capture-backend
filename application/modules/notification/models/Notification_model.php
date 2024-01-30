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
}
