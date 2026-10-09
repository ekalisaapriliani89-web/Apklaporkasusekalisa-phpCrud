<?php
require_once 'koneksi.php';
require_once 'session.php';

/** @var mysqli $koneksi */

$aksi = $_GET['aksi'] ?? '';

$folderFoto = "../assets/images/user/";
if (!is_dir($folderFoto)) {
    mkdir($folderFoto, 0777, true);
}

/*
|--------------------------------------------------------------------------
| PROSES TAMBAH USER (KHUSUS ADMIN)
|--------------------------------------------------------------------------
*/
if ($aksi == 'tambah') {
    cekAdmin();

    $username = mysqli_real_escape_string($koneksi, htmlspecialchars(trim($_POST['username'] ?? '')));
    $password = mysqli_real_escape_string($koneksi, htmlspecialchars(trim($_POST['password'] ?? '')));
    $namauser = mysqli_real_escape_string($koneksi, htmlspecialchars(trim($_POST['namauser'] ?? '')));
    $nohp     = mysqli_real_escape_string($koneksi, htmlspecialchars(trim($_POST['nohp'] ?? '')));

    if (empty($username) || empty($password) || empty($namauser)) {
        echo "<script>alert('Semua kolom wajib diisi!'); history.back();</script>";
        exit();
    }

    $namaFoto = 'default.png';
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $ext = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
        if (in_array($ext, ['jpg', 'jpeg', 'png', 'webp', 'gif'])) {
            $namaFoto = "user_" . time() . "_" . rand(100, 999) . "." . $ext;
            move_uploaded_file($_FILES['foto']['tmp_name'], $folderFoto . $namaFoto);
        }
    }

    $query = "INSERT INTO user (namauser, unsername, password, nohp, fot) 
              VALUES ('$namauser', '$username', '$password', '$nohp', '$namaFoto')";

    if (mysqli_query($koneksi, $query)) {
        header("Location: ../index.php?halaman=user");
        exit();
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}

/*
|--------------------------------------------------------------------------
| PROSES EDIT USER (KHUSUS ADMIN)
|--------------------------------------------------------------------------
*/
if ($aksi == 'edit') {
    cekAdmin();

    $iduser   = mysqli_real_escape_string($koneksi, $_POST['iduser'] ?? 0);
    $username = mysqli_real_escape_string($koneksi, htmlspecialchars(trim($_POST['username'] ?? '')));
    $password = mysqli_real_escape_string($koneksi, htmlspecialchars(trim($_POST['password'] ?? '')));
    $namauser = mysqli_real_escape_string($koneksi, htmlspecialchars(trim($_POST['namauser'] ?? '')));
    $nohp     = mysqli_real_escape_string($koneksi, htmlspecialchars(trim($_POST['nohp'] ?? '')));

    $queryCek = mysqli_query($koneksi, "SELECT fot FROM user WHERE iduser = '$iduser'");
    $rowOld   = mysqli_fetch_assoc($queryCek);
    $namaFoto = $rowOld['fot'] ?? 'default.png';

    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $ext = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
        if (in_array($ext, ['jpg', 'jpeg', 'png', 'webp', 'gif'])) {
            if ($namaFoto != 'default.png' && file_exists($folderFoto . $namaFoto)) {
                unlink($folderFoto . $namaFoto);
            }
            $namaFoto = "user_" . $iduser . "_" . time() . "." . $ext;
            move_uploaded_file($_FILES['foto']['tmp_name'], $folderFoto . $namaFoto);
        }
    }

    $query = "UPDATE user SET 
                namauser  = '$namauser', 
                unsername = '$username', 
                password  = '$password', 
                nohp      = '$nohp', 
                fot       = '$namaFoto' 
              WHERE iduser = '$iduser'";

    if (mysqli_query($koneksi, $query)) {
        header("Location: ../index.php?halaman=user");
        exit();
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}

/*
|--------------------------------------------------------------------------
| PROSES HAPUS USER (KHUSUS ADMIN)
|--------------------------------------------------------------------------
*/
if ($aksi == 'hapus') {
    cekAdmin();

    // Kurung tutup sudah diperbaiki di sini
    $iduser = mysqli_real_escape_string($koneksi, $_GET['iduser'] ?? 0);

    $queryCek = mysqli_query($koneksi, "SELECT fot FROM user WHERE iduser = '$iduser'");
    if (mysqli_num_rows($queryCek) > 0) {
        $row  = mysqli_fetch_assoc($queryCek);
        $foto = $row['fot'] ?? 'default.png';

        if ($foto != 'default.png' && file_exists($folderFoto . $foto)) {
            unlink($folderFoto . $foto);
        }

        mysqli_query($koneksi, "DELETE FROM user WHERE iduser = '$iduser'");
    }

    header("Location: ../index.php?halaman=user");
    exit();
}

/*
|--------------------------------------------------------------------------
| PROSES LOGIN USER (ADMIN / PETUGAS)
|--------------------------------------------------------------------------
*/
if (isset($_POST['login_user'])) {
    $username = mysqli_real_escape_string($koneksi, htmlspecialchars(trim($_POST['username'] ?? '')));
    $password = mysqli_real_escape_string($koneksi, htmlspecialchars(trim($_POST['password'] ?? '')));

    $query  = "SELECT * FROM user WHERE unsername = '$username' AND password = '$password'";
    $result = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);

        $_SESSION['iduser']   = $row['iduser'];
        $_SESSION['namauser'] = $row['namauser'];
        $_SESSION['foto']     = $row['fot'] ?? 'default.png';
        $_SESSION['role']     = ($row['iduser'] == 1) ? 'admin' : 'petugas';

        if ($_SESSION['role'] === 'admin') {
            header("Location: ../index.php?halaman=dashboardadmin");
        } else {
            header("Location: ../index.php?halaman=dashboardpetugas");
        }
        exit();
    } else {
        echo "<script>alert('Username atau Password salah!'); window.location='../index.php?halaman=loginuser';</script>";
        exit();
    }
}
?>