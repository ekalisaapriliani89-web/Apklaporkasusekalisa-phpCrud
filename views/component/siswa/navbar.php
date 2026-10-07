<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">

    <!-- Sidebar Toggle -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                <i class="fas fa-bars"></i>
            </a>
        </li>
    </ul>

    <!-- Right Navbar -->
    <ul class="navbar-nav ml-auto">

        <li class="nav-item dropdown user-menu">

            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">

                <img
                    src="assets/images/siswa/<?= 
                        !empty($_SESSION['foto']) 
                        ? $_SESSION['foto'] 
                        : 'default.png'; 
                    ?>"
                    class="user-image img-circle elevation-2"
                    alt="User Image">

                <span class="d-none d-md-inline">
                    <?= $_SESSION['namasiswasiswa'] ?? $_SESSION['nama'] ?? 'Siswa'; ?>
                </span>

            </a>

            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

                <li class="user-header bg-primary">

                    <img
                        src="assets/images/siswa/<?= 
                            !empty($_SESSION['foto']) 
                            ? $_SESSION['foto'] 
                            : 'default.png'; 
                        ?>"
                        class="img-circle elevation-2"
                        alt="User Image">

                    <p>
                        <?= $_SESSION['namasiswasiswa'] ?? $_SESSION['nama'] ?? 'Siswa'; ?>
                        <small>Siswa Sekalisa</small>
                    </p>

                </li>

                <li class="user-footer">

                    <a href="index.php?halaman=profilsiswa"
                        class="btn btn-default btn-flat">
                        Profil
                    </a>

                    <a href="index.php?halaman=logout"
                        class="btn btn-danger btn-flat float-right">
                        Logout
                    </a>

                </li>

            </ul>

        </li>

    </ul>

</nav>
<!-- /.navbar -->