<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengaturan_model extends CI_Model {

    protected $table = 'pengaturan';

    public function __construct() {
        parent::__construct();
    }

    public function getPengaturan() {
        $query = $this->db->get($this->table);
        return $query->row_array();
    }

    public function updatePengaturan($data) {
        // Asumsi hanya ada 1 baris di tabel pengaturan
        return $this->db->update($this->table, $data);
    }
}