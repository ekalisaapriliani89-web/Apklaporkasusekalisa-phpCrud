<?php
session_start();
require_once '../../../proses/session.php';
checkAdminOnly();

$idsiswa = $_GET['id'] ?? null;
$stmt = $pdo->prepare("SELECT * FROM siswa WHERE idsiswa = :id");
$stmt->execute(['id' => $idsiswa]);
$siswa = $stmt->fetch();

if (!$siswa) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Siswa</title>
    <link rel="stylesheet" href="../../../assets/css/bootstrap.min.css">
</head>
<body class="bg-light">
<?php include '../../component/user/navbar.php'; ?>

<div class="container my-4 col-md-6">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-warning text-white fw-bold">Edit Data Siswa</div>
        <div class="card-body">
            <form action="../../../proses/prosessiswa.php?aksi=edit" method="POST">
                <input type="hidden" name="idsiswa" value="<?= $siswa['idsiswa']; ?>">
                <div class="mb-3">
                    <label class="form-label">NISN</label>
                    <input type="text" name="nisn" class="form-control" value="<?= htmlspecialchars($siswa['nisn']); ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama Lengkap Siswa</label>
                    <input type="text" name="namasiswa" class="form-control" value="<?= htmlspecialchars($siswa['namasiswa']); ?>" required>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Kelas</label>
                        <input type="text" name="kelas" class="form-control" value="<?= htmlspecialchars($siswa['kelas']); ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Jenis Kelamin</label>
                        <select name="jeniskelamin" class="form-select" required>
                            <option value="L" <?= $siswa['jeniskelamin'] === 'L' ? 'selected' : ''; ?>>Laki-laki</option>
                            <option value="P" <?= $siswa['jeniskelamin'] === 'P' ? 'selected' : ''; ?>>Perempuan</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password Baru <small class="text-muted">(Kosongkan jika tidak diubah)</small></label>
                    <input type="password" name="password" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <textarea name="alamat" class="form-control" rows="3"><?= htmlspecialchars($siswa['alamat'] ?? ''); ?></textarea>
                </div>
                <button type="submit" class="btn btn-warning text-white w-100">Update Data Siswa</button>
                <a href="index.php" class="btn btn-secondary w-100 mt-2">Batal</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>