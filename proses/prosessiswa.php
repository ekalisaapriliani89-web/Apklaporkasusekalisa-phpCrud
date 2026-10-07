<?php
session_start();
require_once 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (empty($username) || empty($password)) {
        header("Location: /5APKLAPORKASUSEKALISA/views/auth/loginsiswa.php?pesan=kosong");
        exit;
    }

    try {
        // Cari siswa berdasarkan kolom username
        $stmt = $pdo->prepare("SELECT * FROM siswa WHERE username = :username LIMIT 1");
        $stmt->execute(['username' => $username]);
        $siswa = $stmt->fetch();

        // Cek kecocokan password (mendukung teks biasa & password_hash)
        if ($siswa && ($password === $siswa['password'] || password_verify($password, $siswa['password']))) {
            $_SESSION['siswa'] = $siswa;
            header("Location: /5APKLAPORKASUSEKALISA/index.php");
            exit;
        } else {
            header("Location: /5APKLAPORKASUSEKALISA/views/auth/loginsiswa.php?pesan=gagal");
            exit;
        }
    } catch (PDOException $e) {
        die("Error pada database: " . $e->getMessage());
    }
} else {
    header("Location: /5APKLAPORKASUSEKALISA/views/auth/loginsiswa.php");
    exit;
}