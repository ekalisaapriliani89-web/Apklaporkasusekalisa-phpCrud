<?php
session_start();
require_once '../../../proses/session.php';
checkAdminOnly();

$idsanksi = $_GET['id'] ?? null;
$stmt = $pdo->prepare("SELECT * FROM sanksi WHERE idsanksi = :id");
$stmt->execute(['id' => $idsanksi]);
$sanksi = $stmt->fetch();

if (!$sanksi) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Sanksi</title>
    <link rel="stylesheet" href="../../../assets/css/bootstrap.min.css">
</head>
<body class="bg-light">
<?php include '../../component/user/navbar.php'; ?>

<div class="container my-4 col-md-6">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-info text-white fw-bold">Detail Sanksi</div>
        <div class="card-body">
            <h4><?= htmlspecialchars($sanksi['namasanksi']); ?></h4>
            <hr>
            <p><strong>Rentang Poin:</strong> <?= $sanksi['poinmin']; ?> s/d <?= $sanksi['poinmax']; ?> Poin</p>
            <p><strong>Keterangan:</strong></p>
            <p class="text-muted"><?= nl2br(htmlspecialchars($sanksi['keterangan'] ?? 'Tidak ada keterangan.')); ?></p>
            <a href="index.php" class="btn btn-secondary w-100 mt-3">Kembali</a>
        </div>
    </div>
</div>
</body>
</html>