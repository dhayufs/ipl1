<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Midtrans_setting_model extends CI_Model {

    protected $table = 'midtrans_settings';

    public function __construct() {
        parent::__construct();
    }

    public function getSettings() {
        // Ambil satu-satunya baris data dari tabel
        $query = $this->db->get($this->table, 1);
        return $query->row_array();
    }

    public function saveSettings($data) {
        $settings = $this->getSettings();
        if ($settings) {
            // Jika data sudah ada, perbarui
            $this->db->update($this->table, $data);
        } else {
            // Jika belum ada, masukkan data baru
            $this->db->insert($this->table, $data);
        }
        return TRUE;
    }
}