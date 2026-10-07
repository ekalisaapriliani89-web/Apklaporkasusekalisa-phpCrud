<?php
session_start();
require_once '../../proses/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? ''); // Diisi nama siswa / ID
    $password = trim($_POST['password'] ?? ''); // Diisi no HP

    if (empty($username) || empty($password)) {
        header("Location: ../views/auth/loginsiswa.php?pesan=kosong");
        exit;
    }

    try {
        // Cari siswa berdasarkan nama siswa atau idsiswa, dan cocokkan nohp
        $stmt = $pdo->prepare("SELECT * FROM siswa WHERE (namasiswa = :username OR idsiswa = :username) AND nohp = :password LIMIT 1");
        $stmt->execute([
            'username' => $username,
            'password' => $password
        ]);
        $siswa = $stmt->fetch();

        if ($siswa) {
            $_SESSION['siswa'] = $siswa;
            
            // Berhasil login -> pindah ke dashboard/landing
            header("Location: /5APKLAPORKASUSEKALISA/index.php");
            exit;
        } else {
            header("Location: ../views/auth/loginsiswa.php?pesan=gagal");
            exit;
        }
    } catch (PDOException $e) {
        die("Error pada database: " . $e->getMessage());
    }
} else {
    header("Location: ../views/auth/loginsiswa.php");
    exit;
}