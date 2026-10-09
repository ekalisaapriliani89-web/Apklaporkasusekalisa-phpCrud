<?php
/*
|--------------------------------------------------------------------------
| DAFTAR PENGAJUAN LAPORAN KASUS (SISWA)
|--------------------------------------------------------------------------
*/

/** @var mysqli $koneksi */

// Pastikan siswa sudah login
if (!isset($_SESSION['idsiswa'])) {
    echo "<script>alert('Silakan login terlebih dahulu!'); window.location='index.php?halaman=loginsiswa';</script>";
    exit;
}

$idsiswa = (int) $_SESSION['idsiswa'];

// Query mengambil seluruh pengajuan laporan milik siswa ini
$query = "SELECT 
            p.*, 
            k.namakasus, 
            kt.namakategori
          FROM pengajuan p
          LEFT JOIN kasus k ON p.idkasus = k.idkasus
          LEFT JOIN kategori kt ON k.idkategori = kt.idkategori
          WHERE p.idsiswa = $idsiswa
          ORDER BY p.idpengajuan DESC";

$result = mysqli_query($koneksi, $query);
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 font-weight-bold">
                    <i class="fas fa-history text-primary mr-2"></i>Status Laporan Saya
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php?halaman=dashboardsiswa">Dashboard</a></li>
                    <li class="breadcrumb-item active">Status Laporan</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">

        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between">
                <h3 class="card-title font-weight-bold text-dark m-0">
                    <i class="fas fa-list mr-1"></i> Riwayat Pengajuan Laporan
                </h3>
                <a href="index.php?halaman=createpengajuan" class="btn btn-primary btn-sm float-right">
                    <i class="fas fa-plus-circle mr-1"></i> Buat Laporan Baru
                </a>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th width="5%" class="text-center">No</th>
                                <th width="15%">Tanggal Lapor</th>
                                <th>Jenis Kasus / Pelanggaran</th>
                                <th>Kategori</th>
                                <th width="15%" class="text-center">Status</th>
                                <th width="12%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($result && mysqli_num_rows($result) > 0): ?>
                                <?php $no = 1; while ($row = mysqli_fetch_assoc($result)): ?>
                                    <tr>
                                        <td class="text-center font-weight-bold"><?= $no++; ?></td>
                                        <td>
                                            <i class="far fa-calendar-alt text-muted mr-1"></i>
                                            <?= date('d/m/Y H:i', strtotime($row['tanggallapor'] ?? $row['created_at'] ?? 'now')); ?>
                                        </td>
                                        <td class="font-weight-bold text-dark">
                                            <?= htmlspecialchars($row['namakasus'] ?? 'Kasus Umum'); ?>
                                        </td>
                                        <td>
                                            <span class="badge badge-info">
                                                <?= htmlspecialchars($row['namakategori'] ?? 'Umum'); ?>
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <?php 
                                            $status = strtolower($row['status'] ?? 'pending');
                                            if ($status == 'selesai' || $status == 'disetujui') {
                                                echo '<span class="badge badge-success px-3 py-1"><i class="fas fa-check-circle mr-1"></i> Selesai</span>';
                                            } elseif ($status == 'diproses' || $status == 'ditangani') {
                                                echo '<span class="badge badge-warning px-3 py-1 text-white"><i class="fas fa-spinner fa-spin mr-1"></i> Diproses</span>';
                                            } elseif ($status == 'ditolak') {
                                                echo '<span class="badge badge-danger px-3 py-1"><i class="fas fa-times-circle mr-1"></i> Ditolak</span>';
                                            } else {
                                                echo '<span class="badge badge-secondary px-3 py-1"><i class="fas fa-clock mr-1"></i> Menunggu Verifikasi</span>';
                                            }
                                            ?>
                                        </td>
                                        <td class="text-center">
                                            <a href="index.php?halaman=detilpengajuan&id=<?= $row['idpengajuan']; ?>" 
                                               class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i> Detail
                                            </a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center py-5 text-muted">
                                        <i class="fas fa-folder-open fa-3x mb-3 d-block"></i>
                                        Belum ada pengajuan laporan yang dibuat.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</section>