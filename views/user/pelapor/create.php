<?php
/*
|--------------------------------------------------------------------------
| DAFTAR SISWA / PELAPOR - APLIKASI LAPOR KASUS SEKALISA
|--------------------------------------------------------------------------
*/

/** @var mysqli $koneksi */

// Query mengambil data siswa beserta jumlah pengajuan laporan yang dibuat
$query = "SELECT 
            s.*, 
            COUNT(p.idpengajuan) AS total_laporan
          FROM siswa s
          LEFT JOIN pengajuan p ON s.idsiswa = p.idsiswa
          GROUP BY s.idsiswa
          ORDER BY s.idsiswa DESC";

$result = mysqli_query($koneksi, $query);
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 font-weight-bold">
                    <i class="fas fa-user-graduate text-success mr-2"></i>Data Siswa / Pelapor
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php?halaman=dashboardadmin">Dashboard</a></li>
                    <li class="breadcrumb-item active">Siswa Pelapor</li>
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
                    <i class="fas fa-users mr-1"></i> Daftar Data Siswa Pelapor
                </h3>
                <a href="index.php?halaman=createpelapor" class="btn btn-primary btn-sm float-right">
                    <i class="fas fa-user-plus mr-1"></i> Tambah Siswa Baru
                </a>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th width="5%" class="text-center">No</th>
                                <th width="8%">Foto</th>
                                <th>NISN / NIS</th>
                                <th>Nama Lengkap</th>
                                <th>Kelas & Jurusan</th>
                                <th>No. WhatsApp</th>
                                <th width="12%" class="text-center">Total Lapor</th>
                                <th width="18%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($result && mysqli_num_rows($result) > 0): ?>
                                <?php $no = 1; while ($row = mysqli_fetch_assoc($result)): ?>
                                    <tr>
                                        <td class="text-center font-weight-bold align-middle"><?= $no++; ?></td>
                                        <td class="align-middle">
                                            <?php $foto = !empty($row['foto']) ? $row['foto'] : 'default.png'; ?>
                                            <img src="assets/images/siswa/<?= $foto; ?>" 
                                                 alt="Foto Siswa" 
                                                 class="img-circle elevation-1" 
                                                 style="width: 40px; height: 40px; object-fit: cover;"
                                                 onerror="this.src='assets/images/siswa/default.png';">
                                        </td>
                                        <td class="font-weight-bold text-dark align-middle">
                                            <?= htmlspecialchars($row['nisn'] ?? $row['nis'] ?? '-'); ?>
                                        </td>
                                        <td class="font-weight-bold text-dark align-middle">
                                            <?= htmlspecialchars($row['namasiswa']); ?>
                                        </td>
                                        <td class="align-middle">
                                            <?= htmlspecialchars(($row['kelas'] ?? '') . ' ' . ($row['jurusan'] ?? '')); ?>
                                        </td>
                                        <td class="align-middle">
                                            <?= htmlspecialchars($row['nohp'] ?? '-'); ?>
                                        </td>
                                        <td class="text-center align-middle">
                                            <span class="badge badge-info px-3 py-1 font-weight-bold">
                                                <?= number_format($row['total_laporan'], 0, ',', '.'); ?> Kasus
                                            </span>
                                        </td>
                                        <td class="text-center align-middle">
                                            <a href="index.php?halaman=showpelapor&id=<?= $row['idsiswa']; ?>" class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="index.php?halaman=editpelapor&id=<?= $row['idsiswa']; ?>" class="btn btn-warning btn-sm text-white">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="proses/pelapor/hapus.php?id=<?= $row['idsiswa']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data siswa ini?');">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="8" class="text-center py-5 text-muted">
                                        <i class="fas fa-user-slash fa-3x mb-3 d-block"></i>
                                        Belum ada data siswa / pelapor yang terdaftar.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</section><?php
/*
|--------------------------------------------------------------------------
| DAFTAR SISWA / PELAPOR - APLIKASI LAPOR KASUS SEKALISA
|--------------------------------------------------------------------------
*/

/** @var mysqli $koneksi */

// Query mengambil data siswa beserta jumlah pengajuan laporan yang dibuat
$query = "SELECT 
            s.*, 
            COUNT(p.idpengajuan) AS total_laporan
          FROM siswa s
          LEFT JOIN pengajuan p ON s.idsiswa = p.idsiswa
          GROUP BY s.idsiswa
          ORDER BY s.idsiswa DESC";

$result = mysqli_query($koneksi, $query);
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 font-weight-bold">
                    <i class="fas fa-user-graduate text-success mr-2"></i>Data Siswa / Pelapor
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php?halaman=dashboardadmin">Dashboard</a></li>
                    <li class="breadcrumb-item active">Siswa Pelapor</li>
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
                    <i class="fas fa-users mr-1"></i> Daftar Data Siswa Pelapor
                </h3>
                <a href="index.php?halaman=createpelapor" class="btn btn-primary btn-sm float-right">
                    <i class="fas fa-user-plus mr-1"></i> Tambah Siswa Baru
                </a>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th width="5%" class="text-center">No</th>
                                <th width="8%">Foto</th>
                                <th>NISN / NIS</th>
                                <th>Nama Lengkap</th>
                                <th>Kelas & Jurusan</th>
                                <th>No. WhatsApp</th>
                                <th width="12%" class="text-center">Total Lapor</th>
                                <th width="18%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($result && mysqli_num_rows($result) > 0): ?>
                                <?php $no = 1; while ($row = mysqli_fetch_assoc($result)): ?>
                                    <tr>
                                        <td class="text-center font-weight-bold align-middle"><?= $no++; ?></td>
                                        <td class="align-middle">
                                            <?php $foto = !empty($row['foto']) ? $row['foto'] : 'default.png'; ?>
                                            <img src="assets/images/siswa/<?= $foto; ?>" 
                                                 alt="Foto Siswa" 
                                                 class="img-circle elevation-1" 
                                                 style="width: 40px; height: 40px; object-fit: cover;"
                                                 onerror="this.src='assets/images/siswa/default.png';">
                                        </td>
                                        <td class="font-weight-bold text-dark align-middle">
                                            <?= htmlspecialchars($row['nisn'] ?? $row['nis'] ?? '-'); ?>
                                        </td>
                                        <td class="font-weight-bold text-dark align-middle">
                                            <?= htmlspecialchars($row['namasiswa']); ?>
                                        </td>
                                        <td class="align-middle">
                                            <?= htmlspecialchars(($row['kelas'] ?? '') . ' ' . ($row['jurusan'] ?? '')); ?>
                                        </td>
                                        <td class="align-middle">
                                            <?= htmlspecialchars($row['nohp'] ?? '-'); ?>
                                        </td>
                                        <td class="text-center align-middle">
                                            <span class="badge badge-info px-3 py-1 font-weight-bold">
                                                <?= number_format($row['total_laporan'], 0, ',', '.'); ?> Kasus
                                            </span>
                                        </td>
                                        <td class="text-center align-middle">
                                            <a href="index.php?halaman=showpelapor&id=<?= $row['idsiswa']; ?>" class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="index.php?halaman=editpelapor&id=<?= $row['idsiswa']; ?>" class="btn btn-warning btn-sm text-white">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="proses/pelapor/hapus.php?id=<?= $row['idsiswa']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data siswa ini?');">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="8" class="text-center py-5 text-muted">
                                        <i class="fas fa-user-slash fa-3x mb-3 d-block"></i>
                                        Belum ada data siswa / pelapor yang terdaftar.
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