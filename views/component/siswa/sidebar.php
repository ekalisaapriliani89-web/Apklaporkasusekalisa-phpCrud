<?php
// Helper sederhana untuk active class jika belum ada
if (!function_exists('menuAktif')) {
    function menuAktif($halamanTarget) {
        $halamanAktif = $_GET['halaman'] ?? '';
        return ($halamanAktif === $halamanTarget) ? 'active' : '';
    }
}
?>

<!-- Main Sidebar Container Siswa -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Brand Logo -->
    <a href="index.php?halaman=dashboardsiswa" class="brand-link">
        <img src="assets/images/logo.png" 
             alt="Logo Sekalisa" 
             class="brand-image img-circle elevation-3" 
             style="opacity: .8"
             onerror="this.style.display='none'">
        <span class="brand-text font-weight-bold pl-1">
            LAPOR KASUS <small class="badge badge-success">SISWA</small>
        </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- User Panel -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
            <div class="image">
                <img src="assets/images/siswa/<?= htmlspecialchars(!empty($_SESSION['foto']) ? $_SESSION['foto'] : 'default.png'); ?>"
                     class="img-circle elevation-2"
                     alt="Foto Siswa"
                     style="width: 38px; height: 38px; object-fit: cover;">
            </div>

            <div class="info">
                <a href="index.php?halaman=profil" class="d-block font-weight-bold">
                    <?= htmlspecialchars($_SESSION['namasiswa'] ?? 'Siswa Pelapor'); ?>
                </a>
                <small class="text-success">
                    <i class="fas fa-circle fa-xs"></i> Siswa / Pelapor
                </small>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <!-- DASHBOARD SISWA (FITUR 5) -->
                <li class="nav-item">
                    <a href="index.php?halaman=dashboardsiswa" class="nav-link <?= menuAktif('dashboardsiswa'); ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- PROFIL SAYA -->
                <li class="nav-item">
                    <a href="index.php?halaman=profil" class="nav-link <?= menuAktif('profil'); ?>">
                        <i class="nav-icon fas fa-user-circle"></i>
                        <p>Profil Saya</p>
                    </a>
                </li>

                <li class="nav-header">LAYANAN PENGADUAN</li>

                <!-- AJUKAN LAPORAN (FITUR 13) -->
                <li class="nav-item">
                    <a href="index.php?halaman=pengajuan" class="nav-link <?= menuAktif('pengajuan') . menuAktif('createpengajuan'); ?>">
                        <i class="nav-icon fas fa-paper-plane text-primary"></i>
                        <p>Pengajuan Laporan</p>
                    </a>
                </li>

                <!-- RIWAYAT & MONITORING KASUS -->
                <li class="nav-item">
                    <a href="index.php?halaman=riwayatkasus" class="nav-link <?= menuAktif('riwayatkasus'); ?>">
                        <i class="nav-icon fas fa-history text-warning"></i>
                        <p>Status Laporan Saya</p>
                    </a>
                </li>

                <li class="nav-header">AKUN</li>

                <!-- LOGOUT -->
                <li class="nav-item">
                    <a href="index.php?halaman=logout" class="nav-link text-danger">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                </li>

            </ul>
        </nav>

    </div>
    <!-- /.sidebar -->

</aside>
<!-- /.main-sidebar -->