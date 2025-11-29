<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Auth_model');
        $this->load->model('Tagihan_model');
        $this->load->model('Transaksi_model');
        $this->load->model('Kontrakan_model');
        $this->load->model('Pengaturan_model');
        $this->load->model('Midtrans_setting_model');
        $this->load->helper('url', 'form');
        $this->load->library(['session', 'upload', 'curl']);
    }

    public function index() {
        $this->load->view('landing_page_view');
    }

    public function login() {
        $this->load->view('login_view');
    }

    public function prosesLogin() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->Auth_model->checkLogin($username, $password);

        if ($user) {
            $this->session->set_userdata('logged_in', TRUE);
            $this->session->set_userdata('user_id', $user['id']);
            $this->session->set_userdata('username', $user['username']);
            $this->session->set_userdata('role', $user['role']);
            $this->session->set_userdata('id_pelanggan', $user['id_pelanggan']);

            if ($user['role'] == 'admin') {
                redirect('admin');
            } else {
                redirect('user');
            }
        } else {
            $this->session->set_flashdata('error', 'Username atau password salah!');
            redirect('auth/login');
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('auth');
    }

    public function bayarTanpaLogin() {
        $this->load->view('bayar_public_view');
    }

    public function cekTagihanPublic() {
        $id_pelanggan = $this->input->post('id_pelanggan');
        $id_pengontrak = $this->input->post('id_pengontrak');

        $kontrak = $this->Kontrakan_model->getKontrakByIdPengontrak($id_pengontrak);

        if ($kontrak && $kontrak['id_pelanggan_pemilik'] == $id_pelanggan) {
            $tagihan_aktif = $this->Tagihan_model->getTagihanAktifPublic($id_pelanggan, $id_pengontrak);
            
            $is_pending = false;
            if (!empty($tagihan_aktif)) {
                foreach ($tagihan_aktif as $tagihan) {
                    if ($tagihan['status_bayar'] == 'Pending') {
                        $is_pending = true;
                        break;
                    }
                }
            }

            if ($is_pending) {
                redirect('auth/pembayaranPending');
            } else {
                $total_tagihan = 0;
                $periode_terpilih = [];
                $tagihan_ids_arr = [];
                if (!empty($tagihan_aktif)) {
                    foreach ($tagihan_aktif as $tagihan) {
                        $total_tagihan += $tagihan['jumlah'];
                        $periode_terpilih[] = $tagihan['periode'];
                        $tagihan_ids_arr[] = $tagihan['id_tagihan'];
                    }
                }

                $data['tagihan_aktif'] = $tagihan_aktif;
                $data['id_pelanggan'] = $id_pelanggan;
                $data['id_pengontrak'] = $id_pengontrak;
                $data['pengaturan'] = $this->Pengaturan_model->getPengaturan();
                
                $data['total'] = $total_tagihan;
                $data['periode'] = implode(', ', $periode_terpilih);
                $data['tagihan_ids'] = $tagihan_ids_arr;

                $this->load->view('pembayaran_pilihan_view', $data);
            }
        } else {
            $this->session->set_flashdata('error', 'ID Pelanggan atau ID Pengontrak tidak ditemukan.');
            redirect('auth/bayarTanpaLogin');
        }
    }
    
    public function prosesPembayaranManualPublic() {
        $data['total_bayar'] = $this->input->post('total_bayar');
        $data['periode'] = $this->input->post('periode');
        $data['tagihan_ids'] = $this->input->post('tagihan_ids');
        $data['id_pelanggan'] = $this->input->post('id_pelanggan');
        $data['id_pengontrak'] = $this->input->post('id_pengontrak');
        $this->load->view('proses_pembayaran_manual', $data);
    }
    
    public function prosesUploadBuktiPublic() {
        $id_tagihan_arr = $this->input->post('tagihan_ids');
        $total_bayar = $this->input->post('total_bayar');
        $id_pelanggan = $this->input->post('id_pelanggan');
        $id_pengontrak = $this->input->post('id_pengontrak');

        $id_transaksi_baru = 'MANUAL-' . uniqid();

        $transaksi_data = [
            'id_transaksi' => $id_transaksi_baru,
            'id_pelanggan' => $id_pelanggan,
            'id_pengontrak' => $id_pengontrak,
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

        if (!$this->upload->do_upload('bukti_transfer')) {
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('error', 'Gagal upload bukti: ' . $error);
            redirect('auth/bayarTanpaLogin');
        } else {
            $upload_data = $this->upload->data();
            $file_name = $upload_data['file_name'];
            
            $this->Tagihan_model->updateTagihanStatusByIds_And_Bukti($id_tagihan_arr, $id_transaksi_baru, $file_name);

            $this->session->set_flashdata('pesan', 'Pembayaran berhasil diunggah! Menunggu konfirmasi admin.');
            redirect('auth/pembayaranPending');
        }
    }
    
    public function pembayaranPending() {
        $this->load->view('pembayaran_pending_view');
    }

    public function bayarViaMidtransPublic() {
        $id_tagihan_arr = $this->input->post('tagihan_ids');
        $total_bayar = $this->input->post('total_bayar');
        $metode = $this->input->post('metode_pembayaran');
        $id_pelanggan = $this->input->post('id_pelanggan');
        $id_pengontrak = $this->input->post('id_pengontrak');
        
        $midtrans_settings = $this->Midtrans_setting_model->getSettings();
        if (!$midtrans_settings) {
            log_message('error', 'Midtrans settings are not configured in Auth/bayarViaMidtransPublic.');
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
            log_message('info', 'Midtrans transaction started for public user. Tagihan IDs: ' . implode(',', $id_tagihan_arr) . ' with Order ID: ' . $order_id);
            
            $transaksi_data = [
                'id_transaksi' => $order_id,
                'id_pelanggan' => $id_pelanggan,
                'id_pengontrak' => $id_pengontrak,
                'total_bayar' => $total_bayar,
                'gross_amount_string' => $total_bayar_string,
                'status' => 'Pending Midtrans',
                'tanggal_bayar' => date('Y-m-d H:i:s')
            ];
            $this->Transaksi_model->tambahTransaksi($transaksi_data);

            $customer_details = array(
                'first_name'    => $this->Auth_model->getNamaByIdPelanggan($id_pelanggan),
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
            // Jika metode bukan Midtrans, arahkan ke halaman proses manual
            $data['total_bayar'] = $total_bayar;
            $data['periode'] = $periode;
            $data['tagihan_ids'] = $id_tagihan_arr;
            $data['id_pelanggan'] = $id_pelanggan;
            $data['id_pengontrak'] = $id_pengontrak;
            $this->load->view('proses_pembayaran_manual', $data);
        }
    }
}