<?php
session_start();
require_once 'koneksi.php';

// Cek apakah data dikirim via method POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    // Validasi input tidak boleh kosong
    if (empty($username) || empty($password)) {
        header("Location: ../views/auth/loginsiswa.php?pesan=kosong");
        exit;
    }

    try {
        // Cari data siswa berdasarkan passwordatau Username
        $stmt = $pdo->prepare("SELECT * FROM siswa WHERE username = :username OR username = :username LIMIT 1");
        $stmt->execute(['username' => $username]);
        $siswa = $stmt->fetch();

        // Cek apakah siswa ditemukan dan password cocok
        if ($siswa && ($password === $siswa['password'] || password_verify($password, $siswa['password']))) {
            // Simpan session siswa
            $_SESSION['siswa'] = [
                'idsiswa'  => $siswa['idsiswa'] ?? $siswa['id_siswa'],
                'unsername'     => $siswa['username'],
                'nama'     => $siswa['nama'] ?? $siswa['nama_siswa'],
                'role'     => 'siswa'
            ];

            // Berhasil login -> Arahkan ke dashboard siswa
            header("Location: ../views/dashboard/siswa.php"); // Sesuaikan jika nama file dashboard kamu berbeda
            exit;
        } else {
            // Login gagal -> Password atau Username salah
            header("Location: ../views/auth/loginsiswa.php?pesan=gagal");
            exit;
        }
    } catch (PDOException $e) {
        die("Error pada database: " . $e->getMessage());
    }
} else {
    // Jika mencoba akses langsung tanpa submit form
    header("Location: ../views/auth/loginsiswa.php");
    exit;
}