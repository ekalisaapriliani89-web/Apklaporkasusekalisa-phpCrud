<?php
session_start();
require_once '../../../proses/session.php';
checkLogin();

$bulan = $_GET['bulan'] ?? date('m');
$tahun = $_GET['tahun'] ?? date('Y');

$stmt = $pdo->prepare("SELECT pen.*, s.namasiswa, s.kelas, k.namakasus, sn.namasanksi, u.namauser 
                       FROM penanganan pen
                       JOIN pengajuan p ON pen.idpengajuan = p.idpengajuan
                       JOIN siswa s ON p.idsiswa = s.idsiswa
                       JOIN kasus k ON p.idkasus = k.idkasus
                       JOIN sanksi sn ON pen.idsanksi = sn.idsanksi
                       JOIN user u ON pen.iduser = u.iduser
                       WHERE MONTH(pen.tglpenanganan) = :bulan AND YEAR(pen.tglpenanganan) = :tahun
                       ORDER BY pen.idpenanganan DESC");
$stmt->execute(['bulan' => $bulan, 'tahun' => $tahun]);
$laporan = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Laporan Bulanan - <?= $bulan; ?>/<?= $tahun; ?></title>
    <link rel="stylesheet" href="../../../assets/css/bootstrap.min.css">
</head>
<body class="p-4" onload="window.print()">
    <div class="text-center mb-4">
        <h2>LAPORAN PENANGANAN KASUS BULANAN</h2>
        <p class="mb-0">Periode Bulan: <?= $bulan; ?> - Tahun: <?= $tahun; ?></p>
        <hr>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr><th>No</th><th>Tanggal</th><th>Siswa</th><th>Kelas</th><th>Kasus</th><th>Sanksi</th><th>Petugas BK</th></tr>
        </thead>
        <tbody>
            <?php foreach ($laporan as $i => $l): ?>
                <tr>
                    <td><?= $i + 1; ?></td>
                    <td><?= $l['tglpenanganan']; ?></td>
                    <td><?= htmlspecialchars($l['namasiswa']); ?></td>
                    <td><?= htmlspecialchars($l['kelas']); ?></td>
                    <td><?= htmlspecialchars($l['namakasus']); ?></td>
                    <td><?= htmlspecialchars($l['namasanksi']); ?></td>
                    <td><?= htmlspecialchars($l['namauser']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>