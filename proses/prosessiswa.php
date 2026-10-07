<?php
session_start();
require_once 'koneksi.php';

// Pastikan request datang dari form submit POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form login
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    // Validasi jika input kosong
    if (empty($username) || empty($password)) {
        header("Location: /5APKLAPORKASUSEKALISA/views/auth/loginsiswa.php?pesan=kosong");
        exit;
    }

    try {
        // Cari data siswa berdasarkan username
        $stmt = $pdo->prepare("SELECT * FROM siswa WHERE username = :username LIMIT 1");
        $stmt->execute(['username' => $username]);
        $siswa = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verifikasi apakah siswa ditemukan dan password cocok (mendukung teks biasa seperti '123' maupun hash)
        if ($siswa && ($password === $siswa['password'] || password_verify($password, $siswa['password']))) {
            
            // Simpan seluruh informasi siswa ke dalam Session
            $_SESSION['siswa'] = [
                'idsiswa'      => $siswa['idsiswa'],
                'namasiswa'    => $siswa['namasiswa'],
                'username'     => $siswa['username'],
                'kelas'        => $siswa['kelas'],
                'jeniskelamin' => $siswa['jeniskelamin'],
                'nohp'         => $siswa['nohp'],
                'foto'         => $siswa['foto'],
                'role'         => 'siswa'
            ];

            // Berhasil login -> Arahkan ke halaman utama / index
            header("Location: /5APKLAPORKASUSEKALISA/index.php");
            exit;
        } else {
            // Jika username atau password tidak cocok
            header("Location: /5APKLAPORKASUSEKALISA/views/auth/loginsiswa.php?pesan=gagal");
            exit;
        }
    } catch (PDOException $e) {
        die("Terjadi kesalahan pada database: " . $e->getMessage());
    }
} else {
    // Jika mencoba akses langsung tanpa POST, kembalikan ke halaman login
    header("Location: /5APKLAPORKASUSEKALISA/views/auth/loginsiswa.php");
    exit;
}