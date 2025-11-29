<h1 class="h3 mb-4 text-gray-800">Dashboard Utama Admin</h1>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Selamat Datang</h6>
                    </div>
                    <div class="card-body">
                        <p>Selamat datang, admin! Silakan gunakan menu di samping untuk mengelola data tagihan dan pembayaran.</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-6 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Total Tagihan Belum Lunas (Termasuk Pending)</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            Rp <?= number_format($total_belum_lunas, 0, ',', '.'); ?>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Total Tagihan Sudah Lunas</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            Rp <?= number_format($total_lunas, 0, ',', '.'); ?>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-check fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>