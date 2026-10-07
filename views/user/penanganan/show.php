<?php
session_start();
require_once '../../../proses/session.php';

$idpenanganan = $_GET['id'] ?? null;
$stmt = $pdo->prepare("SELECT * FROM penanganan WHERE idpenanganan = :id");
$stmt->execute(['id' => $idpenanganan]);
$penanganan = $stmt->fetch();

if (!$penanganan) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Penanganan</title>
    <link rel="stylesheet" href="../../../assets/css/bootstrap.min.css">
</head>
<body class="bg-light">
<?php include '../../component/user/navbar.php'; ?>

<div class="container my-4 col-md-6">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-warning text-white fw-bold">Edit Penanganan Kasus</div>
        <div class="card-body">
            <form action="../../../proses/prosespenanganan.php?aksi=edit" method="POST">
                <input type="hidden" name="idpenanganan" value="<?= $penanganan['idpenanganan']; ?>">
                <div class="mb-3">
                    <label class="form-label">Tanggal Penanganan</label>
                    <input type="date" name="tglpenanganan" class="form-control" value="<?= $penanganan['tglpenanganan']; ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tindakan</label>
                    <input type="text" name="tindakan" class="form-control" value="<?= htmlspecialchars($penanganan['tindakan']); ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Hasil / Catatan</label>
                    <textarea name="keterangan" class="form-control" rows="3" required><?= htmlspecialchars($penanganan['keterangan'] ?? ''); ?></textarea>
                </div>
                <button type="submit" class="btn btn-warning text-white w-100">Update Data</button>
                <a href="index.php" class="btn btn-secondary w-100 mt-2">Batal</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>