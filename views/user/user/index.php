<?php
session_start();
require_once '../../../proses/session.php';
checkAdminOnly();

$userList = $pdo->query("SELECT * FROM user ORDER BY iduser DESC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Manajemen User - Admin</title>
    <link rel="stylesheet" href="../../../assets/css/bootstrap.min.css">
</head>
<body class="bg-light">
<?php include '../../component/user/navbar.php'; ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 p-0 border-end min-vh-100 bg-dark">
            <?php include '../../component/user/sidebaradmin.php'; ?>
        </div>
        <div class="col-md-10 p-4">
            <div class="d-flex justify-content-between mb-3">
                <h4 class="fw-bold">Data Management User</h4>
                <a href="create.php" class="btn btn-primary">+ Tambah User</a>
            </div>
            <div class="card border-0 shadow-sm">
                <div class="card-body p-0">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Nama User</th>
                                <th>Username</th>
                                <th>Role</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($userList as $i => $u): ?>
                                <tr>
                                    <td><?= $i + 1; ?></td>
                                    <td><?= htmlspecialchars($u['namauser']); ?></td>
                                    <td><?= htmlspecialchars($u['username']); ?></td>
                                    <td><span class="badge bg-<?= $u['role'] == 'admin' ? 'danger' : 'info'; ?>"><?= strtoupper($u['role']); ?></span></td>
                                    <td>
                                        <a href="edit.php?id=<?= $u['iduser']; ?>" class="btn btn-sm btn-warning">Edit</a>
                                        <a href="../../../proses/prosesuser.php?aksi=hapus&id=<?= $u['iduser']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus user ini?')">Hapus</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>