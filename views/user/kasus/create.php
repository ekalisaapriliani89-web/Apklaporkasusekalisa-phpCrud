<?php
session_start();
require_once '../../../proses/session.php';
checkAdminOnly();

$kategoriList = $pdo->query("SELECT * FROM kategori ORDER BY namakategori ASC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Kasus</title>
    <link rel="stylesheet" href="../../../assets/css/bootstrap.min.css">
</head>
<body class="bg-light">
<?php include '../../component/user/navbar.php'; ?>

<div class="container my-4 col-md-6">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-primary text-white fw-bold">Tambah Data Kasus</div>
        <div class="card-body">
            <form action="../../../proses/proseskasus.php?aksi=tambah" method="POST">
                <div class="mb-3">
                    <label class="form-label">Nama Kasus / Pelanggaran</label>
                    <input type="text" name="namakasus" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <select name="idkategori" class="form-select" required>
                        <option value="">-- Pilih Kategori --</option>
                        <?php foreach ($kategoriList as $kat): ?>
                            <option value="<?= $kat['idkategori']; ?>"><?= htmlspecialchars($kat['namakategori']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Poin Pelanggaran</label>
                    <input type="number" name="poin" class="form-control" value="10" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Deskripsi / Keterangan</label>
                    <textarea name="deskripsi" class="form-control" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-success w-100">Simpan Kasus</button>
                <a href="index.php" class="btn btn-secondary w-100 mt-2">Batal</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>