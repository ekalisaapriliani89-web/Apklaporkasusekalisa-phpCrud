<?php
session_start();

// Redirect otomatis jika sudah login
if (isset($_SESSION['user'])) {
    header("Location: views/kasus/index.php");
    exit;
} elseif (isset($_SESSION['siswa'])) {
    header("Location: views/siswa/index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Lapor Kasus - Selamat Datang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php">LAPOR KASUS</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-brand navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link active" href="index.php">Home</a></li>
            </ul>
            <div class="d-flex gap-2">
                <a href="views/auth/loginsiswa.php" class="btn btn-light text-primary fw-semibold">Login Siswa</a>
                <a href="views/auth/login.php" class="btn btn-outline-light fw-semibold">Login Petugas/Admin</a>
            </div>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<div class="bg-primary text-white text-center py-5">
    <div class="container py-4">
        <h1 class="display-4 fw-bold mb-3">Layanan Pengaduan & Lapor Kasus Sekolah</h1>
        <p class="lead mb-4">Sistem pelaporan aman, cepat, dan terintegrasi untuk menjaga lingkungan sekolah yang kondusif dan bebas dari tindakan pelanggaran.</p>
        <div class="d-flex justify-content-center gap-3">
            <a href="views/auth/loginsiswa.php" class="btn btn-warning btn-lg fw-bold px-4">Buat Laporan Sekarang</a>
            <a href="views/auth/loginsiswa.php" class="btn btn-outline-light btn-lg px-4">Lihat Panduan</a>
        </div>
    </div>
</div>

<!-- Features -->
<div class="container my-5">
    <div class="row g-4 text-center">
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm p-3">
                <div class="card-body">
                    <h5 class="fw-bold text-primary mb-3">Kerahasiaan Terjamin</h5>
                    <p class="text-muted">Laporan yang kamu kirimkan diproses secara tertutup dan hanya dapat diakses oleh tim pengawas/petugas resmi.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm p-3">
                <div class="card-body">
                    <h5 class="fw-bold text-primary mb-3">Penanganan Cepat</h5>
                    <p class="text-muted">Petugas dan Guru BK akan langsung menindaklanjuti setiap pengajuan laporan secara transparan.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm p-3">
                <div class="card-body">
                    <h5 class="fw-bold text-primary mb-3">Pantau Status Kasus</h5>
                    <p class="text-muted">Siswa dapat memantau perkembangan status penanganan laporan secara realtime dari dashboard akun.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="bg-dark text-white text-center py-4 mt-5">
    <div class="container">
        <p class="mb-1">&copy; <?= date('Y'); ?> Sistem Lapor Kasus Elisa. All rights reserved.</p>
        <small class="text-muted">Layanan Pengaduan & Layanan Bimbingan Siswa Sekolah</small>
    </div>
</footer>

</body>
</html>