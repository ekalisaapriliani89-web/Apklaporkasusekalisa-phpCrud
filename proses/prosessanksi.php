<?php
/*
|--------------------------------------------------------------------------
| PROSES SANKSI - APLIKASI LAPOR KASUS SEKALISA
|--------------------------------------------------------------------------
| Path    : proses/prosessanksi.php
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

$aksi = $_GET['aksi'] ?? '';

// ==========================================================
// 1. PROSES TAMBAH SANKSI BARU
// ==========================================================
if ($aksi == 'tambah') {
    $namasanksi = mysqli_real_escape_string($koneksi, $_POST['namasanksi'] ?? '');
    $tingkat    = mysqli_real_escape_string($koneksi, $_POST['tingkat'] ?? 'Sedang');
    $keterangan = mysqli_real_escape_string($koneksi, $_POST['keterangan'] ?? '');

    $query = "INSERT INTO sanksi (namasanksi, tingkat, keterangan) VALUES ('$namasanksi', '$tingkat', '$keterangan')";
    
    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Data sanksi berhasil ditambahkan!'); window.location='../index.php?halaman=sanksi';</script>";
        exit();
    } else {
        echo "<script>alert('Gagal menambah data sanksi!'); window.location='../index.php?halaman=createsanksi';</script>";
        exit();
    }
} 

// ==========================================================
// 2. PROSES UBAH / EDIT SANKSI
// ==========================================================
elseif ($aksi == 'ubah') {
    $idsanksi   = (int) ($_POST['idsanksi'] ?? 0);
    $namasanksi = mysqli_real_escape_string($koneksi, $_POST['namasanksi'] ?? '');
    $tingkat    = mysqli_real_escape_string($koneksi, $_POST['tingkat'] ?? 'Sedang');
    $keterangan = mysqli_real_escape_string($koneksi, $_POST['keterangan'] ?? '');

    $query = "UPDATE sanksi SET 
                namasanksi = '$namasanksi', 
                tingkat = '$tingkat', 
                keterangan = '$keterangan' 
              WHERE idsanksi = '$idsanksi'";
              
    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Data sanksi berhasil diperbarui!'); window.location='../index.php?halaman=sanksi';</script>";
        exit();
    } else {
        echo "<script>alert('Gagal memperbarui data sanksi!'); window.location='../index.php?halaman=editsanksi&id=$idsanksi';</script>";
        exit();
    }
} 

// ==========================================================
// 3. PROSES HAPUS SANKSI
// ==========================================================
elseif ($aksi == 'hapus') {
    $idsanksi = (int) ($_GET['id'] ?? 0);

    $queryHapus = "DELETE FROM sanksi WHERE idsanksi = '$idsanksi'";
    
    if (mysqli_query($koneksi, $queryHapus)) {
        echo "<script>alert('Data sanksi berhasil dihapus!'); window.location='../index.php?halaman=sanksi';</script>";
        exit();
    } else {
        echo "<script>alert('Gagal menghapus data sanksi! Pastikan sanksi ini tidak sedang digunakan pada penanganan kasus.'); window.location='../index.php?halaman=sanksi';</script>";
        exit();
    }
} else {
    header("Location: ../index.php?halaman=sanksi");
    exit();
}
?>