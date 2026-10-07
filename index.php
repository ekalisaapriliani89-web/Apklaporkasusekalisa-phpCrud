<?php
session_start();

// Check status session aktif untuk auto-redirect
if (isset($_SESSION['user'])) {     header("Location: views/user/kasus/index.php");     exit; } elseif (isset($_SESSION['siswa'])) {
    header("Location: views/siswa/index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pelaporan Kasus Siswa</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>
<body class="bg-light">

<!-- Header / Navbar Minimalis -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php">Aplikasi Lapor Kasus</a>
        <div class="d-flex">
            <a href="views/auth/loginsiswa.php" class="btn btn-outline-light me-2 btn-sm">Login Siswa</a>
            <a href="views/auth/login.php" class="btn btn-light me-2 btn-sm">Login Petugas/Admin</a>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<div class="container my-5">
    <div class="row align-items-center bg-white p-5 rounded-3 shadow-sm">
        <div class="col-md-7">
            <h1 class="display-5 fw-bold text-primary mb-3">Sistem Layanan Bimbingan Konseling & Pengaduan Kasus</h1>
            <p class="lead text-muted">Platform terintegrasi untuk pencatatan, pengaduan, dan penanganan kasus siswa secara transparan, akurat, dan terstruktur.</p>
            <div class="mt-4">
                <a href="views/auth/loginsiswa.php" class="btn btn-primary btn-lg me-2">Lapor / Masuk Siswa</a>
                <a href="views/auth/login.php" class="btn btn-outline-secondary btn-lg">Portal Petugas & Admin</a>
            </div>
        </div>
        <div class="col-md-5 text-center mt-4 mt-md-0">
            <img src="assets/img/hero.svg" alt="Ilustrasi" class="img-fluid" onerror="this.src='https://via.placeholder.com/400x300?text=Lapor+Kasus+Siswa'">
        </div>
    </div>