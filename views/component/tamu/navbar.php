<!-- views/component/tamu/navbar.php -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold" href="/apklaporkasusekalisa/index.php">LAPOR KASUS</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navTamu">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navTamu">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" href="/apklaporkasusekalisa/index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="/apklaporkasusekalisa/views/landing/daftarkasus.php">Daftar Kasus</a></li>
        <li class="nav-item"><a class="nav-link" href="/apklaporkasusekalisa/views/landing/daftarkategori.php">Kategori</a></li>
        <li class="nav-item"><a class="nav-link" href="/apklaporkasusekalisa/views/landing/panduan.php">Panduan</a></li>
        <li class="nav-item"><a class="nav-link" href="/apklaporkasusekalisa/views/landing/tentang.php">Tentang</a></li>
        <li class="nav-item"><a class="nav-link" href="/apklaporkasusekalisa/views/landing/kontak.php">Kontak</a></li>
      </ul>
      <div class="d-flex gap-2">
        <a href="/apklaporkasusekalisa/views/auth/loginsiswa.php" class="btn btn-light text-primary fw-semibold">Login Siswa</a>
        <a href="/apklaporkasusekalisa/views/auth/loginuser.php" class="btn btn-warning text-dark fw-bold">Login Petugas/Admin</a>
      </div>
    </div>
  </div>
</nav>