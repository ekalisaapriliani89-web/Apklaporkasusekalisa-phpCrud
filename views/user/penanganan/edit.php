<?php
/*
|--------------------------------------------------------------------------
| FORM TAMBAH PENANGANAN KASUS - APLIKASI LAPOR KASUS SEKALISA
|--------------------------------------------------------------------------
*/

/** @var mysqli $koneksi */

// Parameter opsional jika diakses dari detail pengajuan
$idpengajuan_param = isset($_GET['idpengajuan']) ? (int)$_GET['idpengajuan'] : 0;

// Query pengajuan laporan yang belum ditangani atau dalam proses
$qPengajuan = mysqli_query($koneksi, "SELECT p.*, s.namasiswa, s.kelas, k.namakasus 
                                      FROM pengajuan p 
                                      LEFT JOIN siswa s ON p.idsiswa = s.idsiswa 
                                      LEFT JOIN kasus k ON p.idkasus = k.idkasus 
                                      ORDER BY p.idpengajuan DESC");

// Query master sanksi
$qSanksi = mysqli_query($koneksi, "SELECT * FROM sanksi ORDER BY namasanksi ASC");
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 font-weight-bold">
                    <i class="fas fa-plus-circle text-warning mr-2"></i>Tambah Penanganan Kasus
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php?halaman=dashboardadmin">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="index.php?halaman=penanganan">Penanganan Kasus</a></li>
                    <li class="breadcrumb-item active">Tambah Penanganan</li>
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
                    <i class="fas fa-edit mr-1"></i> Form Input Tindak Lanjut Penanganan
                </h3>
            </div>

            <form action="proses/penanganan/simpan.php" method="POST">
                <div class="card-body">

                    <!-- PILIH PENGAJUAN LAPORAN -->
                    <div class="form-group">
                        <label for="idpengajuan" class="font-weight-bold">
                            Pilih Pengajuan Laporan Siswa <span class="text-danger">*</span>
                        </label>
                        <select name="idpengajuan" id="idpengajuan" class="form-control" required>
                            <option value="">-- Pilih Laporan Pengajuan --</option>
                            <?php while ($p = mysqli_fetch_assoc($qPengajuan)): ?>
                                <option value="<?= $p['idpengajuan']; ?>" <?= ($idpengajuan_param == $p['idpengajuan']) ? 'selected' : ''; ?>>
                                    [LAP-<?= str_pad($p['idpengajuan'], 5, '0', STR_PAD_LEFT); ?>] <?= htmlspecialchars($p['namasiswa']); ?> (<?= htmlspecialchars($p['kelas']); ?>) - <?= htmlspecialchars($p['namakasus']); ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="row">
                        <!-- TANGGAL PENANGANAN -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tanggalpenanganan" class="font-weight-bold">
                                    Tanggal Penanganan <span class="text-danger">*</span>
                                </label>
                                <input type="date" name="tanggalpenanganan" id="tanggalpenanganan" class="form-control" value="<?= date('Y-m-d'); ?>" required>
                            </div>
                        </div>

                        <!-- PILIH SANKSI -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="idsanksi" class="font-weight-bold">
                                    Sanksi / Tindakan Teguran <span class="text-danger">*</span>
                                </label>
                                <select name="idsanksi" id="idsanksi" class="form-control" required>
                                    <option value="">-- Pilih Sanksi --</option>
                                    <?php while ($s = mysqli_fetch_assoc($qSanksi)): ?>
                                        <option value="<?= $s['idsanksi']; ?>">
                                            <?= htmlspecialchars($s['namasanksi']); ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- CATATAN / PENJELASAN PENANGANAN -->
                    <div class="form-group">
                        <label for="keterangan" class="font-weight-bold">
                            Keterangan / Bimbingan Konseling yang Diberikan <span class="text-danger">*</span>
                        </label>
                        <textarea name="keterangan" id="keterangan" rows="4" class="form-control" placeholder="Rincian hasil pemanggilan siswa, proses mediasi, atau instruksi sanksi..." required></textarea>
                    </div>

                    <!-- UPDATE STATUS PENGAJUAN -->
                    <div class="form-group">
                        <label for="status" class="font-weight-bold">
                            Update Status Laporan Pengajuan <span class="text-danger">*</span>
                        </label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="Diproses">Diproses / Dalam Bimbingan</option>
                            <option value="Selesai" selected>Selesai Ditangani</option>
                            <option value="Ditolak">Ditolak / Tidak Terbukti</option>
                        </select>
                    </div>

                </div>

                <div class="card-footer bg-light text-right">
                    <a href="index.php?halaman=penanganan" class="btn btn-secondary mr-2">
                        <i class="fas fa-arrow-left mr-1"></i> Batal
                    </a>
                    <button type="submit" name="submit" class="btn btn-warning text-white">
                        <i class="fas fa-save mr-1"></i> Simpan Penanganan
                    </button>
                </div>
            </form>
        </div>

    </div>
</section>