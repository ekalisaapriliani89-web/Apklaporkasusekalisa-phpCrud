<?php
/*
|--------------------------------------------------------------------------
| DAFTAR PENANGANAN KASUS - APLIKASI LAPOR KASUS SEKALISA
|--------------------------------------------------------------------------
*/

/** @var mysqli $koneksi */

// Query daftar penanganan kasus JOIN pengajuan, siswa, kasus, sanksi, dan user (petugas)
$query = "SELECT 
            pn.*, 
            p.tanggalkejadian, 
            p.status AS status_pengajuan,
            s.namasiswa, 
            s.kelas,
            k.namakasus, 
            sn.namasanksi, 
            u.namauser
          FROM penanganan pn
          LEFT JOIN pengajuan p ON pn.idpengajuan = p.idpengajuan
          LEFT JOIN siswa s ON p.idsiswa = s.idsiswa
          LEFT JOIN kasus k ON p.idkasus = k.idkasus
          LEFT JOIN sanksi sn ON pn.idsanksi = sn.idsanksi
          LEFT JOIN user u ON pn.iduser = u.iduser
          ORDER BY pn.idpenanganan DESC";

$result = mysqli_query($koneksi, $query);
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 font-weight-bold">
                    <i class="fas fa-tasks text-warning mr-2"></i>Data Penanganan Kasus
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php?halaman=dashboardadmin">Dashboard</a></li>
                    <li class="breadcrumb-item active">Penanganan Kasus</li>
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
                    <i class="fas fa-list mr-1"></i> Daftar Tindak Lanjut Penanganan Kasus
                </h3>
                <a href="index.php?halaman=createpenanganan" class="btn btn-warning btn-sm text-white float-right">
                    <i class="fas fa-plus-circle mr-1"></i> Input Penanganan Baru
                </a>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th width="5%" class="text-center">No</th>
                                <th width="12%">Tgl Penanganan</th>
                                <th>Siswa Pelapor</th>
                                <th>Jenis Kasus</th>
                                <th>Tindakan / Sanksi</th>
                                <th>Petugas BK</th>
                                <th width="15%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($result && mysqli_num_rows($result) > 0): ?>
                                <?php $no = 1; while ($row = mysqli_fetch_assoc($result)): ?>
                                    <tr>
                                        <td class="text-center font-weight-bold align-middle"><?= $no++; ?></td>
                                        <td class="align-middle">
                                            <?= date('d/m/Y', strtotime($row['tanggalpenanganan'] ?? $row['created_at'] ?? 'now')); ?>
                                        </td>
                                        <td class="align-middle">
                                            <strong><?= htmlspecialchars($row['namasiswa'] ?? 'Siswa'); ?></strong><br>
                                            <small class="text-muted">Kelas: <?= htmlspecialchars($row['kelas'] ?? '-'); ?></small>
                                        </td>
                                        <td class="font-weight-bold text-dark align-middle">
                                            <?= htmlspecialchars($row['namakasus'] ?? 'Kasus Umum'); ?>
                                        </td>
                                        <td class="align-middle">
                                            <span class="badge badge-danger">
                                                <?= htmlspecialchars($row['namasanksi'] ?? 'Peringatan'); ?>
                                            </span>
                                        </td>
                                        <td class="align-middle text-muted">
                                            <i class="fas fa-user-shield mr-1"></i><?= htmlspecialchars($row['namauser'] ?? 'Petugas BK'); ?>
                                        </td>
                                        <td class="text-center align-middle">
                                            <a href="index.php?halaman=showpenanganan&id=<?= $row['idpenanganan']; ?>" class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="index.php?halaman=editpenanganan&id=<?= $row['idpenanganan']; ?>" class="btn btn-warning btn-sm text-white">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="proses/penanganan/hapus.php?id=<?= $row['idpenanganan']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus catatan penanganan ini?');">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center py-5 text-muted">
                                        <i class="fas fa-folder-open fa-3x mb-3 d-block"></i>
                                        Belum ada data penanganan kasus yang dicatat.
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