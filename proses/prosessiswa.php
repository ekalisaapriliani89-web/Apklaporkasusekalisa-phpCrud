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
        $stmt = $pdo->prepare("SELECT * FROM siswa WHERE (namasiswa = :username OR idsiswa = :username) AND nohp = :password LIMIT 1");
        $stmt->execute([
            'username' => $username,
            'password' => $password
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