<?php
/*
|--------------------------------------------------------------------------
| DASHBOARD ADMIN - APLIKASI LAPOR KASUS SEKALISA
|--------------------------------------------------------------------------
| Zona    : User / Admin
| Layout  : AdminLTE
| Project : Aplikasi Lapor Kasus Sekalisa
|--------------------------------------------------------------------------
*/

/** @var mysqli $koneksi */

// Helper Angka
if (!function_exists('angka')) {
    function angka($val) {
        return number_format((float)$val, 0, ',', '.');
    }
}

/*
|--------------------------------------------------------------------------
| STATISTIK DATA MASTER
|--------------------------------------------------------------------------
*/
$totalUser      = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM user"))['total'] ?? 0;
$totalSiswa     = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM siswa"))['total'] ?? 0;
$totalKasus     = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM kasus"))['total'] ?? 0;
$totalKategori  = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM kategori"))['total'] ?? 0;
$totalSanksi    = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM sanksi"))['total'] ?? 0;

/*
|--------------------------------------------------------------------------
| REKAP LAPORAN / PENGAJUAN
|--------------------------------------------------------------------------
*/
$totalPengajuan = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM pengajuan"))['total'] ?? 0;

// Laporan Hari Ini
$queryHariIni   = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM pengajuan WHERE DATE(tanggallapor) = CURDATE()");
$laporanHariIni = mysqli_fetch_assoc($queryHariIni)['total'] ?? 0;

// Laporan Bulan Ini
$queryBulanIni   = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM pengajuan WHERE MONTH(tanggallapor) = MONTH(CURDATE()) AND YEAR(tanggallapor) = YEAR(CURDATE())");
$laporanBulanIni = mysqli_fetch_assoc($queryBulanIni)['total'] ?? 0;

/*
|--------------------------------------------------------------------------
| STATUS PENANGANI LAPORAN
|--------------------------------------------------------------------------
*/
$totalPending   = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM pengajuan WHERE LOWER(status) = 'pending' OR LOWER(status) = 'menunggu'"))['total'] ?? 0;
$totalDiproses  = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM pengajuan WHERE LOWER(status) = 'diproses' OR LOWER(status) = 'ditangani'"))['total'] ?? 0;
$totalSelesai   = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM pengajuan WHERE LOWER(status) = 'selesai' OR LOWER(status) = 'disetujui'"))['total'] ?? 0;

/*
|--------------------------------------------------------------------------
| LAPORAN PENGAJUAN TERBARU
|--------------------------------------------------------------------------
*/
$queryPengajuanTerbaru = mysqli_query($koneksi,
    "SELECT 
        p.*, 
        s.namasiswa, 
        k.namakasus, 
        kt.namakategori
     FROM pengajuan p
     LEFT JOIN siswa s ON p.idsiswa = s.idsiswa
     LEFT JOIN kasus k ON p.idkasus = k.idkasus
     LEFT JOIN kategori kt ON k.idkategori = kt.idkategori
     ORDER BY p.idpengajuan DESC
     LIMIT 5"
);

/*
|--------------------------------------------------------------------------
| KASUS PREDOMINAN / SERING DILAPORKAN
|--------------------------------------------------------------------------
*/
$queryKasusPopuler = mysqli_query($koneksi,
    "SELECT 
        k.namakasus, 
        k.tingkatbahaya, 
        COUNT(p.idpengajuan) AS total_lapor
     FROM kasus k
     LEFT JOIN pengajuan p ON k.idkasus = p.idkasus
     GROUP BY k.idkasus
     ORDER BY total_lapor DESC
     LIMIT 5"
);

// Nama Bulan Bahasa Indonesia
$bulanSekarang = [
    1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
    5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
    9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
];
$namaBulan =$bulanSekarang[(int) date('n')];
?>

<!-- ==============================================================
     CONTENT HEADER
================================================================ -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2 align-items-center">
            <div class="col-sm-8">
                <h1 class="m-0 font-weight-bold">
                    <i class="fas fa-tachometer-alt mr-2 text-danger"></i>
                    Dashboard Admin
                </h1>
                <p class="text-muted mb-0 mt-1">
                    Selamat datang kembali, 
                    <strong><?= htmlspecialchars($_SESSION['namauser'] ?? 'Administrator'); ?></strong>. 
                    Berikut ringkasan aktivitas pengaduan Lapor Kasus ekalisa.
                </p>
            </div>
            <div class="col-sm-4">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="index.php?halaman=dashboardadmin"><i class="fas fa-home"></i></a>
                    </li>
                    <li class="breadcrumb-item active">Dashboard Admin</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- ==============================================================
     CONTENT MAIN
================================================================ -->
<div class="content">
    <div class="container-fluid">

        <!-- WELCOME BANNER -->
        <div class="card bg-danger shadow-sm mb-4">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h3 class="font-weight-bold mb-2">
                            <i class="fas fa-shield-alt mr-2"></i> Aplikasi Lapor Kasus Ekalisa
                        </h3>
                        <p class="mb-3">
                            Pusat pengelolaan dan monitoring laporan pelanggaran siswa. Kelola data siswa, kasus, kategori, pengajuan pengaduan, penanganan, serta rincian sanksi dalam satu portal terpadu.
                        </p>
                        <a href="index.php?halaman=pengajuan" class="btn btn-light btn-sm mr-2 font