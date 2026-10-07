<?php
// proses/prosesdashboarduser.php
require_once __DIR__ . '/session.php';
checkAdminOnly();

try {
    // Total Akun User (Admin & Petugas)
    $stmtUser = $pdo->query("SELECT COUNT(*) AS total FROM user");
    $totalUser = $stmtUser->fetch()['total'];

    // Total Siswa
    $stmtSiswa = $pdo->query("SELECT COUNT(*) AS total FROM siswa");
    $totalSiswa = $stmtSiswa->fetch()['total'];

    // Total Laporan Masuk (Pengajuan)
    $stmtLaporan = $pdo->query("SELECT COUNT(*) AS total FROM pengajuan");
    $totalLaporan = $stmtLaporan->fetch()['total'];

    // Total Kasus Selesai Ditangani
    $stmtPenanganan = $pdo->query("SELECT COUNT(*) AS total FROM penanganan");
    $totalSelesai = $stmtPenanganan->fetch()['total'];

    // Laporan Masuk Terbaru (5 Terakhir)
    $stmtTerbaru = $pdo->query("SELECT p.*, s.namasiswa, k.namakasus 
                                FROM pengajuan p 
                                JOIN siswa s ON p.idsiswa = s.idsiswa 
                                JOIN kasus k ON p.idkasus = k.idkasus 
                                ORDER BY p.idpengajuan DESC LIMIT 5");
    $laporanTerbaru = $stmtTerbaru->fetchAll();

} catch (PDOException $e) {
    die("Gagal mengambil data dashboard: " . $e->getMessage());
}
?>