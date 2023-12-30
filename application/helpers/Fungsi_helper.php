<?php
function dateSQL($date)
{
	$ci = get_instance();
	if ($date != '') {
		$dateSQL	= substr($date, 6, 4) . "-" . substr($date, 3, 2) . "-" . substr($date, 0, 2);
		return $dateSQL;
	} else {
		$dateSQL	= "";
		return $dateSQL;
	}
}

function getDataRumah($id_tipe_stok)
{
	$ci = get_instance();
	$ci->db->select('a.*, b.qty, b.pack, b.harga_satu_pack, b.nama_barang, c.singkatan_satuan, d.nama_tipe, e.nama_kategori');
	$ci->db->where('a.delete_sts', 0);
	$ci->db->where('b.id_tipe_stok', $id_tipe_stok);
	$ci->db->join('master_barang b', 'b.id_barang = a.id_barang', 'left');
	$ci->db->join('satuan c', 'b.id_satuan = c.id_satuan', 'left');
	$ci->db->join('tipe_stok d', 'b.id_tipe_stok = d.id_tipe_stok', 'left');
	$ci->db->join('kategori_item e', 'b.id_kategori_item = e.id_kategori_item', 'left');
	$ci->db->from('rumah a');

	$query = $ci->db->get()->result_array();
	return $query;
}

function getDataCatatanTambahDapur($id)
{
	$ci = get_instance();
	$ci->db->select('a.*, b.nama');
	$ci->db->where('a.id_dapur', $id);
	$ci->db->where('a.delete_sts', 0);
	$ci->db->join('user b', 'b.id_user = a.id_user', 'left');
	$ci->db->from('catatan_tambah_stok_dapur a');

	$query = $ci->db->get()->result_array();
	return $query;
}

function getDataCatatanSisaStokDapur($id)
{
	$ci = get_instance();
	$ci->db->select('a.*, b.nama');
	$ci->db->where('a.id_dapur', $id);
	$ci->db->where('a.delete_sts', 0);
	$ci->db->join('user b', 'b.id_user = a.id_user', 'left');
	$ci->db->from('catatan_sisa_stok_dapur a');

	$query = $ci->db->get()->result_array();
	return $query;
}


function getDataCatatanTambahBar($id)
{
	$ci = get_instance();
	$ci->db->select('a.*, b.nama');
	$ci->db->where('a.id_bar', $id);
	$ci->db->where('a.delete_sts', 0);
	$ci->db->join('user b', 'b.id_user = a.id_user', 'left');
	$ci->db->from('catatan_tambah_stok_bar a');

	$query = $ci->db->get()->result_array();
	return $query;
}

function getDataCatatanSisaStokBar($id)
{
	$ci = get_instance();
	$ci->db->select('a.*, b.nama');
	$ci->db->where('a.id_bar', $id);
	$ci->db->where('a.delete_sts', 0);
	$ci->db->join('user b', 'b.id_user = a.id_user', 'left');
	$ci->db->from('catatan_sisa_stok_bar a');

	$query = $ci->db->get()->result_array();
	return $query;
}
