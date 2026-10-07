<?php
require_once '../../proses/koneksi.php';

$stmt = $pdo->query("SELECT k.*, kat.namakategori FROM kasus k JOIN kategori kat ON k.idkategori = kat.idkategori ORDER BY k.idkasus DESC");
$kasusList = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Kasus - Lapor Kasus</title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
</head>
<body class="bg-light">
<?php include '../component/tamu/navbar.php'; ?>
<div class="container my-5">
    <h3 class="fw-bold mb-4">Daftar Jenis Kasus Pelanggaran</h3>
    <div class="row g-4">
        <?php foreach ($kasusList as $kasus): ?>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body">
                        <span class="badge bg-primary mb-2"><?= htmlspecialchars($kasus['namakategori']); ?></span>
                        <h5 class="card-title fw-bold"><?= htmlspecialchars($kasus['namakasus']); ?></h5>
                        <p class="card-text text-muted"><?= htmlspecialchars(substr($kasus['deskripsi'], 0, 100)); ?>...</p>
                        <a href="detilkasus.php?id=<?= $kasus['idkasus']; ?>" class="btn btn-sm btn-outline-primary">Lihat Detail</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php include '../component/tamu/footer.php'; ?>
</body>
</html>