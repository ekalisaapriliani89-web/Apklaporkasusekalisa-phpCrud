<?php
session_start();
if (isset($_SESSION['siswa'])) {
    header("Location: ../siswa/index.php");
    exit;
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
<body class="bg-light d-flex align-items-center justify-content-center" style="min-height: 100vh;">

<div class="card border-0 shadow-sm col-md-4 p-4">
    <div class="card-body">
        <h3 class="text-center fw-bold mb-3">Login Siswa</h3>
        <p class="text-center text-muted mb-4">Silakan masuk menggunakan NISN Anda</p>

        <?php if (isset($_GET['pesan']) && $_GET['pesan'] == 'gagal'): ?>
            <div class="alert alert-danger text-center">NISN atau Password salah!</div>
        <?php endif; ?>

        <form action="../../proses/prosesloginsiswa.php" method="POST">
            <div class="mb-3">
                <label class="form-label">NISN</label>
                <input type="text" name="nisn" class="form-control" placeholder="Masukkan NISN" required autocomplete="off">
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Masukkan Password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100 fw-bold">Masuk</button>
        </form>
        
        <div class="text-center mt-3">
            <a href="login.php" class="text-decoration-none small">Login sebagai Admin/Petugas</a>
        </div>
    </div>
</div>

</body>
</html>