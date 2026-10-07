<?php
session_start();
require_once '../../../proses/session.php';

$idpengajuan = $_GET['idpengajuan'] ?? null;
$stmtPengajuan = $pdo->query("SELECT p.idpengajuan, s.namasiswa, k.namakasus 
                             FROM pengajuan p
                             JOIN siswa s ON p.idsiswa = s.idsiswa
                             JOIN kasus k ON p.idkasus = k.idkasus
                             WHERE p.status != 'selesai'");
$listPengajuan = $stmtPengajuan->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Input Penanganan</title>
    <link rel="stylesheet" href="../../../assets/css/bootstrap.min.css">
</head>
<body class="bg-light">
<?php include '../../component/user/navbar.php'; ?>

<div class="container my-4 col-md-6">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-primary text-white fw-bold">Proses / Tangani Laporan</div>
        <div class="card-body">
            <form action="../../../proses/prosespenanganan.php?aksi=tambah" method="POST">
                <div class="mb-3">
                    <label class="form-label">Laporan Kasus</label>
                    <select name="idpengajuan" class="form-select" required>
                        <option value="">-- Pilih Kasus Siswa --</option>
                        <?php foreach ($listPengajuan as $p): ?>
                            <option value="<?= $p['idpengajuan']; ?>" <?= $p['idpengajuan'] == $idpengajuan ? 'selected' : ''; ?>>
                                <?= htmlspecialchars($p['namasiswa']); ?> - <?= htmlspecialchars($p['namakasus']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tanggal Penanganan</label>
                    <input type="date" name="tglpenanganan" class="form-control" value="<?= date('Y-m-d'); ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tindakan / Solusi BK</label>
                    <input type="text" name="tindakan" class="form-control" placeholder="Contoh: Pemanggilan Orang Tua / Konseling" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Hasil / Catatan Penanganan</label>
                    <textarea name="keterangan" class="form-control" rows="3" required></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Update Status Laporan</label>
                    <select name="status" class="form-select">
                        <option value="diproses">Sedang Diproses</option>
                        <option value="selesai" selected>Selesai</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-success w-100">Simpan Penanganan</button>
                <a href="index.php" class="btn btn-secondary w-100 mt-2">Batal</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>