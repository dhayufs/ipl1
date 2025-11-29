<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kontrakan_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getKontrakanByPemilik($id_pelanggan) {
        $this->db->where('id_pelanggan_pemilik', $id_pelanggan);
        $query = $this->db->get('kontrakan');
        return $query->result_array();
    }
    
    public function getPengontrakByPemilik($id_pelanggan_pemilik) {
        $this->db->where('id_pelanggan_pemilik', $id_pelanggan_pemilik);
        $this->db->where('status', 'Aktif');
        $query = $this->db->get('kontrakan');
        return $query->result_array();
    }
    
    public function getPengontrakIdByPemilik($id_pelanggan_pemilik) {
        $this->db->select('id_pengontrak');
        $this->db->where('id_pelanggan_pemilik', $id_pelanggan_pemilik);
        $this->db->where('status', 'Aktif');
        $query = $this->db->get('kontrakan');
        $result = $query->row_array();
        return $result ? $result['id_pengontrak'] : NULL;
    }
    
    public function checkExistingPengontrak($id_pelanggan_pemilik) {
        $this->db->where('id_pelanggan_pemilik', $id_pelanggan_pemilik);
        $query = $this->db->get('kontrakan');
        return $query->num_rows();
    }

    public function tambahKontrakan($data) {
        return $this->db->insert('kontrakan', $data);
    }
    
    public function getKontrakByIdPengontrak($id_pengontrak) {
        $this->db->where('id_pengontrak', $id_pengontrak);
        $query = $this->db->get('kontrakan');
        return $query->row_array();
    }

    public function hapusKontrakan($id_kontrakan, $id_pelanggan_pemilik) {
        $this->db->where('id_kontrakan', $id_kontrakan);
        $this->db->where('id_pelanggan_pemilik', $id_pelanggan_pemilik);
        return $this->db->delete('kontrakan');
    }
}