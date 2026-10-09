<?php
/*
|--------------------------------------------------------------------------
| FORM TAMBAH USER SISTEM - APLIKASI LAPOR KASUS SEKALISA
|--------------------------------------------------------------------------
*/

/** @var mysqli $koneksi */
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 font-weight-bold"><i class="fas fa-user-plus text-secondary mr-2"></i>Tambah User Sistem</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php?halaman=dashboardadmin">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="index.php?halaman=user">User Sistem</a></li>
                    <li class="breadcrumb-item active">Tambah User</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <h3 class="card-title font-weight-bold text-dark m-0"><i class="fas fa-edit mr-1"></i> Form Registrasi Petugas / Admin</h3>
            </div>
            <form action="proses/user/simpan.php" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="form-group">
                        <label class="font-weight-bold">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="namauser" class="form-control" placeholder="Nama petugas / admin" required>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Username <span class="text-danger">*</span></label>
                        <input type="text" name="username" class="form-control" placeholder="Username login" required>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Password <span class="text-danger">*</span></label>
                        <input type="password" name="password" class="form-control" placeholder="Password login" required>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Role Hak Akses <span class="text-danger">*</span></label>
                        <select name="role" class="form-control" required>
                            <option value="petugas" selected>Petugas BK</option>
                            <option value="admin">Administrator</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Foto Profil</label>
                        <input type="file" name="foto" class="form-control-file" accept="image/*">
                    </div>
                </div>
                <div class="card-footer bg-light text-right">
                    <a href="index.php?halaman=user" class="btn btn-secondary mr-2"><i class="fas fa-arrow-left mr-1"></i> Batal</a>
                    <button type="submit" name="submit" class="btn btn-secondary"><i class="fas fa-save mr-1"></i> Simpan User</button>
                </div>
            </form>
        </div>
    </div>
</section>