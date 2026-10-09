<?php
require_once 'koneksi.php';
require_once 'session.php';

/** @var mysqli $koneksi */

$aksi = $_GET['aksi'] ?? '';
$folderFoto = "../assets/images/siswa/";

if (!is_dir($folderFoto)) {
    mkdir($folderFoto, 0777, true);
}

/*
|--------------------------------------------------------------------------
| 1. PROSES LOGIN SISWA
|--------------------------------------------------------------------------
*/
if (isset($_POST['login_siswa'])) {
    $namasiswa = mysqli_real_escape_string($koneksi, htmlspecialchars(trim($_POST['namasiswa'] ?? '')));
    $nohp      = mysqli_real_escape_string($koneksi, htmlspecialchars(trim($_POST['nohp'] ?? '')));

    $query  = "SELECT * FROM siswa WHERE namasiswa = '$namasiswa' AND nohp = '$nohp'";
    $result = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);

        $_SESSION['idsiswa']   = $row['idsiswa'];
        $_SESSION['namasiswa'] = $row['namasiswa'];
        $_SESSION['foto']      = $row['foto'] ?? 'default.png';

        header("Location: ../index.php?halaman=dashboardsiswa");
        exit();
    } else {
        echo "<script>alert('Nama Siswa atau No HP tidak ditemukan!'); window.location='../index.php?halaman=loginsiswa';</script>";
        exit();
    }
}

/*
|--------------------------------------------------------------------------
| 2. PROSES REGISTER SISWA BARU (PUBLIC / MANDIRI)
|--------------------------------------------------------------------------
*/
if (isset($_POST['register_siswa'])) {
    $namasiswa    = mysqli_real_escape_string($koneksi, htmlspecialchars(trim($_POST['namasiswa'] ?? '')));
    $kelas        = mysqli_real_escape_string($koneksi, htmlspecialchars(trim($_POST['kelas'] ?? '')));
    $jeniskelamin = mysqli_real_escape_string($koneksi, htmlspecialchars(trim($_POST['jeniskelamin'] ?? '')));
    $nohp         = mysqli_real_escape_string($koneksi, htmlspecialchars(trim($_POST['nohp'] ?? '')));

    $namaFoto = 'default.png';
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $ext = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
        if (in_array($ext, ['jpg', 'jpeg', 'png', 'webp', 'gif'])) {
            $namaFoto = "siswa_" . time() . "_" . rand(100, 999) . "." . $ext;
            move_uploaded_file($_FILES['foto']['tmp_name'], $folderFoto . $namaFoto);
        }
    }

    $query = "INSERT INTO siswa (namasiswa, kelas, jeniskelamin, nohp, foto) 
              VALUES ('$namasiswa', '$kelas', '$jeniskelamin', '$nohp', '$namaFoto')";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Pendaftaran Berhasil! Silakan Login.'); window.location='../index.php?halaman=loginsiswa';</script>";
        exit();
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}

/*
|--------------------------------------------------------------------------
| 3. PROSES TAMBAH SISWA (ADMIN / PETUGAS)
|--------------------------------------------------------------------------
*/
if ($aksi == 'tambah') {
    cekPetugasOrAdmin();

    $namasiswa    = mysqli_real_escape_string($koneksi, htmlspecialchars(trim($_POST['namasiswa'] ?? '')));
    $kelas        = mysqli_real_escape_string($koneksi, htmlspecialchars(trim($_POST['kelas'] ?? '')));
    $jeniskelamin = mysqli_real_escape_string($koneksi, htmlspecialchars(trim($_POST['jeniskelamin'] ?? '')));
    $nohp         = mysqli_real_escape_string($koneksi, htmlspecialchars(trim($_POST['nohp'] ?? '')));

    $namaFoto = 'default.png';
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $ext = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
        if (in_array($ext, ['jpg', 'jpeg', 'png', 'webp', 'gif'])) {
            $namaFoto = "siswa_" . time() . "_" . rand(100, 999) . "." . $ext;
            move_uploaded_file($_FILES['foto']['tmp_name'], $folderFoto . $namaFoto);
        }
    }

    $query = "INSERT INTO siswa (namasiswa, kelas, jeniskelamin, nohp, foto) 
              VALUES ('$namasiswa', '$kelas', '$jeniskelamin', '$nohp', '$namaFoto')";

    if (mysqli_query($koneksi, $query)) {
        header("Location: ../index.php?halaman=siswa");
        exit();
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}

/*
|--------------------------------------------------------------------------
| 4. PROSES EDIT SISWA (ADMIN / PETUGAS)
|--------------------------------------------------------------------------
*/
if ($aksi == 'edit') {
    cekPetugasOrAdmin();

    $idsiswa      = mysqli_real_escape_string($koneksi, $_POST['idsiswa'] ?? 0);
    $namasiswa    = mysqli_real_escape_string($koneksi, htmlspecialchars(trim($_POST['namasiswa'] ?? '')));
    $kelas        = mysqli_real_escape_string($koneksi, htmlspecialchars(trim($_POST['kelas'] ?? '')));
    $jeniskelamin = mysqli_real_escape_string($koneksi, htmlspecialchars(trim($_POST['jeniskelamin'] ?? '')));
    $nohp         = mysqli_real_escape_string($koneksi, htmlspecialchars(trim($_POST['nohp'] ?? '')));

    $queryCek = mysqli_query($koneksi, "SELECT foto FROM siswa WHERE idsiswa = '$idsiswa'");
    $rowOld   = mysqli_fetch_assoc($queryCek);
    $namaFoto = $rowOld['foto'] ?? 'default.png';

    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $ext = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
        if (in_array($ext, ['jpg', 'jpeg', 'png', 'webp', 'gif'])) {
            if ($namaFoto != 'default.png' && file_exists($folderFoto . $namaFoto)) {
                unlink($folderFoto . $namaFoto);
            }
            $namaFoto = "siswa_" . $idsiswa . "_" . time() . "." . $ext;
            move_uploaded_file($_FILES['foto']['tmp_name'], $folderFoto . $namaFoto);
        }
    }

    $query = "UPDATE siswa SET 
                namasiswa    = '$namasiswa', 
                kelas        = '$kelas', 
                jeniskelamin = '$jeniskelamin', 
                nohp         = '$nohp', 
                foto         = '$namaFoto' 
              WHERE idsiswa  = '$idsiswa'";

    if (mysqli_query($koneksi, $query)) {
        header("Location: ../index.php?halaman=siswa");
        exit();
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}

/*
|--------------------------------------------------------------------------
| 5. PROSES HAPUS SISWA (ADMIN / PETUGAS)
|--------------------------------------------------------------------------
*/
if ($aksi == 'hapus') {
    cekPetugasOrAdmin();

    // Kurung tutup sudah diperbaiki di sini
    $idsiswa = mysqli_real_escape_string($koneksi, $_GET['idsiswa'] ?? 0);

    $queryCek = mysqli_query($koneksi, "SELECT foto FROM siswa WHERE idsiswa = '$idsiswa'");
    if (mysqli_num_rows($queryCek) > 0) {
        $row  = mysqli_fetch_assoc($queryCek);
        $foto = $row['foto'] ?? 'default.png';

        if ($foto != 'default.png' && file_exists($folderFoto . $foto)) {
            unlink($folderFoto . $foto);
        }

        mysqli_query($koneksi, "DELETE FROM siswa WHERE idsiswa = '$idsiswa'");
    }

    header("Location: ../index.php?halaman=siswa");
    exit();
}
?>