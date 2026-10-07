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
    <title>Edit Sanksi</title>
    <link rel="stylesheet" href="../../../assets/css/bootstrap.min.css">
</head>
<body class="bg-light">
<?php include '../../component/user/navbar.php'; ?>

<div class="container my-4 col-md-6">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-warning text-white fw-bold">Edit Data Sanksi</div>
        <div class="card-body">
            <form action="../../../proses/prosessanksi.php?aksi=edit" method="POST">
                <input type="hidden" name="idsanksi" value="<?= $sanksi['idsanksi']; ?>">
                <div class="mb-3">
                    <label class="form-label">Nama / Bentuk Sanksi</label>
                    <input type="text" name="namasanksi" class="form-control" value="<?= htmlspecialchars($sanksi['namasanksi']); ?>" required>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Minimal Poin</label>
                        <input type="number" name="poinmin" class="form-control" value="<?= $sanksi['poinmin']; ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Maksimal Poin</label>
                        <input type="number" name="poinmax" class="form-control" value="<?= $sanksi['poinmax']; ?>" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Keterangan</label>
                    <textarea name="keterangan" class="form-control" rows="3"><?= htmlspecialchars($sanksi['keterangan'] ?? ''); ?></textarea>
                </div>
                <button type="submit" class="btn btn-warning text-white w-100">Update Sanksi</button>
                <a href="index.php" class="btn btn-secondary w-100 mt-2">Batal</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>