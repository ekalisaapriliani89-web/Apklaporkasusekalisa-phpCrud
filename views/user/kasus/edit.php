<?php
session_start();
require_once '../../../proses/session.php';
checkAdminOnly();

$idkasus = $_GET['id'] ?? null;
$stmt = $pdo->prepare("SELECT * FROM kasus WHERE idkasus = :id");
$stmt->execute(['id' => $idkasus]);
$kasus = $stmt->fetch();

if (!$kasus) {
    header("Location: index.php");
    exit;
}

$kategoriList = $pdo->query("SELECT * FROM kategori ORDER BY namakategori ASC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Kasus</title>
    <link rel="stylesheet" href="../../../assets/css/bootstrap.min.css">
</head>
<body class="bg-light">
<?php include '../../component/user/navbar.php'; ?>

<div class="container my-4 col-md-6">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-warning text-white fw-bold">Edit Data Kasus</div>
        <div class="card-body">
            <form action="../../../proses/proseskasus.php?aksi=edit" method="POST">
                <input type="hidden" name="idkasus" value="<?= $kasus['idkasus']; ?>">
                <div class="mb-3">
                    <label class="form-label">Nama Kasus</label>
                    <input type="text" name="namakasus" class="form-control" value="<?= htmlspecialchars($kasus['namakasus']); ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <select name="idkategori" class="form-select" required>
                        <?php foreach ($kategoriList as $kat): ?>
                            <option value="<?= $kat['idkategori']; ?>" <?= $kat['idkategori'] == $kasus['idkategori'] ? 'selected' : ''; ?>>
                                <?= htmlspecialchars($kat['namakategori']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Poin Pelanggaran</label>
                    <input type="number" name="poin" class="form-control" value="<?= $kasus['poin']; ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="3"><?= htmlspecialchars($kasus['deskripsi'] ?? ''); ?></textarea>
                </div>
                <button type="submit" class="btn btn-warning text-white w-100">Update Kasus</button>
                <a href="index.php" class="btn btn-secondary w-100 mt-2">Batal</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>