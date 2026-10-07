<?php
session_start();
require_once '../../../proses/session.php';
checkAdminOnly();

$idkasus = $_GET['id'] ?? null;
$stmt = $pdo->prepare("SELECT k.*, kat.namakategori 
                       FROM kasus k 
                       LEFT JOIN kategori kat ON k.idkategori = kat.idkategori 
                       WHERE k.idkasus = :id");
$stmt->execute(['id' => $idkasus]);
$kasus = $stmt->fetch();

if (!$kasus) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Kasus</title>
    <link rel="stylesheet" href="../../../assets/css/bootstrap.min.css">
</head>
<body class="bg-light">
<?php include '../../component/user/navbar.php'; ?>

<div class="container my-4 col-md-6">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-info text-white fw-bold">Detail Kasus</div>
        <div class="card-body">
            <h4><?= htmlspecialchars($kasus['namakasus']); ?></h4>
            <hr>
            <p><strong>Kategori:</strong> <?= htmlspecialchars($kasus['namakategori'] ?? '-'); ?></p>
            <p><strong>Poin Pelanggaran:</strong> <span class="badge bg-danger"><?= $kasus['poin']; ?> Poin</span></p>
            <p><strong>Deskripsi:</strong></p>
            <p class="text-muted"><?= nl2br(htmlspecialchars($kasus['deskripsi'] ?? 'Tidak ada deskripsi.')); ?></p>
            <a href="index.php" class="btn btn-secondary w-100 mt-3">Kembali</a>
        </div>
    </div>
</div>
</body>
</html>