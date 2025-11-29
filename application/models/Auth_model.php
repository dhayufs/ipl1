<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function checkLogin($username, $password) {
        $this->db->where('username', $username);
        $query = $this->db->get('users');
        $user = $query->row_array();
        
        if ($user && md5($password) == $user['password']) {
            return $user;
        }
        return false;
    }

    public function checkPassword($id_user, $password) {
        $this->db->where('id', $id_user);
        $query = $this->db->get('users');
        $user = $query->row_array();
        
        if ($user && md5($password) == $user['password']) {
            return true;
        }
        return false;
    }

    public function updateProfil($id_user, $data) {
        $this->db->where('id', $id_user);
        return $this->db->update('users', $data);
    }
    
    public function getNamaByIdPelanggan($id_pelanggan) {
        $this->db->where('id_pelanggan', $id_pelanggan);
        $query = $this->db->get('users');
        $result = $query->row_array();
        return $result ? $result['username'] : NULL;
    }

    public function getAllUsers() {
        // Hanya ambil user dengan role 'user', bukan 'admin'
        $this->db->where('role', 'user');
        $query = $this->db->get('users');
        return $query->result_array();
    }
    
    public function getUserById($id_user) {
        $this->db->where('id', $id_user);
        $query = $this->db->get('users');
        return $query->row_array();
    }
    
    public function tambahAkun($data) {
        return $this->db->insert('users', $data);
    }
    
    public function updateAkun($id_user, $data) {
        $this->db->where('id', $id_user);
        return $this->db->update('users', $data);
    }

    public function hapusAkun($id_user) {
        $this->db->where('id', $id_user);
        return $this->db->delete('users');
    }
}