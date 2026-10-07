<?php
session_start();
require_once '../../../proses/session.php';
checkAdminOnly();

$stmt = $pdo->query("SELECT * FROM pelapor ORDER BY idpelapor DESC");
$daftarPelapor = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Pelapor</title>
    <link rel="stylesheet" href="../../../assets/css/bootstrap.min.css">
</head>
<body class="bg-light">
<?php include '../../component/user/navbar.php'; ?>

<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold">Daftar Pelapor</h4>
        <a href="create.php" class="btn btn-primary">+ Tambah Pelapor</a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Pelapor</th>
                        <th>Status / Peran</th>
                        <th>No. Telepon</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($daftarPelapor)): ?>
                        <tr><td colspan="5" class="text-center py-3 text-muted">Belum ada data pelapor.</td></tr>
                    <?php else: ?>
                        <?php foreach ($daftarPelapor as $i => $p): ?>
                            <tr>
                                <td><?= $i + 1; ?></td>
                                <td><?= htmlspecialchars($p['namapelapor']); ?></td>
                                <td><span class="badge bg-secondary"><?= htmlspecialchars($p['statuspelapor'] ?? 'Umum'); ?></span></td>
                                <td><?= htmlspecialchars($p['notelp'] ?? '-'); ?></td>
                                <td>
                                    <a href="show.php?id=<?= $p['idpelapor']; ?>" class="btn btn-sm btn-info text-white">Detail</a>
                                    <a href="edit.php?id=<?= $p['idpelapor']; ?>" class="btn btn-sm btn-warning">Edit</a>
                                    <a href="../../../proses/prosespelapor.php?aksi=hapus&id=<?= $p['idpelapor']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus pelapor ini?')">Hapus</a>
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