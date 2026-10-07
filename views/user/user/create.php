<?php
session_start();
require_once '../../../proses/session.php';
checkAdminOnly();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah User Baru</title>
    <link rel="stylesheet" href="../../../assets/css/bootstrap.min.css">
</head>
<body class="bg-light">
<?php include '../../component/user/navbar.php'; ?>
<div class="container my-4 col-md-6">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white fw-bold">Form Tambah User</div>
        <div class="card-body">
            <form action="../../../proses/prosesuser.php?aksi=tambah" method="POST">
                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="namauser" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Role Akses</label>
                    <select name="role" class="form-select" required>
                        <option value="petugas">Petugas</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary w-100">Simpan User</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>