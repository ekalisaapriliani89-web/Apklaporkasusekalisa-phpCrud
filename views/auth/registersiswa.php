<div class="d-flex justify-content-center py-4">
    <div class="card shadow-sm" style="width:100%;max-width:500px;border:1px solid #7e7e7e;border-radius:10px;">
        <div class="card-body p-4">
            <div class="text-center mb-3">
                <div class="mb-2">
                    <span class="d-inline-flex align-items-center justify-content-center bg-success text-white rounded-circle" style="width:60px;height:60px;">
                        <i class="fas fa-user-plus fa-2x"></i>
                    </span>
                </div>
                <h4 class="font-weight-bold mb-1">
                    Registrasi Siswa
                </h4>
                <p class="text-muted mb-0 small">
                    Buat akun siswa untuk Sistem Pengaduan & Lapor Kasus Sekalisa
                </p>
            </div>

            <?php if(isset($_SESSION['error_register'])) : ?>
                <div class="alert alert-danger">
                    <?= $_SESSION['error_register']; ?>
                </div>
                <?php unset($_SESSION['error_register']); ?>
            <?php endif; ?>

            <?php if(isset($_SESSION['success_register'])) : ?>
                <div class="alert alert-success">
                    <?= $_SESSION['success_register']; ?>
                </div>
                <?php unset($_SESSION['success_register']); ?>
            <?php endif; ?>

            <form action="proses/prosessiswa.php?aksi=register" method="POST" enctype="multipart/form-data">
                <div class="form-group mb-3">
                    <label class="mb-1">
                        <i class="fas fa-user mr-1 text-success"></i>
                        Nama Siswa
                    </label>
                    <input type="text" name="namasiswasiswa" class="form-control" placeholder="Masukkan nama lengkap siswa" required autofocus>
                </div>

                <div class="form-group mb-3">
                    <label class="mb-1">
                        <i class="fas fa-id-card mr-1 text-success"></i>
                        NIS / Username
                    </label>
                    <input type="text" name="username" class="form-control" placeholder="Masukkan NIS atau username" required>
                </div>

                <div class="form-group mb-3">
                    <label class="mb-1">
                        <i class="fas fa-phone mr-1 text-success"></i>
                        No HP
                    </label>
                    <input type="text" name="nohpsiswa" class="form-control" placeholder="08xxxxxxxxxx">
                </div>

                <div class="form-group mb-3">
                    <label class="mb-1">
                        <i class="fas fa-map-marker-alt mr-1 text-success"></i>
                        Alamat
                    </label>
                    <textarea name="alamatsiswa" rows="3" class="form-control" placeholder="Masukkan alamat lengkap"></textarea>
                </div>

                <div class="form-group mb-3">
                    <label class="mb-1">
                        <i class="fas fa-image mr-1 text-success"></i>
                        Foto Profil
                    </label>
                    <input type="file" name="fotosiswa" class="form-control" accept=".jpg,.jpeg,.png,.webp">
                    <small class="text-muted">
                        JPG, PNG atau WEBP maksimal 2 MB
                    </small>
                </div>

                <div class="form-group mb-3">
                    <label class="mb-1">
                        <i class="fas fa-lock mr-1 text-success"></i>
                        Password
                    </label>
                    <div class="input-group">
                        <input type="password" name="password" id="passwordRegister" class="form-control" placeholder="Buat password" required>
                        <div class="input-group-append">
                            <button type="button" class="btn btn-outline-secondary" id="togglePasswordRegister">
                                <i class="fas fa-eye"></i>