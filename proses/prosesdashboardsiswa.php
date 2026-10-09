<?php
/*
|--------------------------------------------------------------------------
| DASHBOARD SISWA - APLIKASI LAPOR KASUS SEKALISA
|--------------------------------------------------------------------------
| Zona    : User / Siswa
| Layout  : AdminLTE
| Project : Aplikasi Lapor Kasus Sekalisa
|--------------------------------------------------------------------------
*/

/** @var mysqli $koneksi */

// Pastikan sesi siswa terdefinisi
$idsiswa = $_SESSION['idsiswa'] ?? 0;

/*
|--------------------------------------------------------------------------
| STATISTIK LAPORAN PRIBADI SISWA BERDASARKAN SKEMA DATABASE
|--------------------------------------------------------------------------
*/
$totalLaporanSiswa = (int) (mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM pengajuan WHERE idsiswa = '$idsiswa'"))['total'] ?? 0);
$laporanSelesai    = (int) (mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM pengajuan WHERE idsiswa = '$idsiswa' AND (LOWER(status) = 'selesai' OR LOWER(status) = 'disetujui')"))['total'] ?? 0);
$laporanDiproses   = (int) (mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM pengajuan WHERE idsiswa = '$idsiswa' AND (LOWER(status) = 'diproses' OR LOWER(status) = 'ditangani' OR LOWER(status) = 'pending')"))['total'] ?? 0);

/*
|--------------------------------------------------------------------------
| QUERY RIWAYAT PENGADUAN / PENGAJUAN OLEH SISWA
|--------------------------------------------------------------------------
*/
$queryRiwayat = mysqli_query(
    $koneksi,
    "SELECT 
        p.*, 
        k.namakasus, 
        kt.namakategori
     FROM pengajuan p
     LEFT JOIN kasus k ON p.idkasus = k.idkasus
     LEFT JOIN kategori kt ON k.idkategori = kt.idkategori
     WHERE p.idsiswa = '$idsiswa'
     ORDER BY p.idpengajuan DESC
     LIMIT 5"
);
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2 align-items-center">
            <div class="col-sm-8">
                <h1 class="m-0 font-weight-bold">
                    <i class="fas fa-user-graduate mr-2 text-success"></i>
                    Dashboard Siswa Pelapor
                </h1>
                <p class="text-muted mb-0 mt-1">
                    Selamat datang, <strong><?= htmlspecialchars($_SESSION['namasiswa'] ?? 'Siswa'); ?></strong>. 
                    Pantau status laporan kejadian dan pengaduan pelanggaran Anda di sini.
                </p>
            </div>
            <div class="col-sm-4 text-right">
                <small class="text-muted">
                    <i class="far fa-calendar-alt mr-1"></i>
                    <?= function_exists('tanggalIndonesia') ? tanggalIndonesia(date('Y-m-d')) : date('d F Y'); ?>
                </small>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">

        <!-- BANNER SELAMAT DATANG -->
        <div class="card bg-gradient-success shadow-sm mb-4 border-0">
            <div class="card-body p-4 text-white">
                <h3 class="font-weight-bold mb-2">
                    Portal Pengaduan Siswa, <?= htmlspecialchars($_SESSION['namasiswa'] ?? 'Siswa'); ?> 👋
                </h3>
                <p class="mb-3">
                    Sistem ini membantu Anda melaporkan kejadian atau permasalahan secara aman, cepat, dan transparan langsung kepada pihak Guru BK / Petugas sekolah.
                </p>
                <a href="index.php?halaman=createpengajuan" class="btn btn-light btn-sm font-weight-bold text-success">
                    <i class="fas fa-plus-circle mr-1"></i> Buat Laporan Baru
                </a>
            </div>
        </div>

        <!-- STATISTIK KOTAK KECIL -->
        <div class="row">
            <div class="col-lg-4 col-6">
                <div class="small-box bg-primary elevation-2">
                    <div class="inner">
                        <h3><?= number_format($totalLaporanSiswa, 0, ',', '.'); ?></h3>
                        <p>Total Laporan Saya</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <a href="index.php?halaman=pengajuan" class="small-box-footer">
                        Lihat Riwayat <i class="fas fa-arrow-circle-right ml-1"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-4 col-6">
                <div class="small-box bg-warning elevation-2">
                    <div class="inner text-white">
                        <h3 class="text-white"><?= number_format($laporanDiproses, 0, ',', '.'); ?></h3>
                        <p class="text-white">Dalam Proses / Pending</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <a href="index.php?halaman=pengajuan" class="small-box-footer" style="color: #fff !important;">
                        Cek Status <i class="fas fa-arrow-circle-right ml-1"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-4 col-12">
                <div class="small-box bg-success elevation-2">
                    <div class="inner">
                        <h3><?= number_format($laporanSelesai, 0, ',', '.'); ?></h3>
                        <p>Laporan Selesai</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <span class="small-box-footer">Penanganan Tuntas</span>
                </div>
            </div>
        </div>

        <!-- TABEL RIWAYAT LAPORAN SISWA -->
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between">
                <h3 class="card-title font-weight-bold text-dark m-0">
                    <i class="fas fa-history text-success mr-2"></i> Riwayat Pengajuan Laporan Anda
                </h3>
                <a href="index.php?halaman=pengajuan" class="btn btn-sm btn-outline-success">
                    Lihat Semua <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th width="5%" class="text-center">No</th>
                                <th>Tanggal Kejadian</th>
                                <th>Jenis Kasus</th>
                                <th>Kategori</th>
                                <th>Lokasi</th>
                                <th width="15%" class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($queryRiwayat && mysqli_num_rows($queryRiwayat) > 0): ?>
                                <?php $no = 1; while ($row = mysqli_fetch_assoc($queryRiwayat)): ?>
                                    <tr>
                                        <td class="text-center font-weight-bold align-middle"><?= $no++; ?></td>
                                        <td class="align-middle">
                                            <?= date('d/m/Y', strtotime($row['tanggalkejadian'] ?? 'now')); ?>
                                        </td>
                                        <td class="font-weight-bold text-dark align-middle">
                                            <?= htmlspecialchars($row['namakasus'] ?? 'Umum'); ?>
                                        </td>
                                        <td class="align-middle">
                                            <span class="badge badge-info">
                                                <?= htmlspecialchars($row['namakategori'] ?? 'Umum'); ?>
                                            </span>
                                        </td>
                                        <td class="align-middle">
                                            <?= htmlspecialchars($row['lokasi'] ?? '-'); ?>
                                        </td>
                                        <td class="text-center align-middle">
                                            <?php 
                                            $st = strtolower($row['status'] ?? 'pending');
                                            if ($st == 'selesai' || $st == 'disetujui') {
                                                echo '<span class="badge badge-success px-2 py-1">Selesai</span>';
                                            } elseif ($st == 'diproses' || $st == 'ditangani') {
                                                echo '<span class="badge badge-warning text-white px-2 py-1">Diproses</span>';
                                            } elseif ($st == 'ditolak') {
                                                echo '<span class="badge badge-danger px-2 py-1">Ditolak</span>';
                                            } else {
                                                echo '<span class="badge badge-secondary px-2 py-1">Pending</span>';
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center py-5 text-muted">
                                        <i class="fas fa-folder-open fa-3x mb-3 d-block"></i>
                                        Belum ada riwayat pengajuan laporan kasus yang Anda buat.
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