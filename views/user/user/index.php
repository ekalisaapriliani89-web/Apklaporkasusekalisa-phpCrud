<?php
/*
|--------------------------------------------------------------------------
| DETAIL SISWA - APLIKASI LAPOR KASUS SEKALISA
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

$qPengajuan = mysqli_query($koneksi, "SELECT p.*, k.namakasus FROM pengajuan p LEFT JOIN kasus k ON p.idkasus = k.idkasus WHERE p.idsiswa = '$idsiswa' ORDER BY p.idpengajuan DESC");
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 font-weight-bold"><i class="fas fa-id-card text-info mr-2"></i>Detail Siswa</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php?halaman=dashboardadmin">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="index.php?halaman=siswa">Siswa</a></li>
                    <li class="breadcrumb-item active">Detail Siswa</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm text-center">
                    <div class="card-body">
                        <?php $foto = !empty($siswa['foto']) ? $siswa['foto'] : 'default.png'; ?>
                        <img src="assets/images/siswa/<?= $foto; ?>" class="img-circle elevation-2 mb-3" style="width: 120px; height: 120px; object-fit: cover;" onerror="this.src='assets/images/siswa/default.png';">
                        <h4 class="font-weight-bold text-dark mb-1"><?= htmlspecialchars($siswa['namasiswa']); ?></h4>
                        <p class="text-muted mb-2">NISN: <strong><?= htmlspecialchars($siswa['nisn'] ?? '-'); ?></strong></p>
                        <span class="badge badge-primary px-3 py-1">Kelas <?= htmlspecialchars(($siswa['kelas'] ?? '') . ' ' . ($siswa['jurusan'] ?? '')); ?></span>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white py-3">
                        <h3 class="card-title font-weight-bold text-dark m-0"><i class="fas fa-info-circle mr-1"></i> Informasi Kontak</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless">
                            <tr><th width="30%">Username</th><td>: <?= htmlspecialchars($siswa['username'] ?? '-'); ?></td></tr>
                            <tr><th>No. HP</th><td>: <?= htmlspecialchars($siswa['nohp'] ?? '-'); ?></td></tr>
                            <tr><th>Alamat</th><td>: <?= htmlspecialchars($siswa['alamat'] ?? '-'); ?></td></tr>
                        </table>
                    </div>
                    <div class="card-footer bg-light text-right">
                        <a href="index.php?halaman=siswa" class="btn btn-secondary mr-2"><i class="fas fa-arrow-left mr-1"></i> Kembali</a>
                        <a href="index.php?halaman=editsiswa&id=<?= $siswa['idsiswa']; ?>" class="btn btn-warning text-white"><i class="fas fa-edit mr-1"></i> Edit</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>