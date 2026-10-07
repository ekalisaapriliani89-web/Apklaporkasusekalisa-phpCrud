<?php
session_start();
require_once '../../../proses/session.php';
checkLogin();

$sanksiList = $pdo->query("SELECT * FROM sanksi ORDER BY idsanksi DESC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Sanksi Kasus</title>
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
            <div class="d-flex justify-content-between mb-3">
                <h4 class="fw-bold">Data Sanksi Pelanggaran</h4>
                <a href="create.php" class="btn btn-primary">+ Tambah Sanksi</a>
            </div>
            <div class="card border-0 shadow-sm">
                <div class="card-body p-0">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr><th>No</th><th>Nama Sanksi</th><th>Bobot Poin</th><th>Keterangan</th><th>Aksi</th></tr>
                        </thead>
                        <tbody>
                            <?php foreach ($sanksiList as $i => $s): ?>
                                <tr>
                                    <td><?= $i + 1; ?></td>
                                    <td class="fw-bold"><?= htmlspecialchars($s['namasanksi']); ?></td>
                                    <td><span class="badge bg-danger"><?= $s['bobot']; ?> Poin</span></td>
                                    <td><?= htmlspecialchars($s['keterangan']); ?></td>
                                    <td>
                                        <a href="../../../proses/prosessanksi.php?aksi=hapus&id=<?= $s['idsanksi']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus sanksi ini?')">Hapus</a>
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