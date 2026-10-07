<?php
session_start();
require_once '../../proses/koneksi.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nisn = trim($_POST['nisn'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (!empty($nisn) && !empty($password)) {
        $stmt = $pdo->prepare("SELECT * FROM siswa WHERE nisn = :nisn");
        $stmt->execute(['nisn' => $nisn]);
        $siswa = $stmt->fetch();

        if ($siswa && password_verify($password, $siswa['password'])) {
            $_SESSION['idsiswa'] = $siswa['idsiswa'];
            $_SESSION['namasiswa'] = $siswa['namasiswa'];
            $_SESSION['role'] = 'siswa';
            header("Location: ../siswa/dashboardsiswa.php");
            exit;
        } else {
            $error = "NISN atau Password salah!";
        }
    } else {
        $error = "Semua kolom wajib diisi!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Siswa</title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
</head>
<body class="bg-light d-flex align-items-center min-vh-100">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h4 class="fw-bold text-center mb-3">Login Siswa</h4>
                    <?php if ($error): ?>
                        <div class="alert alert-danger py-2"><?= htmlspecialchars($error); ?></div>
                    <?php endif; ?>
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label class="form-label">NISN</label>
                            <input type="text" name="nisn" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Masuk</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>