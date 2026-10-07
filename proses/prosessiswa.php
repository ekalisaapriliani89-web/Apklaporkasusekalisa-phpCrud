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
        // Menggunakan nama parameter yang berbeda (:user_nama dan :user_id) agar tidak bentrok
        $stmt = $pdo->prepare("SELECT * FROM siswa WHERE (namasiswa = :user_nama OR idsiswa = :user_id) AND nohp = :password LIMIT 1");
        $stmt->execute([
            'user_nama' => $username,
            'user_id'   => $username,
            'password'  => $password
        ]);
        $siswa = $stmt->fetch();

        if ($siswa) {
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