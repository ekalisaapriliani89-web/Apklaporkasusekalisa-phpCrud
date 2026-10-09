<?php
/*
|--------------------------------------------------------------------------
| DASHBOARD PETUGAS - APLIKASI LAPOR KASUS SEKALISA
|--------------------------------------------------------------------------
| Zona    : User / Petugas BK
| Layout  : AdminLTE
| Project : Aplikasi Lapor Kasus Sekalisa
|--------------------------------------------------------------------------
*/

/** @var mysqli $koneksi */

// Helper Format Angka
if (!function_exists('angka')) {
    function angka($val) {
        return number_format((float)$val, 0, ',', '.');
    }
}

// Total Data Master & Laporan Kasus
$totalKasus     = (int) (mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM kasus"))['total'] ?? 0);
$totalSiswa     = (int) (mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM siswa"))['total'] ?? 0);
$totalKategori  = (int) (mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM kategori"))['total'] ?? 0);
$totalPengajuan = (int) (mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM pengajuan"))['total'] ?? 0);

// Status Pengajuan Kasus
$laporanPending  = (int) (mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM pengajuan WHERE LOWER(status) = 'pending' OR LOWER(status) = 'menunggu'"))['total'] ?? 0);
$laporanDiproses = (int) (mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM pengajuan WHERE LOWER(status) = 'diproses' OR LOWER(status) = 'ditangani'"))['total'] ?? 0);
?>

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="font-weight-bold">
                    <i class="fas fa-user-shield text-success mr-2"></i>Dashboard Petugas BK
                </h1>
            </div>
            <div class="col-sm-6 text-right">
                <small class="text-muted">
                    <i class="far fa-calendar-alt mr-1"></i>
                    <?= function_exists('tanggalIndonesia') ? tanggalIndonesia(date('Y-m-d')) : date('d F Y'); ?>
                </small>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">

        <!-- WELCOME BANNER -->
        <div class="card bg-gradient-success shadow-sm mb-4 border-0">
            <div class="card-body p-4 text-white">
                <h3 class="font-weight-bold mb-2">
                    Selamat Datang, <?= htmlspecialchars($_SESSION['namauser'] ?? 'Petugas BK'); ?> 👋
                </h3>
                <p class="mb-0">
                    Kelola verifikasi laporan pengaduan, tindak lanjut penanganan kasus siswa, serta penetapan sanksi secara cepat dan transparan.
                </p>
            </div>
        </div>

        <!-- STATISTIK WIDGET -->
        <div class="row">
            <!-- MASTER KASUS -->
            <div class="col-lg-3 col-6">
                <div class="small-box bg-primary elevation-2">
                    <div class="inner">
                        <h3><?= angka($totalKasus); ?></h3>
                        <p>Jenis Kasus</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <a href="index.php?halaman=kasus" class="small-box-footer">
                        Detail Kasus <i class="fas fa-arrow-circle-right ml-1"></i>
                    </a>
                </div>
            </div>

            <!-- DATA SISWA -->
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success elevation-2">
                    <div class="inner">
                        <h3><?= angka($totalSiswa); ?></h3>
                        <p>Data Siswa</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <a href="index.php?halaman=siswa" class="small-box-footer">
                        Detail Siswa <i class="fas fa-arrow-circle-right ml-1"></i>
                    </a>
                </div>
            </div>

            <!-- KATEGORI KASUS -->
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning elevation-2">
                    <div class="inner text-white">
                        <h3 class="text-white"><?= angka($totalKategori); ?></h3>
                        <p class="text-white">Kategori Kasus</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-tags"></i>
                    </div>
                    <a href="index.php?halaman=kategori" class="small-box-footer" style="color: #fff !important;">
                        Detail Kategori <i class="fas fa-arrow-circle-right ml-1"></i>
                    </a>
                </div>
            </div>

            <!-- TOTAL PENGAJUAN -->
            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger elevation-2">
                    <div class="inner">
                        <h3><?= angka($totalPengajuan); ?></h3>
                        <p>Total Laporan Masuk</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <a href="index.php?halaman=pengajuan" class="small-box-footer">
                        Kelola Laporan <i class="fas fa-arrow-circle-right ml-1"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- MAIN PANEL NAVIGASI & INFORMASI PROFIL -->
        <div class="row">
            <!-- AKSES CEPAT TUGAS PETUGAS -->
            <div class="col-md-8">
                <div class="card card-outline card-success shadow-sm border-0">
                    <div class="card-header bg-white py-3">
                        <h3 class="card-title font-weight-bold text-dark">
                            <i class="fas fa-tasks text-success mr-2"></i>Aktivitas Penanganan Kasus
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-md-3 col-6 mb-3">
                                <a href="index.php?halaman=pengajuan" class="btn btn-app btn-block bg-primary">
                                    <span class="badge badge-warning"><?= $laporanPending; ?></span>
                                    <i class="fas fa-file-invoice"></i> Verifikasi Laporan
                                </a>
                            </div>
                            <div class="col-md-3 col-6 mb-3">
                                <a href="index.php?halaman=penanganan" class="btn btn-app btn-block bg-warning text-white">
                                    <span class="badge badge-light"><?= $laporanDiproses; ?></span>
                                    <i class="fas fa-hand-holding-heart"></i> Penanganan Kasus
                                </a>
                            </div>
                            <div class="col-md-3 col-6 mb-3">
                                <a href="index.php?halaman=kasus" class="btn btn-app btn-block bg-danger">
                                    <i class="fas fa-folder-open"></i> Master Kasus
                                </a>
                            </div>
                            <div class="col-md-3 col-6 mb-3">
                                <a href="index.php?halaman=siswa" class="btn btn-app btn-block bg-success">
                                    <i class="fas fa-users"></i> Data Siswa
                                </a>
                            </div>
                        </div>

                        <div class="alert alert-info border-0 mt-2 mb-0">
                            <i class="fas fa-info-circle mr-1"></i>
                            Terdapat <strong><?= $laporanPending; ?> laporan baru</strong> yang membutuhkan verifikasi dan tindak lanjut dari Petugas/Guru BK.
                        </div>
                    </div>
                </div>
            </div>

            <!-- INFORMASI AKUN PETUGAS -->
            <div class="col-md-4">
                <div class="card card-outline card-success shadow-sm border-0">
                    <div class="card-header bg-white py-3">
                        <h3 class="card-title font-weight-bold text-dark">
                            <i class="fas fa-user-circle text-success mr-1"></i> Informasi Akun
                        </h3>
                    </div>
                    <div class="card-body text-center">
                        <?php 
                        $fotoUser = !empty($_SESSION['foto']) ? $_SESSION['foto'] : 'default.png';
                        ?>
                        <img
                            src="assets/images/user/<?= $fotoUser; ?>"
                            class="img-circle elevation-2 mb-3"
                            style="width:90px; height:90px; object-fit:cover;"
                            alt="Foto Petugas"
                            onerror="this.src='assets/images/user/default.png';">

                        <h5 class="font-weight-bold mb-1">
                            <?= htmlspecialchars($_SESSION['namauser'] ?? 'Petugas BK'); ?>
                        </h5>

                        <span class="badge badge-success px-3 py-1 mb-3">
                            <i class="fas fa-shield-alt mr-1"></i>
                            <?= strtoupper(htmlspecialchars($_SESSION['role'] ?? 'PETUGAS')); ?>
                        </span>

                        <hr class="my-3">

                        <a href="index.php?halaman=logout" class="btn btn-danger btn-block font-weight-bold">
                            <i class="fas fa-sign-out-alt mr-1"></i> Logout Sistem
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>