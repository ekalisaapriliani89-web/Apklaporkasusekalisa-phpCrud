<?php
session_start();
require_once '../../../proses/session.php';
checkAdminOnly();

$stmt = $pdo->query("SELECT k.*, kat.namakategori 
                     FROM kasus k 
                     LEFT JOIN kategori kat ON k.idkategori = kat.idkategori 
                     ORDER BY k.idkasus DESC");
$daftarKasus = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Kasus</title>
    <link rel="stylesheet" href="../../../assets/css/bootstrap.min.css">
</head>
<body class="bg-light">
<?php include '../../component/user/navbar.php'; ?>

<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold">Daftar Jenis Kasus</h4>
        <a href="create.php" class="btn btn-primary">+ Tambah Kasus Baru</a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Kasus</th>
                        <th>Kategori</th>
                        <th>Point/Bobot</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($daftarKasus)): ?>
                        <tr><td colspan="5" class="text-center py-3 text-muted">Belum ada data kasus.</td></tr>
                    <?php else: ?>
                        <?php foreach ($daftarKasus as $i => $k): ?>
                            <tr>
                                <td><?= $i + 1; ?></td>
                                <td><?= htmlspecialchars($k['namakasus']); ?></td>
                                <td><?= htmlspecialchars($k['namakategori'] ?? '-'); ?></td>
                                <td><span class="badge bg-danger"><?= $k['poin'] ?? 0; ?> Poin</span></td>
                                <td>
                                    <a href="show.php?id=<?= $k['idkasus']; ?>" class="btn btn-sm btn-info text-white">Detail</a>
                                    <a href="edit.php?id=<?= $k['idkasus']; ?>" class="btn btn-sm btn-warning">Edit</a>
                                    <a href="../../../proses/proseskasus.php?aksi=hapus&id=<?= $k['idkasus']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
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