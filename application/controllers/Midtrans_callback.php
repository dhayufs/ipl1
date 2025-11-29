<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Midtrans_callback extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Tagihan_model');
        $this->load->model('Transaksi_model');
        $this->load->model('Midtrans_setting_model');
        $this->load->library('curl');
    }

    public function handle() {
        log_message('info', 'Midtrans callback received.');
        
        // Ambil data notifikasi dari Midtrans
        $json_result = file_get_contents('php://input');
        $notification = json_decode($json_result, true);

        if (!$notification) {
            log_message('error', 'Invalid Midtrans notification received.');
            http_response_code(400); // Bad Request
            return;
        }

        // Ambil pengaturan Midtrans dari database
        $midtrans_settings = $this->Midtrans_setting_model->getSettings();
        if (!$midtrans_settings) {
            log_message('error', 'Midtrans settings not found.');
            http_response_code(500); // Internal Server Error
            return;
        }

        // Ambil data penting dari notifikasi
        $order_id = isset($notification['order_id']) ? $notification['order_id'] : '';
        $status_code = isset($notification['status_code']) ? $notification['status_code'] : '';
        $gross_amount = isset($notification['gross_amount']) ? $notification['gross_amount'] : '';
        $signature_key_midtrans = isset($notification['signature_key']) ? $notification['signature_key'] : '';

        // Validasi Signature Key
        $server_key = trim($midtrans_settings['server_key']);
        $string_to_hash = $order_id . $status_code . $gross_amount . $server_key;
        $signature_key_calculated = hash('sha512', $string_to_hash);

        if ($signature_key_midtrans != $signature_key_calculated) {
            log_message('error', 'Invalid signature key from Midtrans for order_id: ' . $order_id);
            http_response_code(401); // Unauthorized
            return;
        }

        // Proses status transaksi
        $transaction_status = $notification['transaction_status'];
        $fraud_status = isset($notification['fraud_status']) ? $notification['fraud_status'] : '';

        if ($transaction_status == 'capture') {
            if ($fraud_status == 'accept') {
                $status_update_tagihan = 'Lunas';
                $status_update_transaksi = 'Lunas';
                $bukti_transfer_teks = 'Lunas Via Midtrans';
                
                $this->Tagihan_model->updateStatusByTransaksi($order_id, $status_update_tagihan, $bukti_transfer_teks);
                $this->Transaksi_model->updateStatusByTransaksi($order_id, $status_update_transaksi);
                log_message('info', 'Midtrans payment CAPTURE ACCEPT for order_id: ' . $order_id);
            }
        } else if ($transaction_status == 'settlement') {
            $status_update_tagihan = 'Lunas';
            $status_update_transaksi = 'Lunas';
            $bukti_transfer_teks = 'Lunas Via Midtrans';

            $this->Tagihan_model->updateStatusByTransaksi($order_id, $status_update_tagihan, $bukti_transfer_teks);
            $this->Transaksi_model->updateStatusByTransaksi($order_id, $status_update_transaksi);
            log_message('info', 'Midtrans payment SETTLEMENT for order_id: ' . $order_id);

        } else if ($transaction_status == 'cancel' || $transaction_status == 'deny' || $transaction_status == 'expire') {
            $status_update_tagihan = 'Belum Bayar';
            $status_update_transaksi = 'Gagal';
            $bukti_transfer_teks = NULL;

            $this->Tagihan_model->updateStatusByTransaksi($order_id, $status_update_tagihan, $bukti_transfer_teks);
            $this->Transaksi_model->updateStatusByTransaksi($order_id, $status_update_transaksi);
            log_message('info', 'Midtrans payment failed/expired/canceled for order_id: ' . $order_id);
        } else if ($transaction_status == 'pending') {
            // Biarkan status tagihan tetap Pending Midtrans
            log_message('info', 'Midtrans payment is PENDING for order_id: ' . $order_id);
        }

        http_response_code(200); // Berikan respons OK ke Midtrans
    }
}