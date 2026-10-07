<?php
session_start();
require_once '../../proses/session.php';
checkSiswaOnly();

$idsiswa = $_SESSION['idsiswa'] ?? null;

// Ambil data siswa
$stmtSiswa = $pdo->prepare("SELECT * FROM siswa WHERE idsiswa = :idsiswa");
$stmtSiswa->execute(['idsiswa' => $idsiswa]);
$dataSiswa = $stmtSiswa->fetch();

// Ambil jumlah pengajuan
$stmtTotal = $pdo->prepare("SELECT COUNT(*) FROM pengajuan WHERE idsiswa = :idsiswa");
$stmtTotal->execute(['idsiswa' => $idsiswa]);
$totalPengajuan = $stmtTotal->fetchColumn();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa</title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
</head>
<body class="bg-light">

<?php include '../component/siswa/navbar.php'; ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 p-0 bg-white border-end min-vh-100">
            <?php include '../component/siswa/sidebar.php'; ?>
        </div>
        <div class="col-md-10 p-4">
            <h3 class="fw-bold mb-3">Selamat Datang, <?= htmlspecialchars($dataSiswa['namasiswa'] ?? 'Siswa'); ?>!</h3>
            
            <div class="row g-3">
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm bg-primary text-white p-3">
                        <h5>Total Laporan Kamu</h5>
                        <h2 class="fw-bold"><?= $totalPengajuan; ?></h2>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm bg-success text-white p-3">
                        <h5>Kelas</h5>
                        <h2 class="fw-bold"><?= htmlspecialchars($dataSiswa['kelas'] ?? '-'); ?></h2>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <a href="pengajuan/create.php" class="btn btn-primary btn-lg">+ Buat Laporan Kasus Baru</a>
            </div>
        </div>
    </div>
</div>

</body>
</html>