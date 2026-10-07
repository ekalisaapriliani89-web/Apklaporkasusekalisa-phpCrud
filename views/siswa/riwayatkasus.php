<?php
session_start();
require_once '../../proses/session.php';
checkSiswaOnly();

$idsiswa = $_SESSION['idsiswa'];
$stmt = $pdo->prepare("SELECT p.*, k.namakasus, pen.catatan, s.namasanksi 
                       FROM pengajuan p
                       JOIN kasus k ON p.idkasus = k.idkasus
                       LEFT JOIN penanganan pen ON p.idpengajuan = pen.idpengajuan
                       LEFT JOIN sanksi s ON pen.idsanksi = s.idsanksi
                       WHERE p.idsiswa = :idsiswa
                       ORDER BY p.idpengajuan DESC");
$stmt->execute(['idsiswa' => $idsiswa]);
$riwayat = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Status Kasus</title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
</head>
<body class="bg-light">
<?php include '../component/siswa/navbar.php'; ?>
<div class="container my-4">
    <h4 class="fw-bold mb-3">Status & Riwayat Penanganan Kasus</h4>
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Jenis Kasus</th>
                        <th>Tanggal Pengajuan</th>
                        <th>Status</th>
                        <th>Tindakan / Sanksi</th>
                        <th>Catatan Petugas</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($riwayat as $i => $row): ?>
                        <tr>
                            <td><?= $i + 1; ?></td>
                            <td><?= htmlspecialchars($row['namakasus']); ?></td>
                            <td><?= $row['tglpengajuan']; ?></td>
                            <td><span class="badge bg-info"><?= ucfirst($row['status']); ?></span></td>
                            <td><?= htmlspecialchars($row['namasanksi'] ?? '-'); ?></td>
                            <td><?= htmlspecialchars($row['catatan'] ?? 'Belum ada tindakan'); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>