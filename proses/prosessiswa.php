<?php
session_start();
require_once 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Membersihkan spasi tak sengaja dari input form
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (empty($username) || empty($password)) {
        header("Location: /5APKLAPORKASUSEKALISA/views/auth/loginsiswa.php?pesan=kosong");
        exit;
    }

    try {
        // Cari siswa berdasarkan username
        $stmt = $pdo->prepare("SELECT * FROM siswa WHERE username = :username LIMIT 1");
        $stmt->execute(['username' => $username]);
        $siswa = $stmt->fetch(PDO::FETCH_ASSOC);

        // Ambil password dari database dan bersihkan dari spasi tersembunyi
        $db_password = isset($siswa['password']) ? trim($siswa['password']) : '';

        // Cek kecocokan password
        if ($siswa && ($password === $db_password || password_verify($password, $db_password))) {
            $_SESSION['siswa'] = [
                'idsiswa'   => $siswa['idsiswa'],
                'namasiswa' => $siswa['namasiswa'],
                'username'  => $siswa['username'],
                'kelas'     => $siswa['kelas'],
                'role'      => 'siswa'
            ];

            header("Location: /5APKLAPORKASUSEKALISA/index.php");
            exit;
        } else {
            header("Location: /5APKLAPORKASUSEKALISA/views/auth/loginsiswa.php?pesan=gagal");
            exit;
        }
    } catch (PDOException $e) {
        die("Error database: " . $e->getMessage());
    }
} else {
    header("Location: /5APKLAPORKASUSEKALISA/views/auth/loginsiswa.php");
    exit;
}