<!-- Main Sidebar -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Brand Logo -->
    <a href="index.php?halaman=<?= ($_SESSION['role'] ?? '') === 'admin' ? 'dashboardadmin' : 'dashboardpetugas'; ?>" class="brand-link">
        <span class="brand-text font-weight-light pl-2">
            <strong>Lapor Kasus</strong> Sekalisa
        </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- User Panel -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
            <div class="image">
                <img src="assets/images/user/<?= $_SESSION['foto'] ?? 'default.png'; ?>" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block font-weight-bold">
                    <?= $_SESSION['namauser'] ?? $_SESSION['username'] ?? 'Pengguna'; ?>
                </a>
                <small class="badge badge-info text-capitalize">
                    <?= $_SESSION['role'] ?? 'Petugas'; ?>
                </small>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <!-- DASHBOARD -->
                <li class="nav-item">
                    <?php $dashPage = (($_SESSION['role'] ?? '') === 'admin') ? 'dashboardadmin' : 'dashboardpetugas'; ?>
                    <a href="index.php?halaman=<?= $dashPage; ?>" class="nav-link <?= menuAktif($dashPage); ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-header">MASTER DATA</li>

                <!-- MANAJEMEN USER (KHUSUS ADMIN) -->
                <?php if (($_SESSION['role'] ?? '') === 'admin'): ?>
                <li class="nav-item">
                    <a href="index.php?halaman=user" class="nav-link <?= menuAktif('user'); ?>">
                        <i class="nav-icon fas fa-user-shield"></i>
                        <p>Data User / Petugas</p>
                    </a>
                </li>
                <?php endif; ?>

                <!-- DATA SISWA -->
                <li class="nav-item">
                    <a href="index.php?halaman=siswa" class="nav-link <?= menuAktif('siswa'); ?>">
                        <i class="nav-icon fas fa-user-graduate"></i>
                        <p>Data Siswa</p>
                    </a>
                </li>

                <!-- DATA PELAPOR -->
                <li class="nav-item">
                    <a href="index.php?halaman=pelapor" class="nav-link <?= menuAktif('pelapor'); ?>">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Data Pelapor</p>
                    </a>
                </li>

                <!-- KATEGORI KASUS -->
                <li class="nav-item">
                    <a href="index.php?halaman=kategori" class="nav-link <?= menuAktif('kategori'); ?>">
                        <i class="nav-icon fas fa-tags"></i>
                        <p>Kategori Kasus</p>
                    </a>
                </li>

                <!-- MASTER KASUS -->
                <li class="nav-item">
                    <a href="index.php?halaman=kasus" class="nav-link <?= menuAktif('kasus'); ?>">
                        <i class="nav-icon fas fa-folder-open"></i>
                        <p>Master Kasus</p>
                    </a>
                </li>

                <!-- MASTER SANKSI -->
                <li class="nav-item">
                    <a href="index.php?halaman=sanksi" class="nav-link <?= menuAktif('sanksi'); ?>">
                        <i class="nav-icon fas fa-gavel"></i>
                        <p>Master Sanksi</p>
                    </a>
                </li>

                <li class="nav-header">PENANGANAN LAPORAN</li>

                <!-- PENANGANAN KASUS -->
                <li class="nav-item">
                    <a href="index.php?halaman=penanganan" class="nav-link <?= menuAktif('penanganan'); ?>">
                        <i class="nav-icon fas fa-clipboard-list"></i>
                        <p>Penanganan Kasus</p>
                    </a>
                </li>

                <li class="nav-header">LAPORAN REKAP</li>

                <li class="nav-item">
                    <a href="index.php?halaman=laporanharian" class="nav-link <?= menuAktif('laporanharian'); ?>">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>Laporan Harian</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="index.php?halaman=laporanbulanan" class="nav-link <?= menuAktif('laporanbulanan'); ?>">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>Laporan Bulanan</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="index.php?halaman=laporantahunan" class="nav-link <?= menuAktif('laporantahunan'); ?>">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>Laporan Tahunan</p>
                    </a>
                </li>

                <li class="nav-header">AUTENTIKASI</li>

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