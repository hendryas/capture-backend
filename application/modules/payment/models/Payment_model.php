<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Payment_model extends CI_Model
{
  public function insertDataPayment($data)
  {
    $this->db->insert('rekap_pembayaran_pelanggan', $data);

    $insert = $this->db->affected_rows();

    if ($insert == 1) {
      return TRUE;
    } else {
      return FALSE;
    }
  }

  public function getDatahistoryPaymentByIdUser($id)
  {
    $this->db->select('a.id_rekap_pembayaran,a.no_order,a.status_pembayaran,b.nama_merchant,b.logo,b.total_harga_package_merchant,c.nama');
    $this->db->where('a.id_user', $id);
    $this->db->from('rekap_pembayaran_pelanggan a');
    $this->db->join('merchant b', 'a.id_merchant = b.id_merchant', 'left');
    $this->db->join('user c', 'a.id_user = c.id_user', 'left');

    $query = $this->db->get();
    return $query;
  }

  public function getDatahistoryPaymentByIdUserPaginate($id, $limit, $offset)
  {
    $this->db->limit($limit, $offset);
    $this->db->select('a.id_rekap_pembayaran,a.status_pembayaran,a.no_order,b.nama_merchant,b.logo,b.total_harga_package_merchant,c.nama,a.created_at');
    $this->db->where('a.id_user', $id);
    $this->db->from('rekap_pembayaran_pelanggan a');
    $this->db->join('merchant b', 'a.id_merchant = b.id_merchant', 'left');
    $this->db->join('user c', 'a.id_user = c.id_user', 'left');
    $query = $this->db->get();
    return $query;
  }

  public function updateDataTransaction($no_order, $data)
  {
    $this->db->where('no_order', $no_order);
    $this->db->update('rekap_pembayaran_pelanggan', $data);

    $update = $this->db->affected_rows();

    if ($update == 1) {
      return TRUE;
    } else {
      return FALSE;
    }
  }

  public function getDataHistoryPaymentCustomerByNoOrder($no_order)
  {
    $this->db->select('a.*');
    $this->db->where('a.no_order', $no_order);
    $this->db->from('rekap_pembayaran_pelanggan a');

    $query = $this->db->get();
    return $query;
  }
}
