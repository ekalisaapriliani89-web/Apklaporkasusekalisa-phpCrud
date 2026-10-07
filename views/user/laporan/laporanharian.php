<?php
session_start();
require_once '../../../proses/session.php';
checkLogin();

$tgl = $_GET['tgl'] ?? date('Y-m-d');

$stmt = $pdo->prepare("SELECT pen.*, p.tglpengajuan, s.namasiswa, s.kelas, k.namakasus, sn.namasanksi, u.namauser 
                       FROM penanganan pen
                       JOIN pengajuan p ON pen.idpengajuan = p.idpengajuan
                       JOIN siswa s ON p.idsiswa = s.idsiswa
                       JOIN kasus k ON p.idkasus = k.idkasus
                       JOIN sanksi sn ON pen.idsanksi = sn.idsanksi
                       JOIN user u ON pen.iduser = u.iduser
                       WHERE pen.tglpenanganan = :tgl
                       ORDER BY pen.idpenanganan DESC");
$stmt->execute(['tgl' => $tgl]);
$laporan = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Harian Kasus</title>
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
            <h4 class="fw-bold mb-3">Laporan Penanganan Kasus Harian</h4>
            
            <form method="GET" class="row g-3 mb-4">
                <div class="col-auto">
                    <input type="date" name="tgl" class="form-control" value="<?= $tgl; ?>">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="cetaklaporanharian.php?tgl=<?= $tgl; ?>" target="_blank" class="btn btn-success">Cetak PDF / Print</a>
                </div>
            </form>

            <div class="card border-0 shadow-sm">
                <div class="card-body p-0">
                    <table class="table table-striped mb-0">
                        <thead class="table-dark">
                            <tr><th>No</th><th>Siswa</th><th>Kelas</th><th>Kasus</th><th>Sanksi</th><th>Petugas</th></tr>
                        </thead>
                        <tbody>
                            <?php if (empty($laporan)): ?>
                                <tr><td colspan="6" class="text-center py-3">Tidak ada data penanganan pada tanggal ini.</td></tr>
                            <?php else: ?>
                                <?php foreach ($laporan as $i => $l): ?>
                                    <tr>
                                        <td><?= $i + 1; ?></td>
                                        <td><?= htmlspecialchars($l['namasiswa']); ?></td>
                                        <td><?= htmlspecialchars($l['kelas']); ?></td>
                                        <td><?= htmlspecialchars($l['namakasus']); ?></td>
                                        <td><?= htmlspecialchars($l['namasanksi']); ?></td>
                                        <td><?= htmlspecialchars($l['namauser']); ?></td>
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