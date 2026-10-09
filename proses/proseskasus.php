<?php
/*
|--------------------------------------------------------------------------
| PROSES KASUS - APLIKASI LAPOR KASUS SEKALISA
|--------------------------------------------------------------------------
| Path    : proses/proseskasus.php
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
// 1. PROSES TAMBAH KASUS BARU
// ==========================================================
if ($aksi == 'tambah') {
    $namakasus     = mysqli_real_escape_string($koneksi, $_POST['namakasus'] ?? '');
    $idkategori    = (int) ($_POST['idkategori'] ?? 0);
    $tingkatbahaya = mysqli_real_escape_string($koneksi, $_POST['tingkatbahaya'] ?? 'Sedang');
    $keterangan    = mysqli_real_escape_string($koneksi, $_POST['keterangan'] ?? '');

    $foto = 'default.png';
    if (!empty($_FILES['foto']['name'])) {
        $namaFile     = $_FILES['foto']['name'];
        $error        = $_FILES['foto']['error'];
        $tmpName      = $_FILES['foto']['tmp_name'];

        $ekstensiValid = ['jpg', 'jpeg', 'png', 'webp'];
        $ekstensiArr   = explode('.', $namaFile);
        $ekstensiFile  = strtolower(end($ekstensiArr));

        if (in_array($ekstensiFile, $ekstensiValid) && $error === 0) {
            $foto = uniqid() . '.' . $ekstensiFile;
            $targetDir = '../assets/images/kasus/';
            
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0777, true);
            }
            
            move_uploaded_file($tmpName, $targetDir . $foto);
        }
    }

    $query = "INSERT INTO kasus (namakasus, idkategori, tingkatbahaya, keterangan, foto) 
              VALUES ('$namakasus', '$idkategori', '$tingkatbahaya', '$keterangan', '$foto')";
    
    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Data master kasus berhasil ditambahkan!'); window.location='../index.php?halaman=kasus';</script>";
        exit();
    } else {
        echo "<script>alert('Gagal menambahkan data kasus!'); window.location='../index.php?halaman=createkasus';</script>";
        exit();
    }
} 

// ==========================================================
// 2. PROSES UBAH / EDIT KASUS
// ==========================================================
elseif ($aksi == 'ubah') {
    $idkasus       = (int) ($_POST['idkasus'] ?? 0);
    $namakasus     = mysqli_real_escape_string($koneksi, $_POST['namakasus'] ?? '');
    $idkategori    = (int) ($_POST['idkategori'] ?? 0);
    $tingkatbahaya = mysqli_real_escape_string($koneksi, $_POST['tingkatbahaya'] ?? 'Sedang');
    $keterangan    = mysqli_real_escape_string($koneksi, $_POST['keterangan'] ?? '');
    $fotolama      = $_POST['fotolama'] ?? 'default.png';

    $foto = $fotolama;
    if (!empty($_FILES['foto']['name'])) {
        $namaFile     = $_FILES['foto']['name'];
        $tmpName      = $_FILES['foto']['tmp_name'];
        
        $ekstensiArr  = explode('.', $namaFile);
        $ekstensiFile = strtolower(end($ekstensiArr));

        if (in_array($ekstensiFile, ['jpg', 'jpeg', 'png', 'webp'])) {
            $foto = uniqid() . '.' . $ekstensiFile;
            $targetDir = '../assets/images/kasus/';
            
            move_uploaded_file($tmpName, $targetDir . $foto);
            
            if ($fotolama != 'default.png' && file_exists($targetDir . $fotolama)) {
                unlink($targetDir . $fotolama);
            }
        }
    }

    $query = "UPDATE kasus SET 
                namakasus = '$namakasus', 
                idkategori = '$idkategori', 
                tingkatbahaya = '$tingkatbahaya', 
                keterangan = '$keterangan', 
                foto = '$foto' 
              WHERE idkasus = '$idkasus'";
    
    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Data master kasus berhasil diperbarui!'); window.location='../index.php?halaman=kasus';</script>";
        exit();
    } else {
        echo "<script>alert('Gagal memperbarui data kasus!'); window.location='../index.php?halaman=editkasus&id=$idkasus';</script>";
        exit();
    }
} 

// ==========================================================
// 3. PROSES HAPUS KASUS
// ==========================================================
elseif ($aksi == 'hapus') {
    $idkasus = (int) ($_GET['id'] ?? 0);

    $qCek = mysqli_query($koneksi, "SELECT foto FROM kasus WHERE idkasus = '$idkasus' LIMIT 1");
    if ($qCek && mysqli_num_rows($qCek) > 0) {
        $data = mysqli_fetch_assoc($qCek);
        $fileFoto = $data['foto'] ?? '';
        
        if ($fileFoto != 'default.png' && !empty($fileFoto) && file_exists('../assets/images/kasus/' . $fileFoto)) {
            unlink('../assets/images/kasus/' . $fileFoto);
        }
    }

    $queryHapus = "DELETE FROM kasus WHERE idkasus = '$idkasus'";
    if (mysqli_query($koneksi, $queryHapus)) {
        echo "<script>alert('Data master kasus berhasil dihapus!'); window.location='../index.php?halaman=kasus';</script>";
        exit();
    } else {
        echo "<script>alert('Gagal menghapus data kasus!'); window.location='../index.php?halaman=kasus';</script>";
        exit();
    }
} else {
    header("Location: ../index.php?halaman=kasus");
    exit();
}
?>