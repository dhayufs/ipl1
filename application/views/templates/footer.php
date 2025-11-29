</div>
    </div>
    <div class="layout-overlay layout-menu-toggle"></div>
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logoutModalLabel">Siap untuk keluar?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">Pilih "Logout" di bawah jika Anda siap untuk mengakhiri sesi saat ini.</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <a class="btn btn-primary" href="<?= base_url('auth/logout'); ?>">Logout</a>
                </div>
            </div>
        </div>
    </div>
    <script src="<?= base_url('assets/sneat/vendor/libs/jquery/jquery.js'); ?>"></script>
    <script src="<?= base_url('assets/sneat/vendor/libs/popper/popper.js'); ?>"></script>
    <script src="<?= base_url('assets/sneat/vendor/js/bootstrap.js'); ?>"></script>
    <script src="<?= base_url('assets/sneat/vendor/libs/perfect-scrollbar/perfect-scrollbar.js'); ?>"></script>
    <script src="<?= base_url('assets/sneat/vendor/js/menu.js'); ?>"></script>
    <script src="<?= base_url('assets/sneat/js/main.js'); ?>"></script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>
</html>