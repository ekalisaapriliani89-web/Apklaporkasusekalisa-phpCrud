<?php
session_start();
require_once '../../../proses/session.php';
checkLogin();

$pengajuanList = $pdo->query("SELECT p.*, s.namasiswa, s.kelas, k.namakasus 
                              FROM pengajuan p
                              JOIN siswa s ON p.idsiswa = s.idsiswa
                              JOIN kasus k ON p.idkasus = k.idkasus
                              ORDER BY p.idpengajuan DESC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Penanganan Kasus - Petugas</title>
    <link rel="stylesheet" href="../../../assets/css/bootstrap.min.css">
</head>
<body class="bg-light">
<?php include '../../component/user/navbar.php'; ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 p-0 bg-dark min-vh-100">
            <?php if ($_SESSION['role'] === 'admin'): ?>
                <?php include '../../component/user/sidebaradmin.php'; ?>
            <?php else: ?>
                <?php include '../../component/user/sidebarpetugas.php'; ?>
            <?php endif; ?>
        </div>
        <div class="col-md-10 p-4">
            <h4 class="fw-bold mb-3">Daftar Pengajuan Laporan Siswa</h4>
            <div class="card border-0 shadow-sm">
                <div class="card-body p-0">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Pelapor (Siswa)</th>
                                <th>Kelas</th>
                                <th>Kasus</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($pengajuanList as $i => $p): ?>
                                <tr>
                                    <td><?= $i + 1; ?></td>
                                    <td><?= htmlspecialchars($p['namasiswa']); ?></td>
                                    <td><?= htmlspecialchars($p['kelas']); ?></td>
                                    <td><?= htmlspecialchars($p['namakasus']); ?></td>
                                    <td><?= $p['tglpengajuan']; ?></td>
                                    <td>
                                        <span class="badge bg-<?= $p['status'] == 'selesai' ? 'success' : ($p['status'] == 'diproses' ? 'warning' : 'secondary'); ?>">
                                            <?= ucfirst($p['status']); ?>
                                        </span>
                                    </td>
                                    <td>
                                        <a href="proses.php?id=<?= $p['idpengajuan']; ?>" class="btn btn-sm btn-primary">Tindak Lanjuti</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>