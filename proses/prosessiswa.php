<?php
session_start();
require_once 'koneksi.php';

// Cek apakah data dikirim via method POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    // Validasi input tidak boleh kosong
    if (empty($username) || empty($password)) {
        header("Location: /5APKLAPORKASUSEKALISA/views/auth/loginsiswa.php?pesan=kosong");
        exit;
    }

    try {
        // Cari data siswa berdasarkan Username
        $stmt = $pdo->prepare("SELECT * FROM siswa WHERE username = :username LIMIT 1");
        $stmt->execute(['username' => $username]);
        $siswa = $stmt->fetch(PDO::FETCH_ASSOC);

        // Cek apakah siswa ditemukan dan password cocok
        if ($siswa && ($password === $siswa['password'] || password_verify($password, $siswa['password']))) {
            // Simpan session siswa
            $_SESSION['siswa'] = [
                'idsiswa'   => $siswa['idsiswa'],
                'username'  => $siswa['username'],
                'namasiswa' => $siswa['namasiswa'],
                'role'      => 'siswa'
            ];

            // Berhasil login -> Arahkan ke halaman utama / dashboard
            header("Location: /5APKLAPORKASUSEKALISA/index.php");
            exit;
        } else {
            // Login gagal -> Password atau Username salah
            header("Location: /5APKLAPORKASUSEKALISA/views/auth/loginsiswa.php?pesan=gagal");
            exit;
        }
    } catch (PDOException $e) {
        die("Error pada database: " . $e->getMessage());
    }
} else {
    // Jika mencoba akses langsung tanpa submit form
    header("Location: /5APKLAPORKASUSEKALISA/views/auth/loginsiswa.php");
    exit;
}