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
    <title>Edit Kategori</title>
    <link rel="stylesheet" href="../../../assets/css/bootstrap.min.css">
</head>
<body class="bg-light">
<?php include '../../component/user/navbar.php'; ?>

<div class="container my-4 col-md-6">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-warning text-white fw-bold">Edit Kategori Kasus</div>
        <div class="card-body">
            <form action="../../../proses/proseskategori.php?aksi=edit" method="POST">
                <input type="hidden" name="idkategori" value="<?= $kategori['idkategori']; ?>">
                <div class="mb-3">
                    <label class="form-label">Nama Kategori</label>
                    <input type="text" name="namakategori" class="form-control" value="<?= htmlspecialchars($kategori['namakategori']); ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Keterangan</label>
                    <textarea name="keterangan" class="form-control" rows="3"><?= htmlspecialchars($kategori['keterangan'] ?? ''); ?></textarea>
                </div>
                <button type="submit" class="btn btn-warning text-white w-100">Update Kategori</button>
                <a href="index.php" class="btn btn-secondary w-100 mt-2">Batal</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>