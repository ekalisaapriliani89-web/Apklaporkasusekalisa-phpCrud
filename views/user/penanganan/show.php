<?php
/*
|--------------------------------------------------------------------------
| FORM EDIT PENANGANAN KASUS - APLIKASI LAPOR KASUS SEKALISA
|--------------------------------------------------------------------------
*/

/** @var mysqli $koneksi */

$idpenanganan = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Query detail penanganan
$qPenanganan = mysqli_query($koneksi, "SELECT pn.*, p.status AS status_laporan 
                                       FROM penanganan pn 
                                       LEFT JOIN pengajuan p ON pn.idpengajuan = p.idpengajuan 
                                       WHERE pn.idpenanganan = '$idpenanganan' 
                                       LIMIT 1");
$penanganan  = mysqli_fetch_assoc($qPenanganan);

if (!$penanganan) {
    echo "<script>alert('Data penanganan tidak ditemukan!'); window.location='index.php?halaman=penanganan';</script>";
    exit;
}

// Query master sanksi
$qSanksi = mysqli_query($koneksi, "SELECT * FROM sanksi ORDER BY namasanksi ASC");
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 font-weight-bold">
                    <i class="fas fa-edit text-warning mr-2"></i>Edit Penanganan Kasus
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php?halaman=dashboardadmin">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="index.php?halaman=penanganan">Penanganan Kasus</a></li>
                    <li class="breadcrumb-item active">Edit Penanganan</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">

        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <h3 class="card-title font-weight-bold text-dark m-0">
                    <i class="fas fa-pen mr-1"></i> Edit Catatan Penanganan #<?= $penanganan['idpenanganan']; ?>
                </h3>
            </div>

            <form action="proses/penanganan/update.php" method="POST">
                <input type="hidden" name="idpenanganan" value="<?= $penanganan['idpenanganan']; ?>">
                <input type="hidden" name="idpengajuan" value="<?= $penanganan['idpengajuan']; ?>">

                <div class="card-body">

                    <div class="row">
                        <!-- TANGGAL PENANGANAN -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tanggalpenanganan" class="font-weight-bold">Tanggal Penanganan <span class="text-danger">*</span></label>
                                <input type="date" name="tanggalpenanganan" id="tanggalpenanganan" class="form-control" value="<?= $penanganan['tanggalpenanganan']; ?>" required>
                            </div>
                        </div>

                        <!-- PILIH SANKSI -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="idsanksi" class="font-weight-bold">Sanksi / Tindakan Teguran <span class="text-danger">*</span></label>
                                <select name="idsanksi" id="idsanksi" class="form-control" required>
                                    <option value="">-- Pilih Sanksi --</option>
                                    <?php while ($s = mysqli_fetch_assoc($qSanksi)): ?>
                                        <option value="<?= $s['idsanksi']; ?>" <?= ($penanganan['idsanksi'] == $s['idsanksi']) ? 'selected' : ''; ?>>
                                            <?= htmlspecialchars($s['namasanksi']); ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- CATATAN PENANGANAN -->
                    <div class="form-group">
                        <label for="keterangan" class="font-weight-bold">Keterangan / Catatan BK <span class="text-danger">*</span></label>
                        <textarea name="keterangan" id="keterangan" rows="4" class="form-control" required><?= htmlspecialchars($penanganan['keterangan'] ?? ''); ?></textarea>
                    </div>

                    <!-- STATUS LAPORAN -->
                    <div class="form-group">
                        <label for="status" class="font-weight-bold">Status Laporan Pengajuan <span class="text-danger">*</span></label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="Diproses" <?= ($penanganan['status_laporan'] == 'Diproses') ? 'selected' : ''; ?>>Diproses / Dalam Bimbingan</option>
                            <option value="Selesai" <?= ($penanganan['status_laporan'] == 'Selesai') ? 'selected' : ''; ?>>Selesai Ditangani</option>
                            <option value="Ditolak" <?= ($penanganan['status_laporan'] == 'Ditolak') ? 'selected' : ''; ?>>Ditolak / Tidak Terbukti</option>
                        </select>
                    </div>

                </div>

                <div class="card-footer bg-light text-right">
                    <a href="index.php?halaman=penanganan" class="btn btn-secondary mr-2">
                        <i class="fas fa-arrow-left mr-1"></i> Batal
                    </a>
                    <button type="submit" name="submit" class="btn btn-warning text-white">
                        <i class="fas fa-sync-alt mr-1"></i> Update Penanganan
                    </button>
                </div>
            </form>
        </div>

    </div>
</section>