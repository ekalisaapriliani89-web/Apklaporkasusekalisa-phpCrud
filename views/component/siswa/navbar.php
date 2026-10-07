<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm mb-4">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="#">Lapor Kasus Siswa</a>
        <div class="d-flex align-items-center text-white">
            <span class="me-3">Halo, <?= htmlspecialchars($_SESSION['namasiswa'] ?? 'Siswa'); ?></span>
            <a href="../auth/logout.php" class="btn btn-sm btn-outline-light">Logout</a>
        </div>
    </div>
</nav>