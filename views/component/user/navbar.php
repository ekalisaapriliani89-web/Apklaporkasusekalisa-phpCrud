<!-- Navbar User (Admin & Petugas) -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Tombol Toggle Sidebar -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                <i class="fas fa-bars"></i>
            </a>
        </li>
    </ul>

    <!-- Menu Cepat (Quick Access) -->
    <ul class="navbar-nav">
        <li class="nav-item d-none d-md-inline-block">
            <a href="index.php?halaman=kasus" class="nav-link">
                <i class="fas fa-folder-open mr-1"></i> Data Kasus
            </a>
        </li>
        <li class="nav-item d-none d-md-inline-block">
            <a href="index.php?halaman=penanganan" class="nav-link">
                <i class="fas fa-tasks mr-1"></i> Penanganan Kasus
            </a>
        </li>
        <li class="nav-item dropdown d-none d-md-inline-block">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
                <i class="fas fa-file-alt mr-1"></i> Rekap Laporan
            </a>
            <div class="dropdown-menu">
                <a href="index.php?halaman=laporanharian" class="dropdown-item">
                    <i class="fas fa-calendar-day mr-2"></i> Laporan Harian
                </a>
                <a href="index.php?halaman=laporanbulanan" class="dropdown-item">
                    <i class="fas fa-calendar-alt mr-2"></i> Laporan Bulanan
                </a>
                <a href="index.php?halaman=laporantahunan" class="dropdown-item">
                    <i class="fas fa-chart-line mr-2"></i> Laporan Tahunan
                </a>
            </div>
        </li>
    </ul>

    <!-- User Menu (Profil & Logout) -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <img src="assets/images/user/<?= htmlspecialchars($_SESSION['foto'] ?? 'default.png'); ?>"
                     class="user-image img-circle elevation-2" 
                     alt="User Image">
                <span class="d-none d-md-inline">
                    <?= htmlspecialchars($_SESSION['namauser'] ?? 'User Internal'); ?>
                </span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <!-- User Header -->
                <li class="user-header bg-primary">
                    <img src="assets/images/user/<?= htmlspecialchars($_SESSION['foto'] ?? 'default.png'); ?>"
                         class="img-circle elevation-2" 
                         alt="User Image">
                    <p>
                        <?= htmlspecialchars($_SESSION['namauser'] ?? 'User Internal'); ?>
                        <small>Role: <?= ucfirst(htmlspecialchars($_SESSION['role'] ?? 'petugas')); ?></small>
                    </p>
                </li>
                <!-- User Footer -->
                <li class="user-footer">
                    <span class="btn btn-default btn-flat disabled">
                        <i class="fas fa-user-shield mr-1"></i>
                        <?= ucfirst(htmlspecialchars($_SESSION['role'] ?? 'petugas')); ?>
                    </span>
                    <a href="index.php?halaman=logout" class="btn btn-danger btn-flat float-right">
                        <i class="fas fa-sign-out-alt mr-1"></i> Logout
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</nav>
<!-- /.navbar -->