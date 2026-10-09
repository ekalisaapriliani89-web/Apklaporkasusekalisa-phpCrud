<!-- Navbar Siswa -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">

    <!-- Sidebar Toggle -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                <i class="fas fa-bars"></i>
            </a>
        </li>
    </ul>

    <!-- Menu Cepat Siswa -->
    <ul class="navbar-nav">
        <li class="nav-item d-none d-md-inline-block">
            <a href="index.php?halaman=pengajuan" class="nav-link">
                <i class="fas fa-plus-circle text-primary mr-1"></i> Buat Laporan
            </a>
        </li>
        <li class="nav-item d-none d-md-inline-block">
            <a href="index.php?halaman=riwayatkasus" class="nav-link">
                <i class="fas fa-history mr-1"></i> Status Laporan
            </a>
        </li>
    </ul>

    <!-- Right Navbar -->
    <ul class="navbar-nav ml-auto">

        <li class="nav-item dropdown user-menu">

            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <img src="assets/images/siswa/<?= htmlspecialchars(!empty($_SESSION['foto']) ? $_SESSION['foto'] : 'default.png'); ?>"
                     class="user-image img-circle elevation-2"
                     alt="Foto Siswa"
                     style="width: 30px; height: 30px; object-fit: cover;">

                <span class="d-none d-md-inline">
                    <?= htmlspecialchars($_SESSION['namasiswa'] ?? 'Siswa'); ?>
                </span>
            </a>

            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

                <!-- Header Profile Dropdown -->
                <li class="user-header bg-primary">
                    <img src="assets/images/siswa/<?= htmlspecialchars(!empty($_SESSION['foto']) ? $_SESSION['foto'] : 'default.png'); ?>"
                         class="img-circle elevation-2"
                         alt="Foto Siswa"
                         style="width: 90px; height: 90px; object-fit: cover;">

                    <p>
                        <?= htmlspecialchars($_SESSION['namasiswa'] ?? 'Siswa'); ?>
                        <small>Role: Siswa / Pelapor</small>
                    </p>
                </li>

                <!-- Footer Dropdown -->
                <li class="user-footer">
                    <a href="index.php?halaman=profil" class="btn btn-default btn-flat">
                        <i class="fas fa-user-cog mr-1"></i> Profil
                    </a>

                    <a href="index.php?halaman=logout" class="btn btn-danger btn-flat float-right">
                        <i class="fas fa-sign-out-alt mr-1"></i> Logout
                    </a>
                </li>

            </ul>

        </li>

    </ul>

</nav>
<!-- /.navbar -->