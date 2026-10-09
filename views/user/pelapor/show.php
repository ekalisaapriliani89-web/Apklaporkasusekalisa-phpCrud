<?php
/*
|--------------------------------------------------------------------------
| DETAIL SISWA / PELAPOR - APLIKASI LAPOR KASUS SEKALISA
|--------------------------------------------------------------------------
*/

/** @var mysqli $koneksi */

$idsiswa = isset($_GET['id']) ? (int) $_GET['id'] : 0;

// Query detail data siswa
$qSiswa = mysqli_query($koneksi, "SELECT * FROM siswa WHERE idsiswa = '$idsiswa' LIMIT 1");
$siswa  = mysqli_fetch_assoc($qSiswa);

if (!$siswa) {
    echo "<script>alert('Data siswa tidak ditemukan!'); window.location='index.php?halaman=pelapor';</script>";
    exit;
}

// Query daftar pengajuan laporan yang diajukan oleh siswa ini
$qPengajuan = mysqli_query($koneksi, "SELECT p.*, k.namakasus, kt.namakategori 
                                      FROM pengajuan p 
                                      LEFT JOIN kasus k ON p.idkasus = k.idkasus 
                                      LEFT JOIN kategori kt ON k.idkategori = kt.idkategori 
                                      WHERE p.idsiswa = '$idsiswa' 
                                      ORDER BY p.idpengajuan DESC");
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 font-weight-bold">
                    <i class="fas fa-id-card text-info mr-2"></i>Detail Siswa Pelapor
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php?halaman=dashboardadmin">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="index.php?halaman=pelapor">Siswa Pelapor</a></li>
                    <li class="breadcrumb-item active">Detail Siswa</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">

        <div class="row">
            <!-- SISI KIRI: CARD PROFIL SISWA -->
            <div class="col-md-4">
                <div class="card border-0 shadow-sm text-center">
                    <div class="card-body">
                        <?php $foto = !empty($siswa['foto']) ? $siswa['foto'] : 'default.png'; ?>
                        <img src="assets/images/siswa/<?= $foto; ?>" 
                             alt="Foto Siswa" 
                             class="img-circle elevation-2 mb-3" 
                             style="width: 120px; height: 120px; object-fit: cover;"
                             onerror="this.src='assets/images/siswa/default.png';">
                        
                        <h4 class="font-weight-bold text-dark mb-1">
                            <?= htmlspecialchars($siswa['namasiswa']); ?>
                        </h4>
                        <p class="text-muted mb-2">
                            NISN: <strong><?= htmlspecialchars($siswa['nisn'] ?? $siswa['nis'] ?? '-'); ?></strong>
                        </p>
                        <span class="badge badge-primary px-3 py-1">
                            Kelas <?= htmlspecialchars(($siswa['kelas'] ?? '') . ' ' . ($siswa['jurusan'] ?? '')); ?>
                        </span>
                    </div>
                    <div class="card-footer bg-light">
                        <a href="index.php?halaman=pelapor" class="btn btn-secondary btn-block">
                            <i class="fas fa-arrow-left mr-1"></i> Kembali ke Daftar
                        </a>
                    </div>
                </div>
            </div>

            <!-- SISI KANAN: TABEL KETERANGAN & RIWAYAT LAPORAN -->
            <div class="col-md-8">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <h3 class="card-title font-weight-bold text-dark m-0">
                            <i class="fas fa-info-circle mr-1"></i> Identitas Lengkap
                        </h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless">
                            <tr>
                                <th width="30%">Username</th>
                                <td>: <?= htmlspecialchars($siswa['username'] ?? '-'); ?></td>
                            </tr>
                            <tr>
                                <th>Nomor HP / WA</th>
                                <td>: <?= htmlspecialchars($siswa['nohp'] ?? '-'); ?></td>
                            </tr>
                            <tr>
                                <th>Alamat Rumah</th>
                                <td>: <?= htmlspecialchars($siswa['alamat'] ?? '-'); ?></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <!-- RIWAYAT PENGAJUAN -->
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-light py-3">
                        <h4 class="card-title font-weight-bold text-dark m-0">
                            <i class="fas fa-history text-warning mr-1"></i> Riwayat Pengajuan Laporan
                        </h4>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th width="5%" class="text-center">No</th>
                                        <th>Tanggal Kejadian</th>
                                        <th>Jenis Kasus</th>
                                        <th width="15%" class="text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($qPengajuan && mysqli_num_rows($qPengajuan) > 0): ?>
                                        <?php $no = 1; while ($row = mysqli_fetch_assoc($qPengajuan)): ?>
                                            <tr>
                                                <td class="text-center font-weight-bold"><?= $no++; ?></td>
                                                <td><?= date('d/m/Y', strtotime($row['tanggalkejadian'] ?? 'now')); ?></td>
                                                <td><?= htmlspecialchars($row['namakasus'] ?? 'Umum'); ?></td>
                                                <td class="text-center">
                                                    <span class="badge badge-info"><?= htmlspecialchars($row['status'] ?? 'Pending'); ?></span>
                                                </td>
                                            </tr>
                                        <?php endwhile; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="4" class="text-center py-4 text-muted">
                                                Siswa ini belum pernah mengajukan laporan kasus.
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>