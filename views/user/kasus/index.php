<?php
session_start();
require_once '../../../proses/session.php';
checkLogin();

$kasusList = $pdo->query("SELECT k.*, kat.namakategori FROM kasus k JOIN kategori kat ON k.idkategori = kat.idkategori ORDER BY k.idkasus DESC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Jenis Kasus</title>
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
                <h4 class="fw-bold">Data Jenis Kasus</h4>
                <a href="create.php" class="btn btn-primary">+ Tambah Kasus</a>
            </div>
            <div class="card border-0 shadow-sm">
                <div class="card-body p-0">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr><th>No</th><th>Nama Kasus</th><th>Kategori</th><th>Deskripsi</th><th>Aksi</th></tr>
                        </thead>
                        <tbody>
                            <?php foreach ($kasusList as $i => $k): ?>
                                <tr>
                                    <td><?= $i + 1; ?></td>
                                    <td class="fw-bold"><?= htmlspecialchars($k['namakasus']); ?></td>
                                    <td><span class="badge bg-secondary"><?= htmlspecialchars($k['namakategori']); ?></span></td>
                                    <td><?= htmlspecialchars($k['deskripsi']); ?></td>
                                    <td>
                                        <a href="../../../proses/proseskasus.php?aksi=hapus&id=<?= $k['idkasus']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus kasus ini?')">Hapus</a>
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