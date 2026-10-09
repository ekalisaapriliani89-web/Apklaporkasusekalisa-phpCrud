<?php
/*
|--------------------------------------------------------------------------
| PROFIL SISWA - APLIKASI LAPOR KASUS SEKALISA
|--------------------------------------------------------------------------
*/

/** @var mysqli $koneksi */

// Pastikan siswa sudah login
if (!isset($_SESSION['idsiswa'])) {
    echo "<script>alert('Silakan login terlebih dahulu!'); window.location='index.php?halaman=loginsiswa';</script>";
    exit;
}

$idsiswa = (int) $_SESSION['idsiswa'];

// Query data siswa berdasarkan session ID Siswa
$query = mysqli_query(
    $koneksi,
    "SELECT *
     FROM siswa
     WHERE idsiswa='$idsiswa'
     LIMIT 1"
);
$siswa = mysqli_fetch_assoc($query);

// Tentukan foto profil (direktori assets/images/siswa/)
$foto = !empty($siswa['foto']) ? $siswa['foto'] : 'default.png';
?>

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="font-weight-bold">
                    <i class="fas fa-user-circle text-primary mr-2"></i>Profil Siswa
                </h1>
            </div>
            <div class="col-sm-6 text-right">
                <small class="text-muted">
                    <i class="far fa-calendar-alt mr-1"></i>
                    <?= function_exists('tanggalIndonesia') ? tanggalIndonesia(date('Y-m-d')) : date('d F Y'); ?>
                </small>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">

        <!-- BANNER HEADER PROFIL -->
        <div class="card bg-gradient-primary shadow-sm border-0 mb-4">
            <div class="card-body p-4 text-white">
                <h3 class="font-weight-bold mb-1">Profil Saya</h3>
                <p class="mb-0">
                    Informasi identitas akun siswa yang terdaftar pada Aplikasi Lapor Kasus Sekalisa.
                </p>
            </div>
        </div>

        <div class="row">
            <!-- RINGKASAN PROFIL (SISI KIRI) -->
            <div class="col-lg-4">
                <div class="card card-primary card-outline border-0 shadow-sm">
                    <div class="card-body box-profile">
                        <div class="text-center mb-3">
                            <img
                                src="assets/images/siswa/<?= htmlspecialchars($foto); ?>"
                                class="profile-user-img img-fluid img-circle elevation-2"
                                style="width:140px; height:140px; object-fit:cover;"
                                alt="Foto Siswa"
                                onerror="this.src='assets/images/siswa/default.png';">
                        </div>

                        <h3 class="profile-username text-center font-weight-bold text-dark mb-1">
                            <?= htmlspecialchars($siswa['namasiswa'] ?? $_SESSION['namasiswa'] ?? 'Siswa'); ?>
                        </h3>

                        <p class="text-muted text-center mb-3">
                            <span class="badge badge-primary px-3 py-1">
                                Siswa / Pelapor
                            </span>
                        </p>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>NISN / NIS</b>
                                <span class="float-right font-weight-bold text-dark">
                                    <?= htmlspecialchars($siswa['nisn'] ?? $siswa['nis'] ?? '-'); ?>
                                </span>
                            </li>
                            <li class="list-group-item">
                                <b>Kelas & Jurusan</b>
                                <span class="float-right text-muted">
                                    <?= htmlspecialchars(($siswa['kelas'] ?? '') . ' ' . ($siswa['jurusan'] ?? '')); ?>
                                </span>
                            </li>
                            <li class="list-group-item">
                                <b>Username</b>
                                <span class="float-right text-muted">
                                    <?= htmlspecialchars($siswa['username'] ?? '-'); ?>
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- DETAIL DATA PROFIL (SISI KANAN) -->
            <div class="col-lg-8">
                <div class="card card-outline card-primary border-0 shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <h3 class="card-title font-weight-bold">
                            <i class="fas fa-id-card text-primary mr-1"></i> Detail Identitas Siswa
                        </h3>
                    </div>
                    <div class="card-body">

                        <div class="row mb-3">
                            <div class="col-md-4 text-muted">
                                <strong>Nama Lengkap</strong>
                            </div>
                            <div class="col-md-8 font-weight-bold text-dark">
                                <?= htmlspecialchars($siswa['namasiswa'] ?? '-'); ?>
                            </div>
                        </div>
                        <hr>

                        <div class="row mb-3">
                            <div class="col-md-4 text-muted">
                                <strong>NISN / NIS</strong>
                            </div>
                            <div class="col-md-8 text-dark">
                                <?= htmlspecialchars($siswa['nisn'] ?? $siswa['nis'] ?? '-'); ?>
                            </div>
                        </div>
                        <hr>

                        <div class="row mb-3">
                            <div class="col-md-4 text-muted">
                                <strong>Kelas / Rombel</strong>
                            </div>
                            <div class="col-md-8 text-dark">
                                <?= htmlspecialchars($siswa['kelas'] ?? '-'); ?>
                            </div>
                        </div>
                        <hr>

                        <div class="row mb-3">
                            <div class="col-md-4 text-muted">
                                <strong>Jurusan / Program</strong>
                            </div>
                            <div class="col-md-8 text-dark">
                                <?= htmlspecialchars($siswa['jurusan'] ?? '-'); ?>
                            </div>
                        </div>
                        <hr>

                        <div class="row mb-3">
                            <div class="col-md-4 text-muted">
                                <strong>Nomor HP / WhatsApp</strong>
                            </div>
                            <div class="col-md-8 text-dark">
                                <?= htmlspecialchars(!empty($siswa['nohp']) ? $siswa['nohp'] : '-'); ?>
                            </div>
                        </div>
                        <hr>

                        <div class="row mb-3">
                            <div class="col-md-4 text-muted">
                                <strong>Alamat Rumah</strong>
                            </div>
                            <div class="col-md-8 text-dark">
                                <?= htmlspecialchars(!empty($siswa['alamat']) ? $siswa['alamat'] : '-'); ?>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-md-4 text-muted">
                                <strong>Status Akun</strong>
                            </div>
                            <div class="col-md-8">
                                <span class="badge badge-success px-3 py-1">
                                    <i class="fas fa-check-circle mr-1"></i> Aktif
                                </span>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- INFORMASI KETENTUAN AKUN -->
                <div class="card card-outline card-info border-0 shadow-sm">
                    <div class="card-header bg-white py-3">
                        <h3 class="card-title font-weight-bold text-info">
                            <i class="fas fa-shield-alt mr-1"></i> Ketentuan Akses Akun Siswa
                        </h3>
                    </div>
                    <div class="card-body">
                        <ul class="mb-0 text-muted pl-3">
                            <li class="mb-2">
                                Akun ini digunakan secara khusus untuk membuat dan memantau status pengajuan laporan kasus pelanggaran di sekolah.
                            </li>
                            <li class="mb-2">
                                Pastikan nomor HP/WhatsApp aktif agar Petugas atau Guru BK dapat melakukan klarifikasi jika diperlukan.
                            </li>
                            <li>
                                Jagalah kerahasiaan username dan password akun Anda demi keamanan identitas laporan.
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>

    </div>
</section>