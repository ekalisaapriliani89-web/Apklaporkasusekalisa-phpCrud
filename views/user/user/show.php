<?php
/*
|--------------------------------------------------------------------------
| FORM EDIT USER SISTEM - APLIKASI LAPOR KASUS SEKALISA
|--------------------------------------------------------------------------
*/

/** @var mysqli $koneksi */

$iduser = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$qUser  = mysqli_query($koneksi, "SELECT * FROM user WHERE iduser = '$iduser' LIMIT 1");
$user   = mysqli_fetch_assoc($qUser);

if (!$user) {
    echo "<script>alert('Data user tidak ditemukan!'); window.location='index.php?halaman=user';</script>";
    exit;
}
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 font-weight-bold"><i class="fas fa-user-edit text-warning mr-2"></i>Edit User Sistem</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php?halaman=dashboardadmin">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="index.php?halaman=user">User Sistem</a></li>
                    <li class="breadcrumb-item active">Edit User</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <h3 class="card-title font-weight-bold text-dark m-0"><i class="fas fa-pen mr-1"></i> Edit User #<?= $user['iduser']; ?></h3>
            </div>
            <form action="proses/user/update.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="iduser" value="<?= $user['iduser']; ?>">
                <input type="hidden" name="fotolama" value="<?= $user['foto']; ?>">

                <div class="card-body">
                    <div class="form-group">
                        <label class="font-weight-bold">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="namauser" class="form-control" value="<?= htmlspecialchars($user['namauser']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Username <span class="text-danger">*</span></label>
                        <input type="text" name="username" class="form-control" value="<?= htmlspecialchars($user['username']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Password Baru <small class="text-muted">(Kosongkan jika tidak diganti)</small></label>
                        <input type="password" name="password" class="form-control" placeholder="Password baru...">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Role Hak Akses <span class="text-danger">*</span></label>
                        <select name="role" class="form-control" required>
                            <option value="petugas" <?= (strtolower($user['role']) == 'petugas') ? 'selected' : ''; ?>>Petugas BK</option>
                            <option value="admin" <?= (strtolower($user['role']) == 'admin') ? 'selected' : ''; ?>>Administrator</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Ganti Foto Profil</label>
                        <input type="file" name="foto" class="form-control-file" accept="image/*">
                    </div>
                </div>
                <div class="card-footer bg-light text-right">
                    <a href="index.php?halaman=user" class="btn btn-secondary mr-2"><i class="fas fa-arrow-left mr-1"></i> Batal</a>
                    <button type="submit" name="submit" class="btn btn-warning text-white"><i class="fas fa-sync-alt mr-1"></i> Update User</button>
                </div>
            </form>
        </div>
    </div>
</section>