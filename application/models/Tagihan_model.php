<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tagihan_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getTagihanById($id_pelanggan) {
        $this->db->where('id_pelanggan', $id_pelanggan);
        $this->db->where('status_bayar', 'Belum Bayar');
        $query = $this->db->get('tagihan');
        return $query->row_array();
    }
    
    public function getTagihanAktif($id_pelanggan) {
        $this->db->where('id_pelanggan', $id_pelanggan);
        $this->db->where_in('status_bayar', array('Belum Bayar', 'Pending', 'Pending Midtrans'));
        $this->db->order_by('id_tagihan', 'ASC');
        $query = $this->db->get('tagihan');
        return $query->result_array();
    }
    
    public function getHistoriLunas($id_pelanggan) {
        $this->db->where('id_pelanggan', $id_pelanggan);
        $this->db->where('status_bayar', 'Lunas');
        $this->db->order_by('tanggal_bayar', 'DESC');
        $query = $this->db->get('tagihan');
        return $query->result_array();
    }
    
    public function getTagihanByIdSingle($id_tagihan) {
        $this->db->where('id_tagihan', $id_tagihan);
        $query = $this->db->get('tagihan');
        return $query->row_array();
    }
    
    public function getTagihanByIds($ids_array, $id_pelanggan) {
        $this->db->where_in('id_tagihan', $ids_array);
        $this->db->where('id_pelanggan', $id_pelanggan);
        $this->db->where_in('status_bayar', ['Belum Bayar', 'Pending Midtrans']);
        $query = $this->db->get('tagihan');
        return $query->result_array();
    }
    
    public function updateTagihanStatusByIds($ids_array, $id_transaksi) {
        $data = [
            'status_bayar' => 'Pending',
            'id_transaksi' => $id_transaksi
        ];
        $this->db->where_in('id_tagihan', $ids_array);
        return $this->db->update('tagihan', $data);
    }

    // Method yang hilang dan telah ditambahkan
    public function updateTagihanStatusByIds_And_Bukti($ids_array, $id_transaksi, $file_name) {
        $data = [
            'status_bayar' => 'Pending',
            'id_transaksi' => $id_transaksi,
            'bukti_transfer' => $file_name,
            'tanggal_bayar' => date('Y-m-d H:i:s')
        ];
        $this->db->where_in('id_tagihan', $ids_array);
        return $this->db->update('tagihan', $data);
    }
    
    public function updateStatus($id_tagihan, $data) {
        $this->db->where('id_tagihan', $id_tagihan);
        return $this->db->update('tagihan', $data);
    }

    public function updateStatusAndBukti($id_tagihan, $data) {
        $this->db->where('id_tagihan', $id_tagihan);
        return $this->db->update('tagihan', $data);
    }

    public function tambahTagihan($data) {
        return $this->db->insert('tagihan', $data);
    }
    
    public function tambahTagihanUntukPengontrak($data_pengontrak) {
        return $this->db->insert('tagihan', $data_pengontrak);
    }

    public function getAllTagihan() {
        $this->db->select('tagihan.*, users.username, kontrakan.nama_pengontrak, tagihan.id_pengontrak');
        $this->db->from('tagihan');
        $this->db->join('users', 'users.id_pelanggan = tagihan.id_pelanggan', 'left');
        $this->db->join('kontrakan', 'kontrakan.id_pengontrak = tagihan.id_pengontrak', 'left');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getTagihanByStatus($status) {
        $this->db->select('tagihan.*, users.username, kontrakan.nama_pengontrak, tagihan.id_pengontrak');
        $this->db->from('tagihan');
        $this->db->join('users', 'users.id_pelanggan = tagihan.id_pelanggan', 'left');
        $this->db->join('kontrakan', 'kontrakan.id_pengontrak = tagihan.id_pengontrak', 'left');
        $this->db->where('tagihan.status_bayar', $status);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getAllTagihanExcept($status) {
        $this->db->select('tagihan.*, users.username, kontrakan.nama_pengontrak, tagihan.id_pengontrak');
        $this->db->from('tagihan');
        $this->db->join('users', 'users.id_pelanggan = tagihan.id_pelanggan', 'left');
        $this->db->join('kontrakan', 'kontrakan.id_pengontrak = tagihan.id_pengontrak', 'left');
        $this->db->where('tagihan.status_bayar !=', $status);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function getTagihanByTransaksi($id_transaksi) {
        $this->db->where('id_transaksi', $id_transaksi);
        $query = $this->db->get('tagihan');
        return $query->result_array();
    }
    
    public function getTagihanAktifPublic($id_pelanggan, $id_pengontrak) {
        $this->db->where('id_pelanggan', $id_pelanggan);
        $this->db->where('id_pengontrak', $id_pengontrak);
        $this->db->where_in('status_bayar', array('Belum Bayar', 'Pending', 'Pending Midtrans'));
        $this->db->order_by('id_tagihan', 'ASC');
        $query = $this->db->get('tagihan');
        return $query->result_array();
    }
    
    public function updateBuktiTransferTagihan($id_tagihan, $file_name, $id_transaksi) {
        $data_update = [
            'bukti_transfer' => $file_name,
            'tanggal_bayar' => date('Y-m-d H:i:s'),
            'id_transaksi' => $id_transaksi
        ];
        $this->db->where('id_tagihan', $id_tagihan);
        $this->db->update('tagihan', $data_update);
    }
    
    public function getTotalTagihanBelumLunas() {
        $this->db->select_sum('jumlah');
        $this->db->where_in('status_bayar', ['Belum Bayar', 'Pending']);
        $query = $this->db->get('tagihan');
        return $query->row()->jumlah ?? 0;
    }
    
    public function getTotalTagihanLunas() {
        $this->db->select_sum('jumlah');
        $this->db->where('status_bayar', 'Lunas');
        $query = $this->db->get('tagihan');
        return $query->row()->jumlah ?? 0;
    }

    public function updateStatusByTransaksi($id_transaksi, $status, $bukti = NULL) {
        log_message('info', 'Updating tagihan status for transaction ID: ' . $id_transaksi);
        
        $data_update = [
            'status_bayar' => $status,
            'bukti_transfer' => $bukti
        ];
        if ($status == 'Lunas') {
            $data_update['tanggal_bayar'] = date('Y-m-d H:i:s');
        } else {
            $data_update['tanggal_bayar'] = NULL;
        }
        $this->db->where('id_transaksi', $id_transaksi);
        $this->db->update('tagihan', $data_update);

        log_message('info', 'Database update query: ' . $this->db->last_query());
        log_message('info', 'Rows affected: ' . $this->db->affected_rows());
    }
    
    public function updateTransaksiId($ids_array, $id_transaksi) {
        log_message('info', 'Attempting to link tagihan IDs: ' . implode(',', $ids_array) . ' with new transaction ID: ' . $id_transaksi);
        $data = [
            'id_transaksi' => $id_transaksi
        ];
        $this->db->where_in('id_tagihan', $ids_array);
        $this->db->update('tagihan', $data);

        log_message('info', 'Link query: ' . $this->db->last_query());
        log_message('info', 'Rows affected by link: ' . $this->db->affected_rows());
    }
    
    public function updateTagihanStatusMidtrans($ids_array, $id_transaksi) {
        $data = [
            'status_bayar' => 'Pending Midtrans',
            'id_transaksi' => $id_transaksi
        ];
        $this->db->where_in('id_tagihan', $ids_array);
        return $this->db->update('tagihan', $data);
    }
}