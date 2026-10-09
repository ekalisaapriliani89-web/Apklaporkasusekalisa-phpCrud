<?php
/*
|--------------------------------------------------------------------------
| PROSES LAPORAN / CETAK - APLIKASI LAPOR KASUS SEKALISA
|--------------------------------------------------------------------------
| Path    : proses/proseslaporan.php
| Project : Aplikasi Lapor Kasus Sekalisa
|--------------------------------------------------------------------------
*/

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$pathKoneksi = __DIR__ . '/../koneksi.php';
if (file_exists($pathKoneksi)) {
    include $pathKoneksi;
} else {
    include 'koneksi.php';
}

/** @var mysqli $koneksi */

// Ambil parameter jenis laporan yang ingin dicetak
$jenis = $_GET['jenis'] ?? '';

// ==========================================================
// 1. PROSES LAPORAN HARIAN
// ==========================================================
if ($jenis == 'harian') {
    $tanggal = $_GET['tanggal'] ?? date('Y-m-d');
    
    // Redirect ke file cetak laporan harian dengan membawa parameter tanggal
    header("Location: ../views/user/laporan/cetaklaporanharian.php?tanggal=$tanggal");
    exit();
} 

// ==========================================================
// 2. PROSES LAPORAN BULANAN
// ==========================================================
elseif ($jenis == 'bulanan') {
    $bulan = $_GET['bulan'] ?? date('m');
    $tahun = $_GET['tahun'] ?? date('Y');
    
    // Redirect ke file cetak laporan bulanan dengan membawa parameter bulan & tahun
    header("Location: ../views/user/laporan/cetaklaporanbulanan.php?bulan=$bulan&tahun=$tahun");
    exit();
} 

// ==========================================================
// 3. PROSES LAPORAN TAHUNAN
// ==========================================================
elseif ($jenis == 'tahunan') {
    $tahun = $_GET['tahun'] ?? date('Y');
    
    // Redirect ke file cetak laporan tahunan dengan membawa parameter tahun
    header("Location: ../views/user/laporan/cetaklaporantahunan.php?tahun=$tahun");
    exit();
} 

// ==========================================================
// DEFAULT / JIKA AKSES TIDAK VALID
// ==========================================================
else {
    echo "<script>alert('Aksi atau jenis laporan tidak valid!'); window.location='../index.php?halaman=dashboardadmin';</script>";
    exit();
}
?>