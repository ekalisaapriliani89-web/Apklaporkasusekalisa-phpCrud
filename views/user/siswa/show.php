<?php
/*
|--------------------------------------------------------------------------
| FORM EDIT SISWA - APLIKASI LAPOR KASUS SEKALISA
|--------------------------------------------------------------------------
*/

/** @var mysqli $koneksi */

$idsiswa = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$qSiswa  = mysqli_query($koneksi, "SELECT * FROM siswa WHERE idsiswa = '$idsiswa' LIMIT 1");
$siswa   = mysqli_fetch_assoc($qSiswa);

if (!$siswa) {
    echo "<script>alert('Data siswa tidak ditemukan!'); window.location='index.php?halaman=siswa';</script>";
    exit;
}
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 font-weight-bold"><i class="fas fa-user-edit text-warning mr-2"></i>Edit Data Siswa</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php?halaman=dashboardadmin">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="index.php?halaman=siswa">Siswa</a></li>
                    <li class="breadcrumb-item active">Edit Siswa</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <h3 class="card-title font-weight-bold text-dark m-0"><i class="fas fa-pen mr-1"></i> Edit Siswa #<?= $siswa['idsiswa']; ?></h3>
            </div>
            <form action="proses/siswa/update.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="idsiswa" value="<?= $siswa['idsiswa']; ?>">
                <input type="hidden" name="fotolama" value="<?= $siswa['foto']; ?>">

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">NISN <span class="text-danger">*</span></label>
                                <input type="text" name="nisn" class="form-control" value="<?= htmlspecialchars($siswa['nisn'] ?? ''); ?>" required>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" name="namasiswa" class="form-control" value="<?= htmlspecialchars($siswa['namasiswa']); ?>" required>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Kelas</label>
                                        <input type="text" name="kelas" class="form-control" value="<?= htmlspecialchars($siswa['kelas'] ?? ''); ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Jurusan</label>
                                        <input type="text" name="jurusan" class="form-control" value="<?= htmlspecialchars($siswa['jurusan'] ?? ''); ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">Username <span class="text-danger">*</span></label>
                                <input type="text" name="username" class="form-control" value="<?= htmlspecialchars($siswa['username'] ?? ''); ?>" required>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Password Baru <small class="text-muted">(Kosongkan jika tidak diganti)</small></label>
                                <input type="password" name="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Nomor HP</label>
                                <input type="text" name="nohp" class="form-control" value="<?= htmlspecialchars($siswa['nohp'] ?? ''); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Alamat</label>
                        <textarea name="alamat" rows="3" class="form-control"><?= htmlspecialchars($siswa['alamat'] ?? ''); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Ganti Foto Profil</label>
                        <input type="file" name="foto" class="form-control-file" accept="image/*">
                    </div>
                </div>
                <div class="card-footer bg-light text-right">
                    <a href="index.php?halaman=siswa" class="btn btn-secondary mr-2"><i class="fas fa-arrow-left mr-1"></i> Batal</a>
                    <button type="submit" name="submit" class="btn btn-warning text-white"><i class="fas fa-sync-alt mr-1"></i> Update Data</button>
                </div>
            </form>
        </div>
    </div>
</section>