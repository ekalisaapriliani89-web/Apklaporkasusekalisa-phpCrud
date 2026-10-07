<?php
session_start();
require_once '../../proses/session.php';
checkSiswaOnly();

$idsiswa = $_SESSION['idsiswa'] ?? null;

$stmtSiswa = $pdo->prepare("SELECT * FROM siswa WHERE idsiswa = :idsiswa");
$stmtSiswa->execute(['idsiswa' => $idsiswa]);
$dataSiswa = $stmtSiswa->fetch();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Profil Saya</title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
</head>
<body class="bg-light">

<?php include '../component/siswa/navbar.php'; ?>

<div class="container my-5">
    <div class="card border-0 shadow-sm col-md-6 mx-auto">
        <div class="card-header bg-white fw-bold">Profil Pelapor / Siswa</div>
        <div class="card-body text-center">
            <img src="../../assets/images/siswa/<?= !empty($dataSiswa['foto']) ? $dataSiswa['foto'] : 'default.png'; ?>" class="rounded-circle mb-3" width="120" height="120" style="object-fit:cover;">
            <h4><?= htmlspecialchars($dataSiswa['namasiswa'] ?? '-'); ?></h4>
            <p class="text-muted">Username: <?= htmlspecialchars($dataSiswa['username'] ?? '-'); ?></p>
            <hr>
            <div class="text-start">
                <p><strong>Kelas:</strong> <?= htmlspecialchars($dataSiswa['kelas'] ?? '-'); ?></p>
                <p><strong>Jenis Kelamin:</strong> <?= ucfirst($dataSiswa['jeniskelamin'] ?? '-'); ?></p>
                <p><strong>No. HP / Whatsapp:</strong> <?= htmlspecialchars($dataSiswa['nohp'] ?? '-'); ?></p>
            </div>
        </div>
    </div>
</div>

</body>
</html>