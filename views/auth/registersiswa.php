<?php
session_start();
require_once '../../proses/koneksi.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $namasiswa    = trim($_POST['namasiswa']);
    $username     = trim($_POST['username']);
    $password     = trim($_POST['password']);
    $kelas        = trim($_POST['kelas']);
    $jeniskelamin = $_POST['jeniskelamin'];
    $nohp         = trim($_POST['nohp']);

    if (!empty($namasiswa) && !empty($username) && !empty($password)) {
        // Cek username unik
        $stmtCek = $pdo->prepare("SELECT idsiswa FROM siswa WHERE username = :username");
        $stmtCek->execute(['username' => $username]);
        
        if ($stmtCek->rowCount() > 0) {
            $error = 'Username sudah digunakan, cari username lain!';
        } else {
            $stmt = $pdo->prepare("INSERT INTO siswa (namasiswa, username, password, kelas, jeniskelamin, nohp, foto) 
                                   VALUES (:namasiswa, :username, :password, :kelas, :jeniskelamin, :nohp, 'default.png')");
            $stmt->execute([
                'namasiswa'    => $namasiswa,
                'username'     => $username,
                'password'     => $password,
                'kelas'        => $kelas,
                'jeniskelamin' => $jeniskelamin,
                'nohp'         => $nohp
            ]);
            $success = 'Pendaftaran berhasil! Silakan login.';
        }
    } else {
        $error = 'Data tidak boleh kosong!';
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register Siswa - Lapor Kasus</title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Registrasi Akun Siswa Baru</h5>
                </div>
                <div class="card-body">
                    <?php if ($error): ?><div class="alert alert-danger"><?= $error; ?></div><?php endif; ?>
                    <?php if ($success): ?>
                        <div class="alert alert-success"><?= $success; ?> <a href="loginsiswa.php">Login di sini</a></div>
                    <?php endif; ?>

                    <form action="" method="POST">
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="namasiswa" class="form-control" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Username</label>
                                <input type="text" name="username" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Kelas</label>
                                <input type="text" name="kelas" class="form-control" placeholder="Contoh: XI IPA 1" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Jenis Kelamin</label>
                                <select name="jeniskelamin" class="form-select" required>
                                    <option value="perempuan">Perempuan</option>
                                    <option value="laki-laki">Laki-Laki</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">No HP/WA</label>
                                <input type="text" name="nohp" class="form-control" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success w-100">Daftar Akun</button>
                    </form>
                    <div class="mt-3 text-center">
                        <a href="loginsiswa.php">Sudah Punya Akun? Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>