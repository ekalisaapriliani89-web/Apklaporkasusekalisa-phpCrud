<?php
/*
|--------------------------------------------------------------------------
| DETAIL KASUS - LAPOR KASUS SEKALISA
|--------------------------------------------------------------------------
*/

/** @var mysqli $koneksi */

// Ambil ID Kasus dari URL (Mendukung parameter idkasus atau id)
$idkasus = isset($_GET['idkasus']) ? (int) $_GET['idkasus'] : (isset($_GET['id']) ? (int) $_GET['id'] : 0);

$query = "SELECT 
            kasus.*, 
            kategori.namakategori
          FROM kasus
          LEFT JOIN kategori ON kasus.idkategori = kategori.idkategori
          WHERE kasus.idkasus = $idkasus
          LIMIT 1";

$result = mysqli_query($koneksi, $query);
$kasus  = mysqli_fetch_assoc($result);
?>

<section class="py-5 bg-light">

    <div class="container">

        <?php if ($kasus): ?>

            <div class="card border-0 shadow-sm">

                <div class="card-body p-4 p-lg-5">

                    <div class="row align-items-center">

                        <!-- GAMBAR / ILUSTRASI KASUS -->
                        <div class="col-md-5 mb-4 mb-md-0 text-center">

                            <?php 
                            $fotoKasus = !empty($kasus['foto']) ? $kasus['foto'] : 'default.png';
                            $pathFoto  = 'assets/images/kasus/' . $fotoKasus;
                            ?>

                            <img
                                src="<?= $pathFoto; ?>"
                                alt="<?= htmlspecialchars($kasus['namakasus']); ?>"
                                class="img-fluid rounded shadow-sm"
                                style="width:100%; max-height:380px; object-fit:cover;"
                                onerror="this.src='assets/images/kasus/default.png';">

                        </div>

                        <!-- DETAIL INFORMASI KASUS -->
                        <div class="col-md-7">

                            <div class="mb-2">
                                <span class="badge badge-primary px-3 py-2 mr-2">
                                    <i class="fas fa-tag mr-1"></i>
                                    <?= htmlspecialchars($kasus['namakategori'] ?? 'Umum'); ?>
                                </span>

                                <span class="badge badge-danger px-3 py-2">
                                    <i class="fas fa-exclamation-triangle mr-1"></i>
                                    Tingkat Bahaya: <?= htmlspecialchars($kasus['tingkatbahaya'] ?? 'Sedang'); ?>
                                </span>
                            </div>

                            <h1 class="font-weight-bold my-3 text-dark">
                                <?= htmlspecialchars($kasus['namakasus']); ?>
                            </h1>

                            <hr class="my-3">

                            <?php if (!empty($kasus['deskripsi'])): ?>

                                <div class="mb-4">

                                    <h5 class="font-weight-bold text-secondary mb-2">
                                        <i class="fas fa-align-left mr-1"></i> Deskripsi & Penjelasan Kasus
                                    </h5>

                                    <p class="text-muted leading-relaxed">
                                        <?= nl2br(htmlspecialchars($kasus['deskripsi'])); ?>
                                    </p>

                                </div>

                            <?php endif; ?>

                            <!-- TOMBOL AKSI -->
                            <div class="mt-4 pt-2">

                                <a
                                    href="index.php?halaman=daftarkasus"
                                    class="btn btn-secondary btn-lg mr-2 mb-2">

                                    <i class="fas fa-arrow-left mr-1"></i>
                                    Kembali

                                </a>

                                <?php if (isset($_SESSION['idsiswa'])): ?>

                                    <a
                                        href="index.php?halaman=createpengajuan&idkasus=<?= $kasus['idkasus']; ?>"
                                        class="btn btn-primary btn-lg mb-2">

                                        <i class="fas fa-paper-plane mr-1"></i>
                                        Laporkan Kasus Ini

                                    </a>

                                <?php else: ?>

                                    <a
                                        href="index.php?halaman=loginsiswa"
                                        class="btn btn-primary btn-lg mb-2">

                                        <i class="fas fa-sign-in-alt mr-1"></i>
                                        Login Siswa untuk Melapor

                                    </a>

                                <?php endif; ?>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        <?php else: ?>

            <!-- STATUS JIKA DATA TIDAK DITEMUKAN -->
            <div class="text-center py-5">

                <i class="fas fa-folder-open fa-4x text-muted mb-3"></i>

                <h3 class="font-weight-bold">
                    Kasus Tidak Ditemukan
                </h3>

                <p class="text-muted">
                    Data jenis kasus yang Anda cari tidak tersedia atau telah dihapus.
                </p>

                <a
                    href="index.php?halaman=daftarkasus"
                    class="btn btn-primary btn-lg mt-2">

                    <i class="fas fa-arrow-left mr-1"></i>
                    Kembali ke Daftar Kasus

                </a>

            </div>

        <?php endif; ?>

    </div>

</section>