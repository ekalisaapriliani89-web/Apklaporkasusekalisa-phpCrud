<?php
session_start();
require_once '../../../proses/session.php';

$stmt = $pdo->query("SELECT pen.*, s.namasiswa, k.namakasus, u.namauser 
                     FROM penanganan pen
                     LEFT JOIN pengajuan p ON pen.idpengajuan = p.idpengajuan
                     LEFT JOIN siswa s ON p.idsiswa = s.idsiswa
                     LEFT JOIN kasus k ON p.idkasus = k.idkasus
                     LEFT JOIN user u ON pen.iduser = u.iduser
                     ORDER BY pen.idpenanganan DESC");
$daftarPenanganan = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Penanganan Kasus</title>
    <link rel="stylesheet" href="../../../assets/css/bootstrap.min.css">
</head>
<body class="bg-light">
<?php include '../../component/user/navbar.php'; ?>

<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold">Riwayat Penanganan Kasus</h4>
        <a href="create.php" class="btn btn-primary">+ Tambah Penanganan</a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Tgl Penanganan</th>
                        <th>Siswa</th>
                        <th>Kasus</th>
                        <th>Petugas</th>
                        <th>Tindakan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($daftarPenanganan)): ?>
                        <tr><td colspan="7" class="text-center py-3 text-muted">Belum ada catatan penanganan.</td></tr>
                    <?php else: ?>
                        <?php foreach ($daftarPenanganan as $i => $pn): ?>
                            <tr>
                                <td><?= $i + 1; ?></td>
                                <td><?= date('d-m-Y', strtotime($pn['tglpenanganan'])); ?></td>
                                <td><?= htmlspecialchars($pn['namasiswa'] ?? '-'); ?></td>
                                <td><?= htmlspecialchars($pn['namakasus'] ?? '-'); ?></td>
                                <td><?= htmlspecialchars($pn['namauser'] ?? '-'); ?></td>
                                <td><?= htmlspecialchars($pn['tindakan'] ?? '-'); ?></td>
                                <td>
                                    <a href="show.php?id=<?= $pn['idpenanganan']; ?>" class="btn btn-sm btn-info text-white">Detail</a>
                                    <a href="edit.php?id=<?= $pn['idpenanganan']; ?>" class="btn btn-sm btn-warning">Edit</a>
                                    <a href="../../../proses/prosespenanganan.php?aksi=hapus&id=<?= $pn['idpenanganan']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus data ini?')">Hapus</a>
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