<?php
require_once '../../proses/koneksi.php';

// Ambil ringkasan statistik singkat untuk publik
$totalKasus = $pdo->query("SELECT COUNT(*) FROM kasus")->fetchColumn();
$totalKategori = $pdo->query("SELECT COUNT(*) FROM kategori")->fetchColumn();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Lapor Kasus - Selamat Datang</title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light d-flex flex-column min-vh-100">

<?php include '../component/tamu/navbar.php'; ?>

<!-- Hero Section -->
<div class="bg-primary text-white py-5">
    <div class="container text-center py-4">
        <h1 class="display-4 fw-bold">Layanan Pengaduan & Lapor Kasus Sekolah</h1>
        <p class="lead col-md-8 mx-auto">Sistem pelaporan aman, cepat, dan terintegrasi untuk menjaga lingkungan sekolah yang kondusif dan bebas dari tindakan pelanggaran.</p>
        <div class="mt-4">
            <a href="../auth/loginsiswa.php" class="btn btn-warning btn-lg me-2 fw-bold">Buat Laporan Sekarang</a>
            <a href="panduan.php" class="btn btn-outline-light btn-lg">Lihat Panduan</a>
        </div>
    </div>
</div>

<!-- Informasi Fitur Utama -->
<div class="container my-5">
    <div class="row text-center g-4">
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm p-3">
                <div class="card-body">
                    <h5 class="card-title fw-bold text-primary">Kerahasiaan Terjamin</h5>
                    <p class="card-text text-muted">Laporan yang kamu kirimkan diproses secara tertutup dan hanya dapat diakses oleh tim pengawas/petugas resmi.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm p-3">
                <div class="card-body">
                    <h5 class="card-title fw-bold text-primary">Penanganan Cepat</h5>
                    <p class="card-text text-muted">Petugas dan Guru BK akan langsung menindaklanjuti setiap pengajuan laporan secara transparan.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm p-3">
                <div class="card-body">
                    <h5 class="card-title fw-bold text-primary">Pantau Status Kasus</h5>
                    <p class="card-text text-muted">Siswa dapat memantau perkembangan status penanganan laporan secara realtime dari dashboard akun.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../component/tamu/footer.php'; ?>

</body>
</html>