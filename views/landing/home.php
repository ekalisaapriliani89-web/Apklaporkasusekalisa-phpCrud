<?php
/*
|--------------------------------------------------------------------------
| DATA HOMEPAGE - LAPOR KASUS SEKALISA
|--------------------------------------------------------------------------
|
| koneksi.php sudah dipanggil melalui index.php
|
*/

/** @var mysqli $koneksi */

// Function helper angka jika belum terdefinisi global
if (!function_exists('angka')) {
    function angka($val) {
        return number_format((float)$val, 0, ',', '.');
    }
}

/*
|--------------------------------------------------------------------------
| STATISTIK UTAMA
|--------------------------------------------------------------------------
*/
// Total Pengajuan / Laporan Masuk
$qTotalPengajuan = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM pengajuan");
$totalPengajuan  = mysqli_fetch_assoc($qTotalPengajuan)['total'] ?? 0;

// Total Data Siswa Terdaftar
$qTotalSiswa = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM siswa");
$totalSiswa  = mysqli_fetch_assoc($qTotalSiswa)['total'] ?? 0;

// Total Jenis Kasus
$qTotalKasus = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM kasus");
$totalKasus  = mysqli_fetch_assoc($qTotalKasus)['total'] ?? 0;

/*
|--------------------------------------------------------------------------
| KATEGORI KASUS UNGGULAN
|--------------------------------------------------------------------------
*/
$queryKategori = mysqli_query($koneksi,
    "SELECT * FROM kategori ORDER BY idkategori DESC LIMIT 4"
);

/*
|--------------------------------------------------------------------------
| DAFTAR KASUS TERBARU / SERING DITANGANI
|--------------------------------------------------------------------------
*/
$queryKasus = mysqli_query($koneksi,
    "SELECT 
        k.*, 
        kt.namakategori 
     FROM kasus k
     LEFT JOIN kategori kt ON k.idkategori = kt.idkategori
     ORDER BY k.idkasus DESC 
     LIMIT 4"
);
?>

<!-- =====================================================
     HERO SECTION
===================================================== -->
<section
    class="text-center text-white"
    style="
        height: 60vh;
        background: url('assets/images/slider/hero.jpg') center center/cover no-repeat;
        position: relative;
    ">
    <div
        style="
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.6);
        ">
    </div>
    <div
        class="d-flex flex-column justify-content-center align-items-center h-100 px-3"
        style="position: relative;">
        <h1 class="display-4 font-weight-bold">
            Selamat Datang di Portal<br>
            Lapor Kasus Sekalisa
        </h1>
        <p class="lead">
            Layanan pengaduan dan pelaporan masalah di lingkungan sekolah secara aman, transparan, dan terintegrasi.
        </p>
        <a
            href="index.php?halaman=loginsiswa"
            class="btn btn-primary btn-lg mt-2">
            <i class="fas fa-paper-plane mr-2"></i>
            Buat Laporan Sekarang
        </a>
    </div>
</section>

<!-- =====================================================
     TENTANG SINGKAT
===================================================== -->
<section class="content my-4">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h2>Layanan Pengaduan Sekalisa</h2>
                <p class="lead text-muted">
                    Sistem Lapor Kasus mempermudah siswa melaporkan setiap bentuk pelanggaran atau kejadian di sekolah untuk ditindaklanjuti secara cepat oleh tim Bimbingan Konseling dan Petugas.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- =====================================================
     STATISTIK SISTEM
===================================================== -->
<section class="content my-4">
    <div class="container">
        <div class="row">
            <!-- TOTAL LAPORAN MASUK -->
            <div class="col-md-4">
                <div class="small-box bg-info elevation-2">
                    <div class="inner">
                        <h3><?= angka($totalPengajuan); ?></h3>
                        <p>Total Laporan Masuk</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <a href="index.php?halaman=daftarkasus" class="small-box-footer">
                        Lihat Jenis Kasus <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <!-- TOTAL SISWA TERDAFTAR -->
            <div class="col-md-4">
                <div class="small-box bg-success elevation-2">
                    <div class="inner">
                        <h3><?= angka($totalSiswa); ?></h3>
                        <p>Siswa Terdaftar</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <a href="index.php?halaman=registersiswa" class="small-box-footer">
                        Daftar Akun Siswa <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <!-- TOTAL KATEGORI KASUS -->
            <div class="col-md-4">
                <div class="