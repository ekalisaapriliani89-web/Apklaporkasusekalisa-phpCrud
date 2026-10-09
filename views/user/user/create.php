<?php
/*
|--------------------------------------------------------------------------
| DAFTAR USER SISTEM - APLIKASI LAPOR KASUS SEKALISA
|--------------------------------------------------------------------------
*/

/** @var mysqli $koneksi */

$query  = "SELECT * FROM user ORDER BY iduser DESC";
$result = mysqli_query($koneksi, $query);
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 font-weight-bold">
                    <i class="fas fa-users-cog text-secondary mr-2"></i>Data User Sistem
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php?halaman=dashboardadmin">Dashboard</a></li>
                    <li class="breadcrumb-item active">User Sistem</li>
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
                    <i class="fas fa-user-shield mr-1"></i> Pengelola Sistem (Admin / Petugas BK)
                </h3>
                <a href="index.php?halaman=createuser" class="btn btn-secondary btn-sm float-right">
                    <i class="fas fa-user-plus mr-1"></i> Tambah User
                </a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th width="5%" class="text-center">No</th>
                                <th width="8%">Foto</th>
                                <th>Nama Lengkap</th>
                                <th>Username</th>
                                <th>Role Hak Akses</th>
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
                                            <img src="assets/images/user/<?= $foto; ?>" class="img-circle elevation-1" style="width: 40px; height: 40px; object-fit: cover;" onerror="this.src='assets/images/user/default.png';">
                                        </td>
                                        <td class="font-weight-bold text-dark align-middle"><?= htmlspecialchars($row['namauser']); ?></td>
                                        <td class="align-middle"><?= htmlspecialchars($row['username']); ?></td>
                                        <td class="align-middle">
                                            <?php 
                                            $role = strtolower($row['role'] ?? 'petugas');
                                            if ($role == 'admin') {
                                                echo '<span class="badge badge-danger px-3 py-1">ADMINISTRATOR</span>';
                                            } else {
                                                echo '<span class="badge badge-success px-3 py-1">PETUGAS BK</span>';
                                            }
                                            ?>
                                        </td>
                                        <td class="text-center align-middle">
                                            <a href="index.php?halaman=showuser&id=<?= $row['iduser']; ?>" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                            <a href="index.php?halaman=edituser&id=<?= $row['iduser']; ?>" class="btn btn-warning btn-sm text-white"><i class="fas fa-edit"></i></a>
                                            <a href="proses/user/hapus.php?id=<?= $row['iduser']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?');"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr><td colspan="6" class="text-center py-5 text-muted">Belum ada user sistem yang ditambahkan.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>