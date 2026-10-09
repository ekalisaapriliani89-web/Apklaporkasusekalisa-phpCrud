<?php
/*
|--------------------------------------------------------------------------
| DAFTAR SISWA - APLIKASI LAPOR KASUS SEKALISA
|--------------------------------------------------------------------------
*/

/** @var mysqli $koneksi */

$query = "SELECT s.*, COUNT(p.idpengajuan) AS total_laporan
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
                    <i class="fas fa-user-graduate text-success mr-2"></i>Data Siswa
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php?halaman=dashboardadmin">Dashboard</a></li>
                    <li class="breadcrumb-item active">Data Siswa</li>
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
                    <i class="fas fa-users mr-1"></i> Master Data Siswa
                </h3>
                <a href="index.php?halaman=createsiswa" class="btn btn-success btn-sm float-right">
                    <i class="fas fa-user-plus mr-1"></i> Tambah Siswa
                </a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th width="5%" class="text-center">No</th>
                                <th width="8%">Foto</th>
                                <th>NISN</th>
                                <th>Nama Lengkap</th>
                                <th>Kelas</th>
                                <th>No. HP</th>
                                <th width="12%" class="text-center">Laporan</th>
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
                                            <img src="assets/images/siswa/<?= $foto; ?>" class="img-circle elevation-1" style="width: 40px; height: 40px; object-fit: cover;" onerror="this.src='assets/images/siswa/default.png';">
                                        </td>
                                        <td class="font-weight-bold text-dark align-middle"><?= htmlspecialchars($row['nisn'] ?? '-'); ?></td>
                                        <td class="font-weight-bold text-dark align-middle"><?= htmlspecialchars($row['namasiswa']); ?></td>
                                        <td class="align-middle"><?= htmlspecialchars(($row['kelas'] ?? '') . ' ' . ($row['jurusan'] ?? '')); ?></td>
                                        <td class="align-middle"><?= htmlspecialchars($row['nohp'] ?? '-'); ?></td>
                                        <td class="text-center align-middle">
                                            <span class="badge badge-info px-3 py-1 font-weight-bold"><?= number_format($row['total_laporan'], 0, ',', '.'); ?></span>
                                        </td>
                                        <td class="text-center align-middle">
                                            <a href="index.php?halaman=showsiswa&id=<?= $row['idsiswa']; ?>" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                            <a href="index.php?halaman=editsiswa&id=<?= $row['idsiswa']; ?>" class="btn btn-warning btn-sm text-white"><i class="fas fa-edit"></i></a>
                                            <a href="proses/siswa/hapus.php?id=<?= $row['idsiswa']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data siswa ini?');"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr><td colspan="8" class="text-center py-5 text-muted">Belum ada data siswa.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>