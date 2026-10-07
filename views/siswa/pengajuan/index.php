<?php
session_start();
require_once '../../../proses/session.php';
checkSiswaOnly();

$idsiswa = $_SESSION['idsiswa'];

$stmt = $pdo->prepare("SELECT p.*, k.namakasus FROM pengajuan p 
                       JOIN kasus k ON p.idkasus = k.idkasus 
                       WHERE p.idsiswa = :idsiswa 
                       ORDER BY p.idpengajuan DESC");
$stmt->execute(['idsiswa' => $idsiswa]);
$daftarPengajuan = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Pengajuan Saya</title>
    <link rel="stylesheet" href="../../../assets/css/bootstrap.min.css">
</head>
<body class="bg-light">
<?php include '../../component/siswa/navbar.php'; ?>

<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold">Daftar Pengajuan Laporan Saya</h4>
        <a href="create.php" class="btn btn-primary">+ Buat Pengajuan Baru</a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Jenis Kasus</th>
                        <th>Tgl Kejadian</th>
                        <th>Keterangan / Kronologi</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($daftarPengajuan)): ?>
                        <tr><td colspan="5" class="text-center py-3 text-muted">Belum ada pengajuan laporan.</td></tr>
                    <?php else: ?>
                        <?php foreach ($daftarPengajuan as $i => $p): ?>
                            <tr>
                                <td><?= $i + 1; ?></td>
                                <td><?= htmlspecialchars($p['namakasus']); ?></td>
                                <td><?= date('d-m-Y', strtotime($p['tglpengajuan'])); ?></td>
                                <td><?= htmlspecialchars($p['keterangan']); ?></td>
                                <td>
                                    <span class="badge bg-<?= $p['status'] === 'selesai' ? 'success' : ($p['status'] === 'diproses' ? 'warning' : 'secondary'); ?>">
                                        <?= ucfirst($p['status']); ?>
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
</body>
</html>