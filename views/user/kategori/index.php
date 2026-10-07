<?php
session_start();
require_once '../../../proses/session.php';
checkLogin();

$kategori = $pdo->query("SELECT * FROM kategori ORDER BY idkategori DESC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Kategori Kasus</title>
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
                <h4 class="fw-bold">Kategori Kasus</h4>
                <a href="create.php" class="btn btn-primary">+ Tambah Kategori</a>
            </div>
            <div class="card border-0 shadow-sm">
                <div class="card-body p-0">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr><th>No</th><th>Nama Kategori</th><th>Deskripsi</th><th>Aksi</th></tr>
                        </thead>
                        <tbody>
                            <?php foreach ($kategori as $i => $k): ?>
                                <tr>
                                    <td><?= $i + 1; ?></td>
                                    <td class="fw-bold"><?= htmlspecialchars($k['namakategori']); ?></td>
                                    <td><?= htmlspecialchars($k['deskripsi']); ?></td>
                                    <td>
                                        <a href="edit.php?id=<?= $k['idkategori']; ?>" class="btn btn-sm btn-warning">Edit</a>
                                        <a href="../../../proses/proseskategori.php?aksi=hapus&id=<?= $k['idkategori']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus kategori ini?')">Hapus</a>
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