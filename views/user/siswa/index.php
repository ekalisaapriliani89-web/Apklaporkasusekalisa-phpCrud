<?php
session_start();
require_once '../../../proses/session.php';
checkAdminOnly();

$idsiswa = $_GET['id'] ?? null;
$stmt = $pdo->prepare("SELECT * FROM siswa WHERE idsiswa = :id");
$stmt->execute(['id' => $idsiswa]);
$siswa = $stmt->fetch();

if (!$siswa) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Siswa</title>
    <link rel="stylesheet" href="../../../assets/css/bootstrap.min.css">
</head>
<body class="bg-light">
<?php include '../../component/user/navbar.php'; ?>

<div class="container my-4 col-md-6">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-info text-white fw-bold">Detail Data Siswa</div>
        <div class="card-body">
            <h4><?= htmlspecialchars($siswa['namasiswa']); ?></h4>
            <hr>
            <p><strong>NISN:</strong> <?= htmlspecialchars($siswa['nisn']); ?></p>
            <p><strong>Kelas:</strong> <?= htmlspecialchars($siswa['kelas']); ?></p>
            <p><strong>Jenis Kelamin:</strong> <?= $siswa['jeniskelamin'] === 'L' ? 'Laki-laki' : 'Perempuan'; ?></p>
            <p><strong>Alamat:</strong></p>
            <p class="text-muted"><?= nl2br(htmlspecialchars($siswa['alamat'] ?? 'Tidak ada alamat.')); ?></p>
            <a href="index.php" class="btn btn-secondary w-100 mt-3">Kembali</a>
        </div>
    </div>
</div>
</body>
</html>