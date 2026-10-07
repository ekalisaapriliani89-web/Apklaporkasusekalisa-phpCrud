<?php
session_start();
require_once '../../../proses/session.php';
checkAdminOnly();

$iduser = $_GET['id'] ?? null;
$stmt = $pdo->prepare("SELECT * FROM user WHERE iduser = :id");
$stmt->execute(['id' => $iduser]);
$user = $stmt->fetch();

if (!$user) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
    <link rel="stylesheet" href="../../../assets/css/bootstrap.min.css">
</head>
<body class="bg-light">
<?php include '../../component/user/navbar.php'; ?>

<div class="container my-4 col-md-6">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-warning text-white fw-bold">Edit Data User</div>
        <div class="card-body">
            <form action="../../../proses/prosesuser.php?aksi=edit" method="POST">
                <input type="hidden" name="iduser" value="<?= $user['iduser']; ?>">
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" value="<?= htmlspecialchars($user['username']); ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($user['nama']); ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password Baru <small class="text-muted">(Kosongkan jika tidak diubah)</small></label>
                    <input type="password" name="password" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Role / Level</label>
                    <select name="level" class="form-select" required>
                        <option value="admin" <?= $user['level'] === 'admin' ? 'selected' : ''; ?>>Admin</option>
                        <option value="petugas" <?= $user['level'] === 'petugas' ? 'selected' : ''; ?>>Petugas / Guru BK</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-warning text-white w-100">Update User</button>
                <a href="index.php" class="btn btn-secondary w-100 mt-2">Batal</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>