<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'auth';

// Routing untuk autentikasi dan halaman publik
$route['auth/login'] = 'auth/login';
$route['auth/prosesLogin'] = 'auth/prosesLogin';
$route['auth/logout'] = 'auth/logout';
$route['auth/bayarTanpaLogin'] = 'auth/bayarTanpaLogin';
$route['auth/cekTagihanPublic'] = 'auth/cekTagihanPublic';
$route['auth/prosesPembayaranManualPublic'] = 'auth/prosesPembayaranManualPublic'; // Rute baru
$route['auth/prosesUploadBuktiPublic'] = 'auth/prosesUploadBuktiPublic';
$route['auth/pembayaranPending'] = 'auth/pembayaranPending';
$route['auth/bayarViaMidtransPublic'] = 'auth/bayarViaMidtransPublic';

// Routing untuk dashboard admin
$route['admin'] = 'admin';
$route['admin/inputTagihan'] = 'admin/inputTagihan';
$route['admin/prosesInputTagihan'] = 'admin/prosesInputTagihan';
$route['admin/prosesInputTagihanMassal'] = 'admin/prosesInputTagihanMassal';
$route['admin/konfirmasiPembayaran'] = 'admin/konfirmasiPembayaran';
$route['admin/semuaTagihan'] = 'admin/semuaTagihan';
$route['admin/lihatBukti/(:any)'] = 'admin/lihatBukti/$1';
$route['admin/approvePembayaran/(:any)'] = 'admin/approvePembayaran/$1';
$route['admin/tolakPembayaran/(:any)'] = 'admin/tolakPembayaran/$1';
$route['admin/ubahProfil'] = 'admin/ubahProfil';
$route['admin/prosesUbahProfil'] = 'admin/prosesUbahProfil';
$route['admin/kelolaAkun'] = 'admin/kelolaAkun';
$route['admin/tambahAkun'] = 'admin/tambahAkun';
$route['admin/prosesTambahAkun'] = 'admin/prosesTambahAkun';
$route['admin/editAkun/(:any)'] = 'admin/editAkun/$1';
$route['admin/prosesEditAkun'] = 'admin/prosesEditAkun';
$route['admin/hapusAkun/(:any)'] = 'admin/hapusAkun/$1';
$route['admin/getNamaPelanggan'] = 'admin/getNamaPelanggan';
$route['admin/pengaturanPembayaran'] = 'admin/pengaturanPembayaran';
$route['admin/prosesPengaturanPembayaran'] = 'admin/prosesPengaturanPembayaran';
$route['admin/midtransSettings'] = 'admin/midtransSettings';
$route['admin/saveMidtransSettings'] = 'admin/saveMidtransSettings';
$route['admin/resetMidtransPayment/(:any)'] = 'admin/resetMidtransPayment/$1';

// Routing untuk dashboard user
$route['user'] = 'user';
$route['user/bayarPilihan'] = 'user/bayarPilihan';
$route['user/prosesPembayaranManual'] = 'user/prosesPembayaranManual'; // Rute baru
$route['user/prosesUploadBukti'] = 'user/prosesUploadBukti';
$route['user/uploadBukti/(:any)'] = 'user/uploadBukti/$1';
$route['user/prosesUploadBuktiSingle'] = 'user/prosesUploadBuktiSingle';
$route['user/ubahProfil'] = 'user/ubahProfil';
$route['user/prosesUbahProfil'] = 'user/prosesUbahProfil';
$route['user/laporPengontrak'] = 'user/laporPengontrak';
$route['user/prosesLaporPengontrak'] = 'user/prosesLaporPengontrak';
$route['user/hapusPengontrak/(:any)'] = 'user/hapusPengontrak/$1';
$route['user/lihatBuktiTransaksi/(:any)'] = 'user/lihatBuktiTransaksi/$1';
$route['user/bayarViaMidtrans'] = 'user/bayarViaMidtrans';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['midtrans_callback'] = 'midtrans_callback/handle';