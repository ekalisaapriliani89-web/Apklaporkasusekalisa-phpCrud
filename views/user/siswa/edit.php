<?php
/*
|--------------------------------------------------------------------------
| FORM TAMBAH SISWA - APLIKASI LAPOR KASUS SEKALISA
|--------------------------------------------------------------------------
*/

/** @var mysqli $koneksi */
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 font-weight-bold"><i class="fas fa-user-plus text-success mr-2"></i>Tambah Data Siswa</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php?halaman=dashboardadmin">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="index.php?halaman=siswa">Siswa</a></li>
                    <li class="breadcrumb-item active">Tambah Siswa</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <h3 class="card-title font-weight-bold text-dark m-0"><i class="fas fa-edit mr-1"></i> Form Input Siswa Baru</h3>
            </div>
            <form action="proses/siswa/simpan.php" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">NISN <span class="text-danger">*</span></label>
                                <input type="text" name="nisn" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" name="namasiswa" class="form-control" required>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Kelas <span class="text-danger">*</span></label>
                                        <input type="text" name="kelas" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Jurusan</label>
                                        <input type="text" name="jurusan" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">Username <span class="text-danger">*</span></label>
                                <input type="text" name="username" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Password <span class="text-danger">*</span></label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Nomor HP</label>
                                <input type="text" name="nohp" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Alamat</label>
                        <textarea name="alamat" rows="3" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Foto Profil</label>
                        <input type="file" name="foto" class="form-control-file" accept="image/*">
                    </div>
                </div>
                <div class="card-footer bg-light text-right">
                    <a href="index.php?halaman=siswa" class="btn btn-secondary mr-2"><i class="fas fa-arrow-left mr-1"></i> Batal</a>
                    <button type="submit" name="submit" class="btn btn-success"><i class="fas fa-save mr-1"></i> Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</section>