<?php
/*
|--------------------------------------------------------------------------
| PROSES KATEGORI - APLIKASI LAPOR KASUS SEKALISA
|--------------------------------------------------------------------------
| Path    : proses/proseskategori.php
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
// 1. PROSES TAMBAH KATEGORI BARU
// ==========================================================
if ($aksi == 'tambah') {
    $namakategori = mysqli_real_escape_string($koneksi, $_POST['namakategori'] ?? '');
    $keterangan   = mysqli_real_escape_string($koneksi, $_POST['keterangan'] ?? '');

    $query = "INSERT INTO kategori (namakategori, keterangan) VALUES ('$namakategori', '$keterangan')";
    
    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Data kategori kasus berhasil ditambahkan!'); window.location='../index.php?halaman=kategori';</script>";
        exit();
    } else {
        echo "<script>alert('Gagal menambahkan data kategori!'); window.location='../index.php?halaman=createkategori';</script>";
        exit();
    }
} 

// ==========================================================
// 2. PROSES UBAH / EDIT KATEGORI
// ==========================================================
elseif ($aksi == 'ubah') {
    $idkategori   = (int) ($_POST['idkategori'] ?? 0);
    $namakategori = mysqli_real_escape_string($koneksi, $_POST['namakategori'] ?? '');
    $keterangan   = mysqli_real_escape_string($koneksi, $_POST['keterangan'] ?? '');

    $query = "UPDATE kategori SET 
                namakategori = '$namakategori', 
                keterangan = '$keterangan' 
              WHERE idkategori = '$idkategori'";
    
    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Data kategori kasus berhasil diperbarui!'); window.location='../index.php?halaman=kategori';</script>";
        exit();
    } else {
        echo "<script>alert('Gagal memperbarui data kategori!'); window.location='../index.php?halaman=editkategori&id=$idkategori';</script>";
        exit();
    }
} 

// ==========================================================
// 3. PROSES HAPUS KATEGORI
// ==========================================================
elseif ($aksi == 'hapus') {
    $idkategori = (int) ($_GET['id'] ?? 0);

    $queryHapus = "DELETE FROM kategori WHERE idkategori = '$idkategori'";
    
    if (mysqli_query($koneksi, $queryHapus)) {
        echo "<script>alert('Data kategori kasus berhasil dihapus!'); window.location='../index.php?halaman=kategori';</script>";
        exit();
    } else {
        echo "<script>alert('Gagal menghapus data kategori! Pastikan tidak ada kasus terkait yang masih menggunakan kategori ini.'); window.location='../index.php?halaman=kategori';</script>";
        exit();
    }
} else {
    header("Location: ../index.php?halaman=kategori");
    exit();
}
?>