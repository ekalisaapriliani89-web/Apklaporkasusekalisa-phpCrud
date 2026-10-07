<!-- views/component/siswa/navbar.php -->
<nav class="navbar navbar-expand-lg navbar-dark bg-success shadow-sm">
    <div class="container-fluid px-4">
        <a class="navbar-brand fw-bold" href="#">LAPOR KASUS - SISWA</a>
        <div class="d-flex align-items-center ms-auto text-white">
            <img src="/apklaporkasusekalisa/assets/images/siswa/<?= $_SESSION['foto'] ?? 'default.png'; ?>" class="rounded-circle me-2" width="35" height="35" style="object-fit:cover;">
            <div class="me-3">
                <div class="fw-bold"><?= htmlspecialchars($_SESSION['namasiswa'] ?? 'Siswa'); ?></div>
                <small class="text-white-50">Siswa - <?= htmlspecialchars($_SESSION['kelas'] ?? ''); ?></small>
            </div>
            <a href="/apklaporkasusekalisa/views/auth/logout.php" class="btn btn-danger btn-sm">Logout</a>
        </div>
    </div>
</nav>