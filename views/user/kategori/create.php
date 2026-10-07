<?php
session_start();
require_once '../../../proses/session.php';
checkAdminOnly();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Kategori</title>
    <link rel="stylesheet" href="../../../assets/css/bootstrap.min.css">
</head>
<body class="bg-light">
<?php include '../../component/user/navbar.php'; ?>

<div class="container my-4 col-md-6">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-primary text-white fw-bold">Tambah Kategori Kasus</div>
        <div class="card-body">
            <form action="../../../proses/proseskategori.php?aksi=tambah" method="POST">
                <div class="mb-3">
                    <label class="form-label">Nama Kategori</label>
                    <input type="text" name="namakategori" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Keterangan</label>
                    <textarea name="keterangan" class="form-control" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-success w-100">Simpan Kategori</button>
                <a href="index.php" class="btn btn-secondary w-100 mt-2">Batal</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>