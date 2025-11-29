<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Tagihan_model');
        $this->load->model('Transaksi_model');
        $this->load->model('Auth_model');
        $this->load->model('Kontrakan_model');
        $this->load->model('Pengaturan_model');
        $this->load->model('Midtrans_setting_model');
        $this->load->helper('url', 'form');
        $this->load->library(['form_validation', 'upload', 'curl']);

        if ($this->session->userdata('role') != 'user' || !$this->session->userdata('logged_in')) {
            redirect('auth');
        }
    }

    public function index() {
        $id_pelanggan = $this->session->userdata('id_pelanggan');
        $data['tagihan_aktif'] = $this->Tagihan_model->getTagihanAktif($id_pelanggan);
        $data['histori_lunas'] = $this->Tagihan_model->getHistoriLunas($id_pelanggan);
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('user/dashboard_user', $data);
        $this->load->view('templates/footer');
    }
    
    public function bayarPilihan() {
        $id_tagihan_arr = $this->input->post('tagihan_ids');
        if (empty($id_tagihan_arr)) {
            $this->session->set_flashdata('error', 'Pilih tagihan yang akan dibayarkan.');
            redirect('user');
        }

        $tagihan_detail = $this->Tagihan_model->getTagihanByIds($id_tagihan_arr, $this->session->userdata('id_pelanggan'));
        
        $total_tagihan = 0;
        $periode_terpilih = [];
        foreach ($tagihan_detail as $tagihan) {
            $total_tagihan += $tagihan['jumlah'];
            $periode_terpilih[] = $tagihan['periode'];
        }

        $data['total'] = $total_tagihan;
        $data['tagihan_ids'] = $id_tagihan_arr;
        $data['periode'] = implode(', ', $periode_terpilih);
        $data['pengaturan'] = $this->Pengaturan_model->getPengaturan();
        
        $data['id_pelanggan'] = $this->session->userdata('id_pelanggan');
        $data['id_pengontrak'] = NULL;
        
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('pembayaran_pilihan_view', $data);
        $this->load->view('templates/footer');
    }
    
    public function prosesPembayaranManual() {
        $data['total_bayar'] = $this->input->post('total_bayar');
        $data['periode'] = $this->input->post('periode');
        $data['tagihan_ids'] = $this->input->post('tagihan_ids');
        $this->load->view('proses_pembayaran_manual', $data);
    }
    
    public function prosesUploadBukti() {
        $id_tagihan_arr = $this->input->post('tagihan_ids');
        $total_bayar = $this->input->post('total_bayar');
        
        $id_transaksi_baru = 'MANUAL-' . uniqid();

        $transaksi_data = [
            'id_transaksi' => $id_transaksi_baru,
            'id_pelanggan' => $this->session->userdata('id_pelanggan'),
            'id_pengontrak' => NULL,
            'total_bayar' => $total_bayar,
            'status' => 'Pending',
            'tanggal_bayar' => date('Y-m-d H:i:s')
        ];
        $this->Transaksi_model->tambahTransaksi($transaksi_data);

        $config['upload_path']   = './uploads/bukti_transfer/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size']      = 2048;
        $config['file_name']     = 'bukti_' . $id_transaksi_baru . '_' . date('YmdHis');

        $this->upload->initialize($config);
        
        if ( ! $this->upload->do_upload('bukti_transfer')) {
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('error', 'Gagal upload bukti: ' . $error);
            redirect('user');
        } else {
            $upload_data = $this->upload->data();
            $file_name = $upload_data['file_name'];
            
            $this->Tagihan_model->updateTagihanStatusByIds_And_Bukti($id_tagihan_arr, $id_transaksi_baru, $file_name);

            $this->session->set_flashdata('pesan', 'Pembayaran berhasil diunggah! Menunggu konfirmasi admin.');
            redirect('user');
        }
    }

    public function ubahProfil() {
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('user/ubah_profil_view');
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
            redirect('user/ubahProfil');
        } else {
            if (!$this->Auth_model->checkPassword($id_user, $password_lama)) {
                $this->session->set_flashdata('error', 'Password lama salah.');
                redirect('user/ubahProfil');
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
            redirect('user');
        }
    }

    public function laporPengontrak() {
        $this->load->model('Kontrakan_model');
        $id_pelanggan = $this->session->userdata('id_pelanggan');
        
        $data['pengontrak_sudah_ada'] = ($this->Kontrakan_model->checkExistingPengontrak($id_pelanggan) > 0);
        $data['kontrakan'] = $this->Kontrakan_model->getKontrakanByPemilik($id_pelanggan);
        
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('user/lapor_pengontrak_view', $data);
        $this->load->view('templates/footer');
    }

    public function prosesLaporPengontrak() {
        $this->load->model('Kontrakan_model');
        $this->load->library('form_validation');

        $id_pelanggan = $this->session->userdata('id_pelanggan');
        if ($this->Kontrakan_model->checkExistingPengontrak($id_pelanggan) > 0) {
            $this->session->set_flashdata('error', 'Anda hanya dapat menambahkan satu pengontrak.');
            redirect('user/laporPengontrak');
        }

        $this->form_validation->set_rules('nama_pengontrak', 'Nama Pengontrak', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('user/laporPengontrak');
        } else {
            $nama_pengontrak = $this->input->post('nama_pengontrak');
            $id_pengontrak = 'KONTRAK' . strtoupper(substr(md5(uniqid(rand(), true)), 0, 5));

            $data = [
                'id_pelanggan_pemilik' => $id_pelanggan,
                'nama_pengontrak' => $nama_pengontrak,
                'id_pengontrak' => $id_pengontrak
            ];
            $this->Kontrakan_model->tambahKontrakan($data);

            $this->session->set_flashdata('pesan', 'Laporan pengontrak berhasil dibuat. ID Pengontrak: ' . $id_pengontrak);
            redirect('user/laporPengontrak');
        }
    }

    public function hapusPengontrak($id_kontrakan) {
        $this->load->model('Kontrakan_model');
        $id_pelanggan = $this->session->userdata('id_pelanggan');

        if ($this->Kontrakan_model->hapusKontrakan($id_kontrakan, $id_pelanggan)) {
            $this->session->set_flashdata('pesan', 'Data pengontrak berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus data pengontrak.');
        }
        
        redirect('user/laporPengontrak');
    }
    
    public function lihatBuktiTransaksi($id_transaksi) {
        $data['transaksi'] = $this->Transaksi_model->getTransaksiById($id_transaksi);
        if (!$data['transaksi'] || empty($data['transaksi']['bukti_transfer'])) {
            $this->session->set_flashdata('error', 'Bukti transfer tidak ditemukan.');
            redirect('user');
        }
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('user/lihat_bukti_transaksi_view', $data);
        $this->load->view('templates/footer');
    }

    public function bayarViaMidtrans() {
        $id_tagihan_arr = $this->input->post('tagihan_ids');
        $total_bayar = $this->input->post('total_bayar');
        $metode = $this->input->post('metode_pembayaran');
        
        $midtrans_settings = $this->Midtrans_setting_model->getSettings();
        if (!$midtrans_settings) {
            log_message('error', 'Midtrans settings are not configured in User/bayarViaMidtrans.');
            echo json_encode(['error' => 'Midtrans settings are not configured.']);
            return;
        }
        
        if ($metode == 'midtrans') {
            $order_id = 'TRX-' . uniqid();
            $total_bayar_string = (string) $total_bayar;
            $transaction_details = array(
                'order_id' => $order_id,
                'gross_amount' => $total_bayar,
            );
            
            $this->Tagihan_model->updateTagihanStatusMidtrans($id_tagihan_arr, $order_id);
            log_message('info', 'Midtrans transaction started for logged-in user. Tagihan IDs: ' . implode(',', $id_tagihan_arr) . ' with Order ID: ' . $order_id);
            
            $transaksi_data = [
                'id_transaksi' => $order_id,
                'id_pelanggan' => $this->session->userdata('id_pelanggan'),
                'id_pengontrak' => NULL,
                'total_bayar' => $total_bayar,
                'gross_amount_string' => $total_bayar_string,
                'status' => 'Pending Midtrans',
                'tanggal_bayar' => date('Y-m-d H:i:s')
            ];
            $this->Transaksi_model->tambahTransaksi($transaksi_data);

            $customer_details = array(
                'first_name'    => $this->session->userdata('username'),
                'email'         => 'example@example.com',
            );
            
            $payload = array(
                'transaction_details' => $transaction_details,
                'customer_details' => $customer_details
            );
            
            $is_production = $midtrans_settings['is_production'];
            $midtrans_url = $is_production ? 'https://app.midtrans.com/snap/v1/transactions' : 'https://app.sandbox.midtrans.com/snap/v1/transactions';
            $server_key = base64_encode($midtrans_settings['server_key'] . ':');

            $this->curl->create($midtrans_url);
            $this->curl->option(CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Accept: application/json', 'Authorization: Basic ' . $server_key));
            $this->curl->option(CURLOPT_POSTFIELDS, json_encode($payload));
            $this->curl->option(CURLOPT_RETURNTRANSFER, TRUE);
            $this->curl->option(CURLOPT_SSL_VERIFYPEER, false);
            
            $response = $this->curl->execute();
            $result = json_decode($response);

            log_message('info', 'Midtrans API Response: ' . $response);

            if (isset($result->token)) {
                echo json_encode(['token' => $result->token]);
            } else {
                log_message('error', 'Failed to get Midtrans token. Response: ' . $response);
                echo json_encode(['error' => 'Gagal mendapatkan token Midtrans.']);
            }
        } else {
            $data['total_bayar'] = $total_bayar;
            $data['periode'] = $periode;
            $data['tagihan_ids'] = $id_tagihan_arr;
            $data['id_pelanggan'] = $this->session->userdata('id_pelanggan');
            $data['id_pengontrak'] = NULL;
            $this->load->view('proses_pembayaran_manual', $data);
        }
    }
}