<?php
/*
|--------------------------------------------------------------------------
| DAFTAR KASUS - LAPOR KASUS SEKALISA
|--------------------------------------------------------------------------
*/

/** @var mysqli $koneksi */

// Query untuk mengambil seluruh data kasus beserta nama kategorinya
$query = "SELECT kasus.*, kategori.namakategori
          FROM kasus
          LEFT JOIN kategori ON kasus.idkategori = kategori.idkategori
          ORDER BY kasus.idkasus DESC";

$result = mysqli_query($koneksi, $query);
?>

<section class="py-5 bg-light">

    <div class="container">

        <!-- HEADER DAFTAR KASUS -->
        <div class="text-center mb-5">
            <span class="badge badge-primary px-3 py-2 mb-3">
                KATALOG PELANGGARAN
            </span>

            <h1 class="font-weight-bold">
                Daftar Jenis Kasus
            </h1>

            <p class="text-muted mb-0">
                Informasi jenis kasus dan pelanggaran yang ditangani di Aplikasi Lapor Kasus Sekalisa.
            </p>
        </div>

        <!-- GRID KASUS -->
        <div class="row">

            <?php if ($result && mysqli_num_rows($result) > 0): ?>

                <?php while ($kasus = mysqli_fetch_assoc($result)): ?>

                    <div class="col-md-6 col-lg-4 mb-4">

                        <div class="card h-100 shadow-sm border-0">

                            <?php 
                            $fotoKasus = !empty($kasus['foto']) ? $kasus['foto'] : 'default.png';
                            $pathFoto  = 'assets/images/kasus/' . $fotoKasus;
                            ?>

                            <img
                                src="<?= $pathFoto; ?>"
                                class="card-img-top"
                                alt="<?= htmlspecialchars($kasus['namakasus']); ?>"
                                style="height:220px; object-fit:cover;"
                                onerror="this.src='assets/images/kasus/default.png';">

                            <div class="card-body d-flex flex-column">

                                <h5 class="card-title font-weight-bold text-dark mb-2">
                                    <?= htmlspecialchars($kasus['namakasus']); ?>
                                </h5>

                                <p class="text-muted mb-2 small">
                                    <i class="fas fa-tag text-primary mr-1"></i>
                                    <strong>Kategori:</strong> <?= htmlspecialchars($kasus['namakategori'] ?? 'Umum'); ?>
                                </p>

                                <p class="text-muted mb-3 small">
                                    <i class="fas fa-exclamation-triangle text-danger mr-1"></i>
                                    <strong>Tingkat Bahaya:</strong> 
                                    <span class="badge badge-danger">
                                        <?= htmlspecialchars($kasus['tingkatbahaya'] ?? 'Sedang'); ?>
                                    </span>
                                </p>

                                <div class="mt-auto pt-2">
                                    <a
                                        href="index.php?halaman=detilkasus&idkasus=<?= $kasus['idkasus']; ?>"
                                        class="btn btn-primary btn-block">

                                        <i class="fas fa-eye mr-1"></i>
                                        Lihat Detail Kasus

                                    </a>
                                </div>

                            </div>

                        </div>

                    </div>

                <?php endwhile; ?>

            <?php else: ?>

                <!-- ALERT JIKA DATA KOSONG -->
                <div class="col-12">
                    <div class="alert alert-info text-center p-4">
                        <i class="fas fa-info-circle fa-2x mb-2 d-block"></i>
                        Belum ada data jenis kasus yang tersedia saat ini.
                    </div>
                </div>

            <?php endif; ?>

        </div>

        <!-- TOMBOL KEMBALI -->
        <div class="text-center mt-4">
            <a href="index.php?halaman=home" class="btn btn-secondary btn-lg">
                <i class="fas fa-arrow-left mr-1"></i>
                Kembali ke Beranda
            </a>
        </div>

    </div>

</section>