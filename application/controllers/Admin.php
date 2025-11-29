<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Tagihan_model');
        $this->load->model('Transaksi_model');
        $this->load->model('Auth_model');
        $this->load->model('Kontrakan_model');
        $this->load->model('Pengaturan_model');
        $this->load->model('Midtrans_setting_model'); // Tambahkan model baru
        $this->load->helper('url', 'form');
        $this->load->library(['form_validation', 'upload']);

        if ($this->session->userdata('role') != 'admin' || !$this->session->userdata('logged_in')) {
            redirect('auth');
        }
    }

    public function index() {
        $data['total_belum_lunas'] = $this->Tagihan_model->getTotalTagihanBelumLunas();
        $data['total_lunas'] = $this->Tagihan_model->getTotalTagihanLunas();
        
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar_admin');
        $this->load->view('admin/dashboard_admin', $data);
        $this->load->view('templates/footer');
    }

    public function inputTagihan() {
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar_admin');
        $this->load->view('admin/input_tagihan_view');
        $this->load->view('templates/footer');
    }
    
    public function prosesInputTagihan() {
        $data_tagihan = array(
            'id_pelanggan'   => $this->input->post('id_pelanggan'),
            'id_pengontrak'  => $this->Kontrakan_model->getPengontrakIdByPemilik($this->input->post('id_pelanggan')),
            'nama_pelanggan' => $this->input->post('nama_pelanggan'),
            'periode'        => $this->input->post('periode'),
            'jumlah'         => $this->input->post('jumlah'),
            'status_bayar'   => 'Belum Bayar'
        );
        
        $this->Tagihan_model->tambahTagihan($data_tagihan);
        
        $this->session->set_flashdata('pesan', 'Tagihan berhasil ditambahkan!');
        
        redirect('admin/inputTagihan');
    }

    public function prosesInputTagihanMassal() {
        $periode = $this->input->post('periode');
        $jumlah = $this->input->post('jumlah');
        
        $all_users = $this->Auth_model->getAllUsers();
        
        if (!empty($all_users)) {
            foreach ($all_users as $user) {
                $id_pengontrak = $this->Kontrakan_model->getPengontrakIdByPemilik($user['id_pelanggan']);
                
                $data_tagihan = array(
                    'id_pelanggan'   => $user['id_pelanggan'],
                    'id_pengontrak'  => $id_pengontrak,
                    'nama_pelanggan' => $user['username'],
                    'periode'        => $periode,
                    'jumlah'         => $jumlah,
                    'status_bayar'   => 'Belum Bayar'
                );
                $this->Tagihan_model->tambahTagihan($data_tagihan);
            }
            $this->session->set_flashdata('pesan', 'Tagihan massal berhasil ditambahkan!');
        } else {
            $this->session->set_flashdata('error', 'Tidak ada user yang terdaftar.');
        }
        
        redirect('admin/inputTagihan');
    }

    public function getNamaPelanggan() {
        $id_pelanggan = $this->input->post('id_pelanggan');
        $nama_pelanggan = $this->Auth_model->getNamaByIdPelanggan($id_pelanggan);
        
        echo json_encode(['nama' => $nama_pelanggan]);
    }

    public function konfirmasiPembayaran() {
        $data['tagihan_pending'] = $this->Tagihan_model->getTagihanByStatus('Pending');
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar_admin');
        $this->load->view('admin/konfirmasi_pembayaran_view', $data);
        $this->load->view('templates/footer');
    }

    public function semuaTagihan() {
        $data['tagihan_lainnya'] = $this->Tagihan_model->getAllTagihanExcept('Pending');
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar_admin');
        $this->load->view('admin/semua_tagihan_view', $data);
        $this->load->view('templates/footer');
    }

    public function lihatBukti($id_tagihan) {
        $data['tagihan'] = $this->Tagihan_model->getTagihanByIdSingle($id_tagihan);
        if (!$data['tagihan'] || empty($data['tagihan']['bukti_transfer'])) {
            $this->session->set_flashdata('error', 'Bukti transfer tidak ditemukan.');
            redirect('admin/konfirmasiPembayaran');
        }
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar_admin');
        $this->load->view('admin/lihat_bukti_view', $data);
        $this->load->view('templates/footer');
    }

    public function approvePembayaran($id_tagihan) {
        $data_update = array(
            'status_bayar' => 'Lunas'
        );
        $this->Tagihan_model->updateStatusAndBukti($id_tagihan, $data_update);
        $this->session->set_flashdata('pesan', 'Pembayaran berhasil di-approve!');
        redirect('admin/konfirmasiPembayaran');
    }
    
    public function tolakPembayaran($id_tagihan) {
        $data_update = array(
            'status_bayar' => 'Belum Bayar',
            'bukti_transfer' => NULL,
            'tanggal_bayar' => NULL
        );
        $this->Tagihan_model->updateStatusAndBukti($id_tagihan, $data_update);
        $this->session->set_flashdata('pesan', 'Pembayaran ditolak. Bukti transfer dihapus.');
        redirect('admin/konfirmasiPembayaran');
    }
    
    public function ubahProfil() {
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar_admin');
        $this->load->view('admin/ubah_profil_view');
        $this->load->view('templates/footer');
    }

    public function prosesUbahProfil() {
        $this->load->library('form_validation');
        
        $id_user = $this->session->userdata('user_id');
        $username_baru = $this->input->post('username_baru');
        $password_baru = $this->input->post('password_baru');
        $password_lama = $this->input->post('password_lama');

        $this->form_validation->set_rules('username_baru', 'Nama Pengguna', 'required|min_length[3]');
        $this->form_validation->set_rules('password_lama', 'Password Lama', 'required');
        
        if (!empty($password_baru)) {
            $this->form_validation->set_rules('password_baru', 'Password Baru', 'min_length[6]');
            $this->form_validation->set_rules('konfirmasi_password', 'Konfirmasi Password', 'matches[password_baru]');
        }

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('admin/ubahProfil');
        } else {
            if (!$this->Auth_model->checkPassword($id_user, $password_lama)) {
                $this->session->set_flashdata('error', 'Password lama salah.');
                redirect('admin/ubahProfil');
            }

            $data_update = array(
                'username' => $username_baru
            );

            if (!empty($password_baru)) {
                $data_update['password'] = md5($password_baru);
            }

            $this->Auth_model->updateProfil($id_user, $data_update);
            $this->session->set_userdata('username', $username_baru);

            $this->session->set_flashdata('pesan', 'Profil berhasil diperbarui!');
            redirect('admin');
        }
    }
    
    public function kelolaAkun() {
        $data['users'] = $this->Auth_model->getAllUsers();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar_admin');
        $this->load->view('admin/kelola_akun_view', $data);
        $this->load->view('templates/footer');
    }

    public function tambahAkun() {
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar_admin');
        $this->load->view('admin/form_akun_view');
        $this->load->view('templates/footer');
    }

    public function prosesTambahAkun() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Nama Pengguna', 'required|is_unique[users.username]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('id_pelanggan', 'ID Pelanggan', 'required|is_unique[users.id_pelanggan]');
        $this->form_validation->set_rules('role', 'Role', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('admin/tambahAkun');
        } else {
            $data = array(
                'username' => $this->input->post('username'),
                'password' => md5($this->input->post('password')),
                'id_pelanggan' => $this->input->post('id_pelanggan'),
                'role' => $this->input->post('role')
            );
            $this->Auth_model->tambahAkun($data);
            $this->session->set_flashdata('pesan', 'Akun berhasil ditambahkan!');
            redirect('admin/kelolaAkun');
        }
    }

    public function editAkun($id_user) {
        $data['user'] = $this->Auth_model->getUserById($id_user);
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar_admin');
        $this->load->view('admin/form_akun_view', $data);
        $this->load->view('templates/footer');
    }

    public function prosesEditAkun() {
        $id_user = $this->input->post('id_user');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Nama Pengguna', 'required|min_length[3]');
        $this->form_validation->set_rules('id_pelanggan', 'ID Pelanggan', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('admin/editAkun/' . $id_user);
        } else {
            $data = array(
                'username' => $this->input->post('username'),
                'id_pelanggan' => $this->input->post('id_pelanggan'),
                'role' => $this->input->post('role')
            );
            $password_baru = $this->input->post('password');
            if (!empty($password_baru)) {
                $data['password'] = md5($password_baru);
            }
            $this->Auth_model->updateAkun($id_user, $data);
            $this->session->set_flashdata('pesan', 'Akun berhasil diperbarui!');
            redirect('admin/kelolaAkun');
        }
    }

    public function hapusAkun($id_user) {
        $this->Auth_model->hapusAkun($id_user);
        $this->session->set_flashdata('pesan', 'Akun berhasil dihapus!');
        redirect('admin/kelolaAkun');
    }
    
    public function pengaturanPembayaran() {
        $data['pengaturan'] = $this->Pengaturan_model->getPengaturan();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar_admin');
        $this->load->view('admin/pengaturan_pembayaran_view', $data);
        $this->load->view('templates/footer');
    }

    public function prosesPengaturanPembayaran() {
        $data = [
            'metode_manual' => $this->input->post('metode_manual') ? 1 : 0,
            'metode_midtrans' => $this->input->post('metode_midtrans') ? 1 : 0
        ];
        $this->Pengaturan_model->updatePengaturan($data);
        $this->session->set_flashdata('pesan', 'Pengaturan pembayaran berhasil diperbarui!');
        redirect('admin/pengaturanPembayaran');
    }

    public function midtransSettings() {
        $data['settings'] = $this->Midtrans_setting_model->getSettings();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar_admin');
        $this->load->view('admin/midtrans_setting_view', $data);
        $this->load->view('templates/footer');
    }

	// Tambahkan ini di dalam class Admin
	public function saveMidtransSettings() {
    	$data = [
        	'merchant_id' => $this->input->post('merchant_id'),
        	'server_key' => $this->input->post('server_key'),
        	'client_key' => $this->input->post('client_key'),
        	'is_production' => $this->input->post('is_production') ? 1 : 0
    	];
    	$this->Midtrans_setting_model->saveSettings($data);
    	$this->session->set_flashdata('pesan', 'Pengaturan Midtrans berhasil disimpan!');
    	redirect('admin/midtransSettings');
	}
}