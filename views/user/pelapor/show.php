<?php
session_start();
require_once '../../../proses/session.php';
checkAdminOnly();

$idpelapor = $_GET['id'] ?? null;
$stmt = $pdo->prepare("SELECT * FROM pelapor WHERE idpelapor = :id");
$stmt->execute(['id' => $idpelapor]);
$pelapor = $stmt->fetch();

if (!$pelapor) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Pelapor</title>
    <link rel="stylesheet" href="../../../assets/css/bootstrap.min.css">
</head>
<body class="bg-light">
<?php include '../../component/user/navbar.php'; ?>

<div class="container my-4 col-md-6">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-warning text-white fw-bold">Edit Data Pelapor</div>
        <div class="card-body">
            <form action="../../../proses/prosespelapor.php?aksi=edit" method="POST">
                <input type="hidden" name="idpelapor" value="<?= $pelapor['idpelapor']; ?>">
                <div class="mb-3">
                    <label class="form-label">Nama Lengkap Pelapor</label>
                    <input type="text" name="namapelapor" class="form-control" value="<?= htmlspecialchars($pelapor['namapelapor']); ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Status Pelapor</label>
                    <select name="statuspelapor" class="form-select" required>
                        <?php foreach (['Siswa', 'Guru', 'Orang Tua', 'Masyarakat'] as $st): ?>
                            <option value="<?= $st; ?>" <?= ($pelapor['statuspelapor'] ?? '') === $st ? 'selected' : ''; ?>><?= $st; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">No. Telepon / WA</label>
                    <input type="text" name="notelp" class="form-control" value="<?= htmlspecialchars($pelapor['notelp'] ?? ''); ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <textarea name="alamat" class="form-control" rows="3"><?= htmlspecialchars($pelapor['alamat'] ?? ''); ?></textarea>
                </div>
                <button type="submit" class="btn btn-warning text-white w-100">Update Pelapor</button>
                <a href="index.php" class="btn btn-secondary w-100 mt-2">Batal</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>