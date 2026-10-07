<?php
session_start();

// Jika sudah login, langsung lempar ke halaman siswa
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
    <!-- Bootstrap CDN agar tampilan tidak polos -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center" style="min-height: 100vh;">

<div class="card border-0 shadow-sm col-md-4 p-4">
    <div class="card-body">
        <h3 class="text-center fw-bold mb-3">Login Siswa</h3>
        <p class="text-center text-muted mb-4">Silakan masuk menggunakan NISN Anda</p>

        <?php if (isset($_GET['pesan']) && $_GET['pesan'] == 'gagal'): ?>
            <div class="alert alert-danger text-center">NISN atau Password salah!</div>
        <?php endif; ?>

     <form action="/5APKLAPORKASUSEKALISA/proses/prosessiswa.php" method="POST">
    <div class="mb-3">
        <label for="username" class="form-label">NISN</label>
        <!-- Pastikan ada name="username" -->
        <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan NISN" required>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <!-- Pastikan ada name="password" -->
        <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password" required>
    </div>
    <button type="submit" class="btn btn-primary w-100 fw-bold">Masuk</button>
</form>
        
        <div class="text-center mt-3">
            <a href="loginuser.php">Login sebagai Petugas</a>
        </div>
    </div>
</div>

</body>
</html>