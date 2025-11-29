<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="<?= base_url('admin'); ?>" class="app-brand-link">
            <span class="app-brand-text demo menu-text fw-bolder ms-2">Admin IPL</span>
        </a>
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>
    <div class="menu-inner-shadow"></div>
    <ul class="menu-inner py-1">
        <li class="menu-item active">
            <a href="<?= base_url('admin'); ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Dashboard">Dashboard</div>
            </a>
        </li>
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Kelola Data</span></li>
        <li class="menu-item">
            <a href="<?= base_url('admin/kelolaAkun'); ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-group"></i>
                <div data-i18n="Kelola Akun">Kelola Akun</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="<?= base_url('admin/inputTagihan'); ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-money"></i>
                <div data-i18n="Input Tagihan">Input Tagihan</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="<?= base_url('admin/konfirmasiPembayaran'); ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-check-double"></i>
                <div data-i18n="Konfirmasi Pembayaran">Konfirmasi Pembayaran</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="<?= base_url('admin/semuaTagihan'); ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-list-ul"></i>
                <div data-i18n="Daftar Semua Tagihan">Daftar Semua Tagihan</div>
            </a>
        </li>
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Pengaturan</span></li>
        <li class="menu-item">
            <a href="<?= base_url('admin/pengaturanPembayaran'); ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-cog"></i>
                <div data-i18n="Pengaturan Pembayaran">Pengaturan Pembayaran</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="<?= base_url('admin/midtransSettings'); ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-key"></i>
                <div data-i18n="Pengaturan Midtrans">Pengaturan Midtrans</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="<?= base_url('admin/ubahProfil'); ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div data-i18n="Ubah Profil">Ubah Profil</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="#" class="menu-link" data-bs-toggle="modal" data-bs-target="#logoutModal">
                <i class="menu-icon tf-icons bx bx-power-off"></i>
                <div data-i18n="Logout">Logout</div>
            </a>
        </li>
    </ul>
</aside>
<div class="layout-page">
    <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
        <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
            </a>
        </div>
        <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
            <ul class="navbar-nav flex-row align-items-center ms-auto">
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                        <div class="avatar avatar-online">
                            <img src="<?= base_url('assets/sneat/img/avatars/1.png'); ?>" alt class="w-px-40 h-auto rounded-circle" />
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="#">
                                <div class="d-flex">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar avatar-online">
                                            <img src="<?= base_url('assets/sneat/img/avatars/1.png'); ?>" alt class="w-px-40 h-auto rounded-circle" />
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <span class="fw-semibold d-block"><?= $this->session->userdata('username'); ?></span>
                                        <small class="text-muted">Admin</small>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li><div class="dropdown-divider"></div></li>
                        <li>
                            <a class="dropdown-item" href="<?= base_url('admin/ubahProfil'); ?>">
                                <i class="bx bx-user me-2"></i>
                                <span class="align-middle">My Profile</span>
                            </a>
                        </li>
                        <li><div class="dropdown-divider"></div></li>
                        <li>
                            <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#logoutModal">
                                <i class="bx bx-power-off me-2"></i>
                                <span class="align-middle">Log Out</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">