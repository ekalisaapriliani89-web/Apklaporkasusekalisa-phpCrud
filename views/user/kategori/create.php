=<?php
/*
|--------------------------------------------------------------------------
| DAFTAR KATEGORI KASUS - APLIKASI LAPOR KASUS SEKALISA
|--------------------------------------------------------------------------
*/

/** @var mysqli $koneksi */

// Query mengambil data kategori beserta jumlah kasus di dalamnya
$query = "SELECT 
            kategori.*, 
            COUNT(kasus.idkasus) AS total_kasus
          FROM kategori
          LEFT JOIN kasus ON kategori.idkategori = kasus.idkategori
          GROUP BY kategori.idkategori
          ORDER BY kategori.idkategori DESC";

$result = mysqli_query($koneksi, $query);
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 font-weight-bold">
                    <i class="fas fa-tags text-primary mr-2"></i>Data Kategori Kasus
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php?halaman=dashboardadmin">Dashboard</a></li>
                    <li class="breadcrumb-item active">Kategori Kasus</li>
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
                    <i class="fas fa-list mr-1"></i> Daftar Kategori Kasus
                </h3>
                <a href="index.php?halaman=createkategori" class="btn btn-primary btn-sm float-right">
                    <i class="fas fa-plus-circle mr-1"></i> Tambah Kategori
                </a>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th width="5%" class="text-center">No</th>
                                <th>Nama Kategori</th>
                                <th>Keterangan</th>
                                <th width="15%" class="text-center">Total Kasus</th>
                                <th width="20%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($result && mysqli_num_rows($result) > 0): ?>
                                <?php $no = 1; while ($row = mysqli_fetch_assoc($result)): ?>
                                    <tr>
                                        <td class="text-center font-weight-bold align-middle"><?= $no++; ?></td>
                                        <td class="font-weight-bold text-dark align-middle">
                                            <?= htmlspecialchars($row['namakategori']); ?>
                                        </td>
                                        <td class="align-middle text-muted">
                                            <?= htmlspecialchars(!empty($row['keterangan']) ? $row['keterangan'] : '-'); ?>
                                        </td>
                                        <td class="text-center align-middle">
                                            <span class="badge badge-info px-3 py-1 font-weight-bold">
                                                <?= number_format($row['total_kasus'], 0, ',', '.'); ?> Jenis Kasus
                                            </span>
                                        </td>
                                        <td class="text-center align-middle">
                                            <a href="index.php?halaman=showkategori&id=<?= $row['idkategori']; ?>" class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="index.php?halaman=editkategori&id=<?= $row['idkategori']; ?>" class="btn btn-warning btn-sm text-white">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="proses/kategori/hapus.php?id=<?= $row['idkategori']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Menghapus kategori ini dapat memengaruhi data kasus terkait. Yakin ingin menghapus?');">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="text-center py-5 text-muted">
                                        <i class="fas fa-folder-open fa-3x mb-3 d-block"></i>
                                        Belum ada data kategori kasus yang ditambahkan.
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