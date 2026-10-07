<?php
session_start();
require_once '../../../proses/session.php';
checkAdminOnly();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Pelapor</title>
    <link rel="stylesheet" href="../../../assets/css/bootstrap.min.css">
</head>
<body class="bg-light">
<?php include '../../component/user/navbar.php'; ?>

<div class="container my-4 col-md-6">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-primary text-white fw-bold">Tambah Data Pelapor</div>
        <div class="card-body">
            <form action="../../../proses/prosespelapor.php?aksi=tambah" method="POST">
                <div class="mb-3">
                    <label class="form-label">Nama Lengkap Pelapor</label>
                    <input type="text" name="namapelapor" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Status Pelapor</label>
                    <select name="statuspelapor" class="form-select" required>
                        <option value="Siswa">Siswa</option>
                        <option value="Guru">Guru / Staf</option>
                        <option value="Orang Tua">Orang Tua</option>
                        <option value="Masyarakat">Masyarakat</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">No. Telepon / WA</label>
                    <input type="text" name="notelp" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <textarea name="alamat" class="form-control" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-success w-100">Simpan Pelapor</button>
                <a href="index.php" class="btn btn-secondary w-100 mt-2">Batal</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>