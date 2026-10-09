<?php
/*
|--------------------------------------------------------------------------
| DETAIL MASTER SANKSI - APLIKASI LAPOR KASUS SEKALISA
|--------------------------------------------------------------------------
*/

/** @var mysqli $koneksi */

$idsanksi = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$qSanksi  = mysqli_query($koneksi, "SELECT * FROM sanksi WHERE idsanksi = '$idsanksi' LIMIT 1");
$sanksi   = mysqli_fetch_assoc($qSanksi);

if (!$sanksi) {
    echo "<script>alert('Data sanksi tidak ditemukan!'); window.location='index.php?halaman=sanksi';</script>";
    exit;
}

$qPenanganan = mysqli_query($koneksi, "SELECT pn.*, s.namasiswa, k.namakasus 
                                       FROM penanganan pn 
                                       LEFT JOIN pengajuan p ON pn.idpengajuan = p.idpengajuan 
                                       LEFT JOIN siswa s ON p.idsiswa = s.idsiswa 
                                       LEFT JOIN kasus k ON p.idkasus = k.idkasus 
                                       WHERE pn.idsanksi = '$idsanksi' 
                                       ORDER BY pn.idpenanganan DESC");
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 font-weight-bold">
                    <i class="fas fa-info-circle text-info mr-2"></i>Detail Master Sanksi
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php?halaman=dashboardadmin">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="index.php?halaman=sanksi">Master Sanksi</a></li>
                    <li class="breadcrumb-item active">Detail Sanksi</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between">
                <h3 class="card-title font-weight-bold text-dark m-0">
                    <i class="fas fa-gavel text-danger mr-1"></i> Sanksi: <?= htmlspecialchars($sanksi['namasanksi']); ?>
                </h3>
                <div>
                    <a href="index.php?halaman=sanksi" class="btn btn-secondary btn-sm mr-1">
                        <i class="fas fa-arrow-left mr-1"></i> Kembali
                    </a>
                    <a href="index.php?halaman=editsanksi&id=<?= $sanksi['idsanksi']; ?>" class="btn btn-warning btn-sm text-white">
                        <i class="fas fa-edit mr-1"></i> Edit Sanksi
                    </a>
                </div>
            </div>
            <div class="card-body">
                <p class="mb-0 text-muted">
                    <strong>Tingkat:</strong> <span class="badge badge-warning text-white"><?= htmlspecialchars($sanksi['tingkat'] ?? 'Sedang'); ?></span><br>
                    <strong>Keterangan:</strong> <?= !empty($sanksi['keterangan']) ? nl2br(htmlspecialchars($sanksi['keterangan'])) : '-'; ?>
                </p>
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-header bg-light py-3">
                <h4 class="card-title font-weight-bold text-dark m-0">
                    <i class="fas fa-history text-warning mr-1"></i> Riwayat Penggunaan Sanksi Ini
                </h4>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th width="5%" class="text-center">No</th>
                                <th>Tanggal Penanganan</th>
                                <th>Siswa</th>
                                <th>Kasus</th>
                                <th width="15%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($qPenanganan && mysqli_num_rows($qPenanganan) > 0): ?>
                                <?php $no = 1; while ($row = mysqli_fetch_assoc($qPenanganan)): ?>
                                    <tr>
                                        <td class="text-center font-weight-bold"><?= $no++; ?></td>
                                        <td><?= date('d/m/Y', strtotime($row['tanggalpenanganan'] ?? 'now')); ?></td>
                                        <td><?= htmlspecialchars($row['namasiswa'] ?? '-'); ?></td>
                                        <td><?= htmlspecialchars($row['namakasus'] ?? '-'); ?></td>
                                        <td class="text-center">
                                            <a href="index.php?halaman=showpenanganan&id=<?= $row['idpenanganan']; ?>" class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i> Detail
                                            </a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">
                                        Sanksi ini belum pernah diberikan dalam penanganan kasus.
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