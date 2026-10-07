<?php
require_once __DIR__ . '/session.php';
checkSiswaOnly();

$idsiswa = $_SESSION['idsiswa'];

// Ringkasan Jumlah Laporan Siswa Ini
$stmtTotal = $pdo->prepare("SELECT COUNT(*) FROM pengajuan WHERE idsiswa = :idsiswa");
$stmtTotal->execute(['idsiswa' => $idsiswa]);
$totalPengajuan = $stmtTotal->fetchColumn();

// Ambil Profil Siswa
$stmtProfil = $pdo->prepare("SELECT * FROM siswa WHERE idsiswa = :idsiswa");
$stmtProfil->execute(['idsiswa' => $idsiswa]);
$dataSiswa = $stmtProfil->fetch();
?>