<?php
/*
|--------------------------------------------------------------------------
| DAFTAR KATEGORI KASUS - LAPOR KASUS SEKALISA
|--------------------------------------------------------------------------
*/

/** @var mysqli $koneksi */

// Query untuk mengambil seluruh kategori beserta jumlah kasus di dalamnya
$queryKategori = "SELECT 
                    kategori.*, 
                    COUNT(kasus.idkasus) AS total_kasus
                  FROM kategori
                  LEFT JOIN kasus ON kategori.idkategori = kasus.idkategori
                  GROUP BY kategori.idkategori
                  ORDER BY kategori.namakategori ASC";

$resultKategori = mysqli_query($koneksi, $queryKategori);
?>

<section class="py-5 bg-light">

    <div class="container">

        <!-- HEADER DAFTAR KATEGORI -->
        <div class="text-center mb-5">
            <span class="badge badge-primary px-3 py-2 mb-3">
                KATEGORI PELANGGARAN
            </span>

            <h1 class="font-weight-bold">
                Daftar Kategori Kasus
            </h1>

            <p class="lead text-muted">
                Pilih kategori untuk melihat jenis kasus pelanggaran yang ditangani di sekolah.
            </p>
        </div>

        <!-- GRID KATEGORI -->
        <div class="row">

            <?php if ($resultKategori && mysqli_num_rows($resultKategori) > 0): ?>

                <?php while ($row = mysqli_fetch_assoc($resultKategori)): ?>

                    <div class="col-md-6 col-lg-4 mb-4">

                        <div class="card h-100 border-0 shadow-sm hover-shadow transition">

                            <div class="card-body p-4 text-center d-flex flex-column">

                                <div class="mb-3">
                                    <span class="bg-light-primary p-3 rounded-circle d-inline-block">
                                        <i class="fas fa-tags fa-2x text-primary"></i>
                                    </span>
                                </div>

                                <h4 class="font-weight-bold text-dark mb-2">
                                    <?= htmlspecialchars($row['namakategori']); ?>
                                </h4>

                                <p class="text-muted small mb-3">
                                    <i class="fas fa-folder-open text-info mr-1"></i>
                                    <strong><?= $row['total_kasus']; ?></strong> Jenis Kasus Terdaftar
                                </p>

                                <?php if (!empty($row['keterangan'])): ?>
                                    <p class="text-muted small mb-4">
                                        <?= htmlspecialchars($row['keterangan']); ?>
                                    </p>
                                <?php endif; ?>

                                <div class="mt-auto">
                                    <a
                                        href="index.php?halaman=detilkategori&idkategori=<?= $row['idkategori']; ?>"
                                        class="btn btn-outline-primary btn-block">

                                        <i class="fas fa-list-ul mr-1"></i>
                                        Lihat Kasus Kategori Ini

                                    </a>
                                </div>

                            </div>

                        </div>

                    </div>

                <?php endwhile; ?>

            <?php else: ?>

                <!-- STATUS JIKA KATEGORI KOSONG -->
                <div class="col-12">
                    <div class="alert alert-info text-center p-4">
                        <i class="fas fa-info-circle fa-2x mb-2 d-block"></i>
                        Belum ada kategori kasus yang ditambahkan oleh Admin.
                    </div>
                </div>

            <?php endif; ?>

        </div>

        <!-- TOMBOL KEMBALI TO HOME -->
        <div class="text-center mt-4">
            <a href="index.php?halaman=home" class="btn btn-secondary btn-lg">
                <i class="fas fa-arrow-left mr-1"></i>
                Kembali ke Beranda
            </a>
        </div>

    </div>

</section>