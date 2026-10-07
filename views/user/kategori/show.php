<?php
session_start();
require_once '../../../proses/session.php';
checkAdminOnly();

$idkategori = $_GET['id'] ?? null;
$stmt = $pdo->prepare("SELECT * FROM kategori WHERE idkategori = :id");
$stmt->execute(['id' => $idkategori]);
$kategori = $stmt->fetch();

if (!$kategori) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Kategori</title>
    <link rel="stylesheet" href="../../../assets/css/bootstrap.min.css">
</head>
<body class="bg-light">
<?php include '../../component/user/navbar.php'; ?>

<div class="container my-4 col-md-6">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-info text-white fw-bold">Detail Kategori Kasus</div>
        <div class="card-body">
            <h4><?= htmlspecialchars($kategori['namakategori']); ?></h4>
            <hr>
            <p><strong>Keterangan:</strong></p>
            <p class="text-muted"><?= nl2br(htmlspecialchars($kategori['keterangan'] ?? 'Tidak ada keterangan.')); ?></p>
            <a href="index.php" class="btn btn-secondary w-100 mt-3">Kembali</a>
        </div>
    </div>
</div>
</body>
</html>