<?php
session_start();
require_once '../../../proses/session.php';
checkSiswaOnly();

$kasusList = $pdo->query("SELECT * FROM kasus ORDER BY namakasus ASC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Buat Pengajuan Laporan</title>
    <link rel="stylesheet" href="../../../assets/css/bootstrap.min.css">
</head>
<body class="bg-light">
<?php include '../../component/siswa/navbar.php'; ?>

<div class="container my-5 col-md-7">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-primary text-white fw-bold">Form Input Pengajuan Kasus</div>
        <div class="card-body">
            <form action="../../../proses/prosespengajuan.php?aksi=tambah" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label">Pilih Jenis Kasus</label>
                    <select name="idkasus" class="form-select" required>
                        <option value="">-- Pilih Jenis Pelanggaran/Kasus --</option>
                        <?php foreach ($kasusList as $k): ?>
                            <option value="<?= $k['idkasus']; ?>"><?= htmlspecialchars($k['namakasus']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tanggal Kejadian</label>
                    <input type="date" name="tglpengajuan" class="form-control" value="<?= date('Y-m-d'); ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Keterangan / Kronologi Kejadian</label>
                    <textarea name="keterangan" class="form-control" rows="4" placeholder="Jelaskan detail waktu, lokasi, dan kronologi..." required></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Bukti Foto / Lampiran (Opsional)</label>
                    <input type="file" name="foto" class="form-control" accept="image/*">
                </div>
                <button type="submit" class="btn btn-success w-100 fw-bold">Kirim Laporan Kasus</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>