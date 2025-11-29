<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="<?= base_url('assets/sneat/'); ?>" data-template="vertical-menu-template-free">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Aplikasi IPL</title>
    <meta name="description" content="" />
    <link rel="icon" type="image/x-icon" href="<?= base_url('assets/sneat/img/favicon/favicon.ico'); ?>" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="<?= base_url('assets/sneat/vendor/fonts/boxicons.css'); ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/sneat/vendor/css/core.css'); ?>" class="template-customizer-core-css" />
    <link rel="stylesheet" href="<?= base_url('assets/sneat/vendor/css/theme-default.css'); ?>" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="<?= base_url('assets/sneat/css/demo.css'); ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/sneat/vendor/libs/perfect-scrollbar/perfect-scrollbar.css'); ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/css/custom.css'); ?>" />
    <script src="<?= base_url('assets/sneat/vendor/js/helpers.js'); ?>"></script>
    <script src="<?= base_url('assets/sneat/js/config.js'); ?>"></script>
    <style>
        @media screen and (max-width: 768px) {
            .table-responsive table {
                border: 0;
            }
            .table-responsive table thead {
                display: none;
            }
            .table-responsive table tr {
                margin-bottom: 10px;
                display: block;
                border: 1px solid #ddd;
            }
            .table-responsive table td {
                display: block;
                text-align: right;
                font-size: 13px;
                border-bottom: 1px dashed #ddd;
                position: relative;
                padding-left: 50%;
            }
            .table-responsive table td::before {
                content: attr(data-label);
                position: absolute;
                left: 0;
                width: 50%;
                padding-left: 15px;
                font-weight: bold;
                text-align: left;
            }
            .table-responsive table td:last-child {
                border-bottom: 0;
            }
        }
    </style>
</head>
<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">