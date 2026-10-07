<?php
session_start();
require_once '../../../proses/session.php';

// Cek hak akses
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'petugas') {
    header("Location: ../../auth/loginuser.php");
    exit;
}

$iduser = $_SESSION['iduser'] ?? null;

// Query statistik
$pendingCount = $pdo->query("SELECT COUNT(*) FROM pengajuan WHERE status = 'pending'")->fetchColumn();
$diprosesCount = $pdo->query("SELECT COUNT(*) FROM pengajuan WHERE status = 'diproses'")->fetchColumn();

// Query penanganan
$stmtSelesai = $pdo->prepare("SELECT COUNT(*) FROM penanganan WHERE iduser = :iduser");
$stmtSelesai->execute(['iduser' => $iduser]);
$selesaiCount = $stmtSelesai->fetchColumn();

// Query antrean pengajuan
$stmtAntrean = $pdo->query("SELECT p.*, s.namasiswa, s.kelas, k.namakasus 
                            FROM pengajuan p
                            JOIN siswa s ON p.idsiswa = s.idsiswa
                            JOIN kasus k ON p.idkasus = k.idkasus
                            WHERE p.status != 'selesai'
                            ORDER BY p.idpengajuan ASC");
$antrean = $stmtAntrean->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Petugas BK</title>
    <link rel="stylesheet" href="../../../assets/css/bootstrap.min.css">
</head>
<body class="bg-light">

<?php include '../../component/user/navbar.php'; ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 p-0 bg-dark min-vh-100">
            <?php include '../../component/user/sidebarpetugas.php'; ?>
        </div>
        <div class="col-md-10 p-4">
            <h3 class="fw-bold mb-4">Dashboard Petugas / Guru BK</h3>

            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm bg-danger text-white p-3">
                        <h6>Laporan Pending</h6>
                        <h2 class="fw-bold mb-0"><?= $pendingCount; ?></h2>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm bg-warning text-white p-3">
                        <h6>Sedang Diproses</h6>
                        <h2 class="fw-bold mb-0"><?= $diprosesCount; ?></h2>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm bg-success text-white p-3">
                        <h6>Penanganan Saya</h6>
                        <h2 class="fw-bold mb-0"><?= $selesaiCount; ?></h2>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white fw-bold py-3">Antrean Laporan Kasus Masuk</div>
                <div class="card-body p-0">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Tgl Masuk</th>
                                <th>Siswa</th>
                                <th>Kelas</th>
                                <th>Kasus</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($antrean)): ?>
                                <tr><td colspan="7" class="text-center py-3 text-muted">Tidak ada antrean pengajuan laporan.</td></tr>
                            <?php else: ?>
                                <?php foreach ($antrean as $i => $row): ?>
                                    <tr>
                                        <td><?= $i + 1; ?></td>
                                        <td><?= date('d-m-Y', strtotime($row['tglpengajuan'])); ?></td>
                                        <td><?= htmlspecialchars($row['namasiswa']); ?></td>
                                        <td><?= htmlspecialchars($row['kelas']); ?></td>
                                        <td><?= htmlspecialchars($row['namakasus']); ?></td>
                                        <td>
                                            <span class="badge bg-<?= $row['status'] === 'diproses' ? 'warning' : 'danger'; ?>">
                                                <?= ucfirst($row['status']); ?>
                                            </span>
                                        </td>
                                        <td>
                                            <a href="../penanganan/create.php?idpengajuan=<?= $row['idpengajuan']; ?>" class="btn btn-sm btn-primary">Proses / Tangani</a>
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