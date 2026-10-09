<!-- =====================================================
     NAVBAR TAMU (PUBLIC) - LAPOR KASUS SEKALISA
===================================================== -->
<nav class="main-header navbar navbar-expand-lg navbar-white navbar-light shadow-sm">
    <div class="container">

        <!-- LOGO & BRAND -->
        <a href="index.php?halaman=home" class="navbar-brand">
            <img src="assets/images/logo.png" 
                 alt="Logo" 
                 class="brand-image img-circle elevation-2" 
                 height="40px" 
                 width="35px"
                 onerror="this.style.display='none'">
            <span class="brand-text font-weight-bold ml-1">
                <span class="text-primary">LAPOR</span>
                <span class="text-danger">KASUS</span>
                <span class="text-success">SEKALISA</span>
            </span>
        </a>

        <!-- TOGGLER MOBILE -->
        <button class="navbar-toggler" 
                type="button" 
                data-toggle="collapse" 
                data-target="#navbarCollapse" 
                aria-controls="navbarCollapse" 
                aria-expanded="false" 
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- MENU NAVBAR -->
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="index.php?halaman=home" class="nav-link">
                        <i class="fas fa-home mr-1"></i> Home
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index.php?halaman=daftarkasus" class="nav-link">
                        <i class="fas fa-folder-open mr-1"></i> Daftar Kasus
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index.php?halaman=daftarkategori" class="nav-link">
                        <i class="fas fa-tags mr-1"></i> Kategori Kasus
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index.php?halaman=tentang" class="nav-link">
                        <i class="fas fa-info-circle mr-1"></i> Tentang
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index.php?halaman=kontak" class="nav-link">
                        <i class="fas fa-envelope mr-1"></i> Kontak
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index.php?halaman=panduan" class="nav-link">
                        <i class="fas fa-book mr-1"></i> Panduan
                    </a>
                </li>
            </ul>

            <!-- TOMBOL LOGIN (RIGHT SIDE) -->
            <ul class="navbar-nav ml-auto align-items-lg-center">
                <li class="nav-item my-1 my-lg-0">
                    <a href="index.php?halaman=loginsiswa" class="btn btn-outline-primary btn-block">
                        <i class="fas fa-user-graduate mr-1"></i> Login Siswa
                    </a>
                </li>
                <li class="nav-item ml-lg-2 my-1 my-lg-0">
                    <a href="index.php?halaman=loginuser" class="btn btn-primary btn-block">
                        <i class="fas fa-user-shield mr-1"></i> Login Petugas / Admin
                    </a>
                </li>
            </ul>
        </div>

    </div>
</nav>