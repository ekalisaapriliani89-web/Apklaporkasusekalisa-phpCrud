<?php
session_start();
require_once '../../../proses/session.php';
checkAdminOnly();

// Query ringkasan statistik
$totalSiswa = $pdo->query("SELECT COUNT(*) FROM siswa")->fetchColumn();
$totalKasus = $pdo->query("SELECT COUNT(*) FROM kasus")->fetchColumn();
$totalPengajuan = $pdo->query("SELECT COUNT(*) FROM pengajuan")->fetchColumn();
$totalPenanganan = $pdo->query("SELECT COUNT(*) FROM penanganan")->fetchColumn();

// Query pengajuan terbaru
$stmtTerbaru = $pdo->query("SELECT p.*, s.namasiswa, s.kelas, k.namakasus 
                             FROM pengajuan p
                             JOIN siswa s ON p.idsiswa = s.idsiswa
                             JOIN kasus k ON p.idkasus = k.idkasus
                             ORDER BY p.idpengajuan DESC LIMIT 5");
$pengajuanTerbaru = $stmtTerbaru->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Sistem Lapor Kasus</title>
    <link rel="stylesheet" href="../../../assets/css/bootstrap.min.css">
</head>
<body class="bg-light">

<?php include '../../component/user/navbar.php'; ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 p-0 bg-dark min-vh-100">
            <?php include '../../component/user/sidebaradmin.php'; ?>
        </div>
        <div class="col-md-10 p-4">
            <h3 class="fw-bold mb-4">Dashboard Admin</h3>

            <div class="row g-3 mb-4">
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm bg-primary text-white p-3">
                        <h6>Total Siswa</h6>
                        <h2 class="fw-bold mb-0"><?= $totalSiswa; ?></h2>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm bg-warning text-white p-3">
                        <h6>Jenis Kasus</h6>
                        <h2 class="fw-bold mb-0"><?= $totalKasus; ?></h2>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm bg-info text-white p-3">
                        <h6>Pengajuan Laporan</h6>
                        <h2 class="fw-bold mb-0"><?= $totalPengajuan; ?></h2>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm bg-success text-white p-3">
                        <h6>Selesai Ditangani</h6>
                        <h2 class="fw-bold mb-0"><?= $totalPenanganan; ?></h2>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white fw-bold py-3">Pengajuan Laporan Terbaru</div>
                <div class="card-body p-0">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Nama Siswa</th>
                                <th>Kelas</th>
                                <th>Jenis Kasus</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($pengajuanTerbaru)): ?>
                                <tr><td colspan="6" class="text-center py-3 text-muted">Belum ada pengajuan masuk.</td></tr>
                            <?php else: ?>
                                <?php foreach ($pengajuanTerbaru as $i => $row): ?>
                                    <tr>
                                        <td><?= $i + 1; ?></td>
                                        <td><?= date('d-m-Y', strtotime($row['tglpengajuan'])); ?></td>
                                        <td><?= htmlspecialchars($row['namasiswa']); ?></td>
                                        <td><?= htmlspecialchars($row['kelas']); ?></td>
                                        <td><?= htmlspecialchars($row['namakasus']); ?></td>
                                        <td>
                                            <span class="badge bg-<?= $row['status'] === 'selesai' ? 'success' : ($row['status'] === 'diproses' ? 'warning' : 'secondary'); ?>">
                                                <?= ucfirst($row['status']); ?>
                                            </span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>