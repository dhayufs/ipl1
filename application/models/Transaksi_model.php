<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_model extends CI_Model {
    protected $table = 'transaksi';

    public function tambahTransaksi($data) {
        // Karena id_transaksi bisa berupa string dari Midtrans,
        // kita tidak menggunakan auto_increment
        return $this->db->insert($this->table, $data);
    }

    public function getTransaksiByStatus($status) {
        $this->db->where('status', $status);
        $this->db->order_by('tanggal_bayar', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result_array();
    }
    
    public function updateBuktiTransfer($id_transaksi, $file_name) {
        $data = ['bukti_transfer' => $file_name, 'status' => 'Pending'];
        $this->db->where('id_transaksi', $id_transaksi);
        return $this->db->update($this->table, $data);
    }
    
    public function getTransaksiById($id_transaksi) {
        $this->db->where('id_transaksi', $id_transaksi);
        $query = $this->db->get($this->table);
        return $query->row_array();
    }

    public function updateTransaksiStatus($id_transaksi, $status) {
        $data = ['status' => $status];
        $this->db->where('id_transaksi', $id_transaksi);
        return $this->db->update($this->table, $data);
    }

    public function updateStatusByTransaksi($id_transaksi, $status) {
        $this->db->set('status', $status);
        $this->db->where('id_transaksi', $id_transaksi);
        $this->db->update($this->table);
    }
}