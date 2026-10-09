<?php
/*
|--------------------------------------------------------------------------
| PROSES PENANGANAN KASUS - APLIKASI LAPOR KASUS SEKALISA
|--------------------------------------------------------------------------
| Path    : proses/prosespenanganan.php
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
// 1. PROSES TAMBAH PENANGANAN KASUS BARU
// ==========================================================
if ($aksi == 'tambah') {
    $idpengajuan       = (int) ($_POST['idpengajuan'] ?? 0);
    $tanggalpenanganan = mysqli_real_escape_string($koneksi, $_POST['tanggalpenanganan'] ?? date('Y-m-d'));
    $idsanksi          = (int) ($_POST['idsanksi'] ?? 0);
    $keterangan        = mysqli_real_escape_string($koneksi, $_POST['keterangan'] ?? '');
    $status            = mysqli_real_escape_string($koneksi, $_POST['status'] ?? 'Selesai');
    $iduser            = $_SESSION['iduser'] ?? 1; // ID petugas/admin yang sedang login

    $query = "INSERT INTO penanganan (idpengajuan, idsanksi, iduser, tanggalpenanganan, keterangan) 
              VALUES ('$idpengajuan', '$idsanksi', '$iduser', '$tanggalpenanganan', '$keterangan')";
    
    if (mysqli_query($koneksi, $query)) {
        // Update juga status pada tabel pengajuan kasus
        mysqli_query($koneksi, "UPDATE pengajuan SET status = '$status' WHERE idpengajuan = '$idpengajuan'");

        echo "<script>alert('Data penanganan kasus berhasil disimpan!'); window.location='../index.php?halaman=penanganan';</script>";
        exit();
    } else {
        echo "<script>alert('Gagal menyimpan data penanganan kasus!'); window.location='../index.php?halaman=createpenanganan';</script>";
        exit();
    }
} 

// ==========================================================
// 2. PROSES UBAH / EDIT PENANGANAN KASUS
// ==========================================================
elseif ($aksi == 'ubah') {
    $idpenanganan      = (int) ($_POST['idpenanganan'] ?? 0);
    $idpengajuan       = (int) ($_POST['idpengajuan'] ?? 0);
    $tanggalpenanganan = mysqli_real_escape_string($koneksi, $_POST['tanggalpenanganan'] ?? date('Y-m-d'));
    $idsanksi          = (int) ($_POST['idsanksi'] ?? 0);
    $keterangan        = mysqli_real_escape_string($koneksi, $_POST['keterangan'] ?? '');
    $status            = mysqli_real_escape_string($koneksi, $_POST['status'] ?? 'Selesai');

    $query = "UPDATE penanganan SET 
                idsanksi = '$idsanksi', 
                tanggalpenanganan = '$tanggalpenanganan', 
                keterangan = '$keterangan' 
              WHERE idpenanganan = '$idpenanganan'";
    
    if (mysqli_query($koneksi, $query)) {
        // Perbarui status pengajuan
        mysqli_query($koneksi, "UPDATE pengajuan SET status = '$status' WHERE idpengajuan = '$idpengajuan'");

        echo "<script>alert('Data penanganan kasus berhasil diperbarui!'); window.location='../index.php?halaman=penanganan';</script>";
        exit();
    } else {
        echo "<script>alert('Gagal memperbarui data penanganan!'); window.location='../index.php?halaman=editpenanganan&id=$idpenanganan';</script>";
        exit();
    }
} 

// ==========================================================
// 3. PROSES HAPUS PENANGANAN KASUS
// ==========================================================
elseif ($aksi == 'hapus') {
    $idpenanganan = (int) ($_GET['id'] ?? 0);

    $queryHapus = "DELETE FROM penanganan WHERE idpenanganan = '$idpenanganan'";
    
    if (mysqli_query($koneksi, $queryHapus)) {
        echo "<script>alert('Data penanganan kasus berhasil dihapus!'); window.location='../index.php?halaman=penanganan';</script>";
        exit();
    } else {
        echo "<script>alert('Gagal menghapus data penanganan!'); window.location='../index.php?halaman=penanganan';</script>";
        exit();
    }
} else {
    header("Location: ../index.php?halaman=penanganan");
    exit();
}
?>