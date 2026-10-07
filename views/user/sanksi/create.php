<?php
session_start();
require_once '../../../proses/session.php';
checkAdminOnly();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Sanksi</title>
    <link rel="stylesheet" href="../../../assets/css/bootstrap.min.css">
</head>
<body class="bg-light">
<?php include '../../component/user/navbar.php'; ?>

<div class="container my-4 col-md-6">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-primary text-white fw-bold">Tambah Data Sanksi</div>
        <div class="card-body">
            <form action="../../../proses/prosessanksi.php?aksi=tambah" method="POST">
                <div class="mb-3">
                    <label class="form-label">Nama / Bentuk Sanksi</label>
                    <input type="text" name="namasanksi" class="form-control" placeholder="Contoh: Surat Peringatan 1 (SP1)" required>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Minimal Poin Pelanggaran</label>
                        <input type="number" name="poinmin" class="form-control" value="10" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Maksimal Poin Pelanggaran</label>
                        <input type="number" name="poinmax" class="form-control" value="30" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Keterangan / Deskripsi Sanksi</label>
                    <textarea name="keterangan" class="form-control" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-success w-100">Simpan Sanksi</button>
                <a href="index.php" class="btn btn-secondary w-100 mt-2">Batal</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>