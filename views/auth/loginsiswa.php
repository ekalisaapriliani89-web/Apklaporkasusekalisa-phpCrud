<?php
session_start();

// Jika siswa sudah login, lempar ke index utama
if (isset($_SESSION['siswa'])) {
    header("Location: /5APKLAPORKASUSEKALISA/index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Siswa - Lapor Kasus</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center" style="min-height: 100vh;">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5 col-lg-4">
            <div class="card border-0 shadow-sm p-3">
                <div class="card-body">
                    <h3 class="text-center fw-bold mb-1">Login Siswa</h3>
                    <p class="text-center text-muted small mb-4">Silakan masuk dengan Username Anda</p>

                    <!-- Notifikasi Pesan Error / Alert -->
                    <?php if (isset($_GET['pesan'])): ?>
                        <?php if ($_GET['pesan'] == 'gagal'): ?>
                            <div class="alert alert-danger text-center py-2 small mb-3">
                                Username atau Password salah!
                            </div>
                        <?php elseif ($_GET['pesan'] == 'kosong'): ?>
                            <div class="alert alert-warning text-center py-2 small mb-3">
                                Username dan Password wajib diisi!
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>

                    <!-- Form Login menuju proses/prosessiswa.php -->
                    <form action="/5APKLAPORKASUSEKALISA/proses/prosessiswa.php" method="POST">
                        <div class="mb-3">
                            <label for="username" class="form-label small fw-semibold">Username</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan Username" required autofocus>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label small fw-semibold">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 fw-bold mt-2">Masuk</button>
                    </form>

                    <div class="text-center mt-3 pt-2 border-top">
                        <a href="loginuser.php" class="text-decoration-none small">Login sebagai Petugas / Admin</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>