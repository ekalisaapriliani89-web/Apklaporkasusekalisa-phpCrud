<?php
/*
|--------------------------------------------------------------------------
| FORM TAMBAH SISWA / PELAPOR - APLIKASI LAPOR KASUS SEKALISA
|--------------------------------------------------------------------------
*/

/** @var mysqli $koneksi */
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 font-weight-bold">
                    <i class="fas fa-user-plus text-primary mr-2"></i>Tambah Data Siswa
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php?halaman=dashboardadmin">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="index.php?halaman=pelapor">Siswa Pelapor</a></li>
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
                <h3 class="card-title font-weight-bold text-dark m-0">
                    <i class="fas fa-edit mr-1"></i> Form Registrasi Akun Siswa
                </h3>
            </div>

            <form action="proses/pelapor/simpan.php" method="POST" enctype="multipart/form-data">
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-6">
                            <!-- NISN / NIS -->
                            <div class="form-group">
                                <label for="nisn" class="font-weight-bold">
                                    NISN / NIS <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="nisn" id="nisn" class="form-control" placeholder="Masukkan nomor NISN siswa" required>
                            </div>

                            <!-- NAMA LENGKAP -->
                            <div class="form-group">
                                <label for="namasiswa" class="font-weight-bold">
                                    Nama Lengkap Siswa <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="namasiswa" id="namasiswa" class="form-control" placeholder="Nama lengkap sesuai absensi" required>
                            </div>

                            <!-- KELAS & JURUSAN -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="kelas" class="font-weight-bold">Kelas <span class="text-danger">*</span></label>
                                        <input type="text" name="kelas" id="kelas" class="form-control" placeholder="Contoh: X, XI, XII" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="jurusan" class="font-weight-bold">Jurusan</label>
                                        <input type="text" name="jurusan" id="jurusan" class="form-control" placeholder="Contoh: RPL 1, TKJ 2">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <!-- USERNAME -->
                            <div class="form-group">
                                <label for="username" class="font-weight-bold">
                                    Username Login <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="username" id="username" class="form-control" placeholder="Username unik untuk login" required>
                            </div>

                            <!-- PASSWORD -->
                            <div class="form-group">
                                <label for="password" class="font-weight-bold">
                                    Password Login <span class="text-danger">*</span>
                                </label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Min. 6 Karakter" required>
                            </div>

                            <!-- NO HP -->
                            <div class="form-group">
                                <label for="nohp" class="font-weight-bold">Nomor HP / WhatsApp</label>
                                <input type="text" name="nohp" id="nohp" class="form-control" placeholder="08xxxxxxxxxx">
                            </div>
                        </div>
                    </div>

                    <!-- ALAMAT -->
                    <div class="form-group">
                        <label for="alamat" class="font-weight-bold">Alamat Tempat Tinggal</label>
                        <textarea name="alamat" id="alamat" rows="3" class="form-control" placeholder="Alamat lengkap siswa..."></textarea>
                    </div>

                    <!-- FOTO PROFIL -->
                    <div class="form-group">
                        <label for="foto" class="font-weight-bold">Foto Profil Siswa</label>
                        <input type="file" name="foto" id="foto" class="form-control-file" accept="image/*">
                    </div>

                </div>

                <div class="card-footer bg-light text-right">
                    <a href="index.php?halaman=pelapor" class="btn btn-secondary mr-2">
                        <i class="fas fa-arrow-left mr-1"></i> Batal
                    </a>
                    <button type="submit" name="submit" class="btn btn-primary">
                        <i class="fas fa-save mr-1"></i> Simpan Data Siswa
                    </button>
                </div>
            </form>
        </div>

    </div>
</section>