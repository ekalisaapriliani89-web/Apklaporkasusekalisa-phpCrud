<?php
// Helper sederhana untuk active class jika belum ada
if (!function_exists('menuAktif')) {
    function menuAktif($halamanTarget) {
        $halamanAktif = $_GET['halaman'] ?? '';
        return ($halamanAktif === $halamanTarget) ? 'active' : '';
    }
}
?>

<!-- Main Sidebar Admin -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Brand Logo -->
    <a href="index.php?halaman=dashboardadmin" class="brand-link">
        <span class="brand-text font-weight-bold pl-2">
            LAPOR KASUS <small class="badge badge-primary">ADMIN</small>
        </span>
    </a>

    <div class="sidebar">

        <!-- User Panel -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
            <div class="image">
                <img src="assets/images/user/<?= htmlspecialchars($_SESSION['foto'] ?? 'default.png'); ?>" 
                     class="img-circle elevation-2" 
                     alt="User Image"
                     style="width: 38px; height: 38px; object-fit: cover;">
            </div>
            <div class="info">
                <a href="#" class="d-block font-weight-bold">
                    <?= htmlspecialchars($_SESSION['namauser'] ?? 'Administrator'); ?>
                </a>
                <small class="text-success">
                    <i class="fas fa-circle fa-xs"></i> <?= ucfirst(htmlspecialchars($_SESSION['role'] ?? 'admin')); ?>
                </small>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" 
                data-widget="treeview" 
                role="menu" 
                data-accordion="false">

                <!-- DASHBOARD -->
                <li class="nav-item">
                    <a href="index.php?halaman=dashboardadmin" class="nav-link <?= menuAktif('dashboardadmin'); ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard Admin</p>
                    </a>
                </li>

                <li class="nav-header">AKSES MANAJEMEN</li>

                <!-- USER (KHUSUS ADMIN - FITUR 8) -->
                <li class="nav-item">
                    <a href="index.php?halaman=user" class="nav-link <?= menuAktif('user'); ?>">
                        <i class="nav-icon fas fa-user-shield text-warning"></i>
                        <p>Manajemen User</p>
                    </a>
                </li>

                <!-- PELAPOR (FITUR 9 & 12) -->
                <li class="nav-item">
                    <a href="index.php?halaman=pelapor" class="nav-link <?= menuAktif('pelapor'); ?>">
                        <i class="nav-icon fas fa-user-tag"></i>
                        <p>Data Pelapor</p>
                    </a>
                </li>

                <li class="nav-header">MASTER DATA KASUS</li>

                <!-- MASTER SISWA -->
                <li class="nav-item">
                    <a href="index.php?halaman=siswa" class="nav-link <?= menuAktif('siswa'); ?>">
                        <i class="nav-icon fas fa-user-graduate"></i>
                        <p>Data Siswa</p>
                    </a>
                </li>

                <!-- KATEGORI KASUS -->
                <li class="nav-item">
                    <a href="index.php?halaman=kategori" class="nav-link <?= menuAktif('kategori'); ?>">
                        <i class="nav-icon fas fa-tags"></i>
                        <p>Kategori Kasus</p>
                    </a>
                </li>

                <!-- MASTER KASUS (FITUR 10) -->
                <li class="nav-item">
                    <a href="index.php?halaman=kasus" class="nav-link <?= menuAktif('kasus'); ?>">
                        <i class="nav-icon fas fa-folder-open"></i>
                        <p>Master Kasus</p>
                    </a>
                </li>

                <!-- MASTER SANKSI (FITUR 11) -->
                <li class="nav-item">
                    <a href="index.php?halaman=sanksi" class="nav-link <?= menuAktif('sanksi'); ?>">
                        <i class="nav-icon fas fa-gavel"></i>
                        <p>Master Sanksi</p>
                    </a>
                </li>

                <li class="nav-header">PROSES & OPERASIONAL</li>

                <!-- PENANGANAN KASUS (FITUR 14) -->
                <li class="nav-item">
                    <a href="index.php?halaman=penanganan" class="nav-link <?= menuAktif('penanganan'); ?>">
                        <i class="nav-icon fas fa-tasks text-info"></i>
                        <p>Penanganan Kasus</p>
                    </a>
                </li>

                <li class="nav-header">REKAP LAPORAN (FITUR 6)</li>

                <li class="nav-item">
                    <a href="index.php?halaman=laporanharian" class="nav-link <?= menuAktif('laporanharian'); ?>">
                        <i class="nav-icon fas fa-calendar-day"></i>
                        <p>Laporan Harian</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="index.php?halaman=laporanbulanan" class="nav-link <?= menuAktif('laporanbulanan'); ?>">
                        <i class="nav-icon fas fa-calendar-alt"></i>
                        <p>Laporan Bulanan</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="index.php?halaman=laporantahunan" class="nav-link <?= menuAktif('laporantahunan'); ?>">
                        <i class="nav-icon fas fa-chart-line"></i>
                        <p>Laporan Tahunan</p>
                    </a>
                </li>

                <li class="nav-header">SISTEM</li>

                <li class="nav-item">
                    <a href="index.php?halaman=logout" class="nav-link text-danger">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                </li>

            </ul>
        </nav>

    </div>

</aside>