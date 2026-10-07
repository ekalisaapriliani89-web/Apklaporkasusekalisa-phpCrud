<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Brand Logo -->
    <a href="index.php?halaman=dashboardsiswa" class="brand-link">

        <img
            src="assets/images/logo.png"
            alt="Logo"
            class="brand-image img-circle elevation-3"
            style="opacity: .8">

        <span class="brand-text font-weight-light">
            Lapor Kasus Sekalisa
        </span>

    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- User Panel -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">

            <div class="image">
                <img
                    src="assets/images/siswa/<?=
                        !empty($_SESSION['foto'])
                        ? $_SESSION['foto']
                        : 'default.png';
                    ?>"
                    class="img-circle elevation-2"
                    alt="User Image">
            </div>

            <div class="info">

                <a href="index.php?halaman=profilsiswa" class="d-block">
                    <?= $_SESSION['namasiswasiswa'] ?? $_SESSION['nama'] ?? 'Siswa'; ?>
                </a>

                <small class="text-light">
                    Siswa Sekalisa
                </small>

            </div>

        </div>

        <!-- Menu -->
        <nav class="mt-2">

            <ul class="nav nav-pills nav-sidebar flex-column"
                data-widget="treeview"
                role="menu">

                <li class="nav-item">

                    <a href="index.php?halaman=dashboardsiswa"
                        class="nav-link">

                        <i class="nav-icon fas fa-tachometer-alt"></i>

                        <p>Dashboard</p>

                    </a>

                </li>

                <li class="nav-item">

                    <a href="index.php?halaman=profilsiswa"
                        class="nav-link">

                        <i class="nav-icon fas fa-user"></i>

                        <p>Profil Saya</p>

                    </a>

                </li>

                <li class="nav-item">

                    <a href="index.php?halaman=riwayatkasus"
                        class="nav-link">

                        <i class="nav-icon fas fa-exclamation-triangle"></i>

                        <p>Riwayat Laporan Kasus</p>

                    </a>

                </li>

                <li class="nav-item">

                    <a href="index.php?halaman=logout"
                        class="nav-link text-danger">

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