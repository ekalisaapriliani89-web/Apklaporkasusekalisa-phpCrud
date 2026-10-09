<?php
/*
|--------------------------------------------------------------------------
| LAPORAN HARIAN KASUS - APLIKASI LAPOR KASUS SEKALISA
|--------------------------------------------------------------------------
*/

/** @var mysqli $koneksi */

$tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : date('Y-m-d');

// Query data pengajuan kasus berdasarkan tanggal kejadian / lapor
$query = "SELECT p.*, s.namasiswa, s.nisn, s.kelas, k.namakasus, kt.namakategori
          FROM pengajuan p
          LEFT JOIN siswa s ON p.idsiswa = s.idsiswa
          LEFT JOIN kasus k ON p.idkasus = k.idkasus
          LEFT JOIN kategori kt ON k.idkategori = kt.idkategori
          WHERE DATE(p.tanggalkejadian) = '$tanggal'
          ORDER BY p.idpengajuan DESC";

$result = mysqli_query($koneksi, $query);
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 font-weight-bold">
                    <i class="fas fa-calendar-day text-primary mr-2"></i>Laporan Kasus Harian
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php?halaman=dashboardadmin">Dashboard</a></li>
                    <li class="breadcrumb-item active">Laporan Harian</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">

        <!-- FILTER TANGGAL -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body py-3">
                <form action="index.php" method="GET" class="form-inline">
                    <input type="hidden" name="halaman" value="laporanharian">
                    <label class="mr-2 font-weight-bold">Pilih Tanggal:</label>
                    <input type="date" name="tanggal" value="<?= $tanggal; ?>" class="form-control mr-2" required>
                    <button type="submit" class="btn btn-primary mr-2">
                        <i class="fas fa-filter mr-1"></i> Tampilkan
                    </button>
                    <a href="views/user/laporan/cetaklaporanharian.php?tanggal=<?= $tanggal; ?>" target="_blank" class="btn btn-success">
                        <i class="fas fa-print mr-1"></i> Cetak PDF/Print
                    </a>
                </form>
            </div>
        </div>

        <!-- TABEL HASIL LAPORAN -->
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <h3 class="card-title font-weight-bold text-dark m-0">
                    Rekap Laporan Tanggal: <?= date('d F Y', strtotime($tanggal)); ?>
                </h3>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th width="5%" class="text-center">No</th>
                                <th>NISN & Nama Siswa</th>
                                <th>Kelas</th>
                                <th>Jenis Kasus</th>
                                <th>Lokasi Kejadian</th>
                                <th width="12%" class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($result && mysqli_num_rows($result) > 0): ?>
                                <?php $no = 1; while ($row = mysqli_fetch_assoc($result)): ?>
                                    <tr>
                                        <td class="text-center font-weight-bold"><?= $no++; ?></td>
                                        <td>
                                            <strong><?= htmlspecialchars($row['namasiswa'] ?? 'Siswa'); ?></strong><br>
                                            <small class="text-muted">NISN: <?= htmlspecialchars($row['nisn'] ?? '-'); ?></small>
                                        </td>
                                        <td><?= htmlspecialchars($row['kelas'] ?? '-'); ?></td>
                                        <td>
                                            <span class="font-weight-bold text-dark"><?= htmlspecialchars($row['namakasus'] ?? 'Umum'); ?></span><br>
                                            <small class="badge badge-info"><?= htmlspecialchars($row['namakategori'] ?? 'Umum'); ?></small>
                                        </td>
                                        <td><?= htmlspecialchars($row['lokasi'] ?? '-'); ?></td>
                                        <td class="text-center">
                                            <span class="badge badge-secondary"><?= htmlspecialchars($row['status'] ?? 'Pending'); ?></span>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-muted">
                                        Tidak ada laporan pengajuan kasus pada tanggal ini.
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