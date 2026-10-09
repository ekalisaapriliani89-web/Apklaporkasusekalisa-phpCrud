<?php
/*
|--------------------------------------------------------------------------
| PROSES DASHBOARD USER / SISWA - APLIKASI LAPOR KASUS SEKALISA
|--------------------------------------------------------------------------
| Path    : proses/prosesdashboarduser.php
| Project : Aplikasi Lapor Kasus Sekalisa
|--------------------------------------------------------------------------
*/

// Aktifkan session jika belum aktif
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Sertakan file koneksi database
$pathKoneksi = __DIR__ . '/../koneksi.php';
if (file_exists($pathKoneksi)) {
    include $pathKoneksi;
} else {
    include 'koneksi.php';
}

/** @var mysqli $koneksi */

// Validasi hak akses: Pastikan yang mengakses adalah siswa
if (!isset($_SESSION['idsiswa']) && (!isset($_SESSION['role']) || $_SESSION['role'] !== 'siswa')) {
    echo "<script>alert('Akses ditolak! Silakan login terlebih dahulu.'); window.location='../index.php?halaman=loginsiswa';</script>";
    exit();
}

$idsiswa = $_SESSION['idsiswa'] ?? 0;
$aksi    = $_GET['aksi'] ?? '';

// Fungsi atau aksi tambahan khusus dashboard user jika diperlukan (misalnya refresh statistik, ambil data JSON, dsb)
if ($aksi == 'get_statistik') {
    header('Content-Type: application/json');

    $totalLaporan = (int) (mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM pengajuan WHERE idsiswa = '$idsiswa'"))['total'] ?? 0);
    $selesai      = (int) (mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM pengajuan WHERE idsiswa = '$idsiswa' AND (LOWER(status) = 'selesai' OR LOWER(status) = 'disetujui')"))['total'] ?? 0);
    $diproses     = (int) (mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM pengajuan WHERE idsiswa = '$idsiswa' AND (LOWER(status) = 'diproses' OR LOWER(status) = 'ditangani' OR LOWER(status) = 'pending')"))['total'] ?? 0);

    echo json_encode([
        'status'   => 'success',
        'total'    => $totalLaporan,
        'selesai'  => $selesai,
        'diproses' => $diproses
    ]);
    exit();
}
?>