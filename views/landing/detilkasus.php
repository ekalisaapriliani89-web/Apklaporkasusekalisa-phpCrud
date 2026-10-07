<?php
require_once '../../proses/koneksi.php';

$idkasus = $_GET['id'] ?? 0;
$stmt = $pdo->prepare("SELECT k.*, kat.namakategori FROM kasus k JOIN kategori kat ON k.idkategori = kat.idkategori WHERE k.idkasus = :id");
$stmt->execute(['id' => $idkasus]);
$kasus = $stmt->fetch();

if (!$kasus) {
    header("Location: daftarkasus.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Kasus - Lapor Kasus</title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
</head>
<body class="bg-light">
<?php include '../component/tamu/navbar.php'; ?>
<div class="container my-5">
    <div class="card border-0 shadow-sm col-md-8 mx-auto p-4">
        <span class="badge bg-info text-dark w-25 mb-2"><?= htmlspecialchars($kasus['namakategori']); ?></span>
        <h2 class="fw-bold"><?= htmlspecialchars($kasus['namakasus']); ?></h2>
        <hr>
        <p class="lead"><?= nl2br(htmlspecialchars($kasus['deskripsi'])); ?></p>
        <a href="daftarkasus.php" class="btn btn-secondary mt-3">Kembali ke Daftar Kasus</a>
    </div>
</div>
<?php include '../component/tamu/footer.php'; ?>
</body>
</html>