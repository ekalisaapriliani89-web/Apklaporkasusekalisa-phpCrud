<?php
/*
|--------------------------------------------------------------------------
| DAFTAR MASTER KASUS - APLIKASI LAPOR KASUS SEKALISA
|--------------------------------------------------------------------------
*/

/** @var mysqli $koneksi */

// Query mengambil seluruh data kasus beserta nama kategorinya
$query = "SELECT kasus.*, kategori.namakategori 
          FROM kasus 
          LEFT JOIN kategori ON kasus.idkategori = kategori.idkategori 
          ORDER BY kasus.idkasus DESC";

$result = mysqli_query($koneksi, $query);
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 font-weight-bold">
                    <i class="fas fa-exclamation-triangle text-danger mr-2"></i>Data Master Kasus
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php?halaman=dashboardadmin">Dashboard</a></li>
                    <li class="breadcrumb-item active">Master Kasus</li>
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
                    <i class="fas fa-list mr-1"></i> Daftar Jenis Kasus & Pelanggaran
                </h3>
                <a href="index.php?halaman=createkasus" class="btn btn-primary btn-sm float-right">
                    <i class="fas fa-plus-circle mr-1"></i> Tambah Kasus Baru
                </a>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th width="5%" class="text-center">No</th>
                                <th width="10%">Foto</th>
                                <th>Nama Kasus</th>
                                <th>Kategori</th>
                                <th width="15%">Tingkat Bahaya</th>
                                <th width="20%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($result && mysqli_num_rows($result) > 0): ?>
                                <?php $no = 1; while ($row = mysqli_fetch_assoc($result)): ?>
                                    <tr>
                                        <td class="text-center font-weight-bold align-middle"><?= $no++; ?></td>
                                        <td class="align-middle">
                                            <?php $foto = !empty($row['foto']) ? $row['foto'] : 'default.png'; ?>
                                            <img src="assets/images/kasus/<?= $foto; ?>" 
                                                 alt="Foto Kasus" 
                                                 class="img-thumbnail" 
                                                 style="width: 50px; height: 50px; object-fit: cover;"
                                                 onerror="this.src='assets/images/kasus/default.png';">
                                        </td>
                                        <td class="font-weight-bold text-dark align-middle">
                                            <?= htmlspecialchars($row['namakasus']); ?>
                                        </td>
                                        <td class="align-middle">
                                            <span class="badge badge-info">
                                                <?= htmlspecialchars($row['namakategori'] ?? 'Umum'); ?>
                                            </span>
                                        </td>
                                        <td class="align-middle">
                                            <?php 
                                            $bahaya = strtolower($row['tingkatbahaya'] ?? 'sedang');
                                            if ($bahaya == 'berat' || $bahaya == 'tinggi') {
                                                echo '<span class="badge badge-danger px-2 py-1">Berat</span>';
                                            } elseif ($bahaya == 'sedang') {
                                                echo '<span class="badge badge-warning text-white px-2 py-1">Sedang</span>';
                                            } else {
                                                echo '<span class="badge badge-success px-2 py-1">Ringan</span>';
                                            }
                                            ?>
                                        </td>
                                        <td class="text-center align-middle">
                                            <a href="index.php?halaman=showkasus&id=<?= $row['idkasus']; ?>" class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="index.php?halaman=editkasus&id=<?= $row['idkasus']; ?>" class="btn btn-warning btn-sm text-white">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="proses/kasus/hapus.php?id=<?= $row['idkasus']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data kasus ini?');">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center py-5 text-muted">
                                        <i class="fas fa-folder-open fa-3x mb-3 d-block"></i>
                                        Belum ada data master kasus yang ditambahkan.
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