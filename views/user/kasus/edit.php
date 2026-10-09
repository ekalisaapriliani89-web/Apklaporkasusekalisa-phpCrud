<?php
/*
|--------------------------------------------------------------------------
| FORM TAMBAH MASTER KASUS - APLIKASI LAPOR KASUS SEKALISA
|--------------------------------------------------------------------------
*/

/** @var mysqli $koneksi */

// Query opsi kategori kasus
$qKategori = mysqli_query($koneksi, "SELECT * FROM kategori ORDER BY namakategori ASC");
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 font-weight-bold">
                    <i class="fas fa-plus-circle text-primary mr-2"></i>Tambah Data Kasus
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php?halaman=dashboardadmin">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="index.php?halaman=kasus">Master Kasus</a></li>
                    <li class="breadcrumb-item active">Tambah Kasus</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">

        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <h3 class="card-title font-weight-bold text-dark m-0">
                    <i class="fas fa-edit mr-1"></i> Form Input Master Kasus Pelanggaran
                </h3>
            </div>

            <form action="proses/kasus/simpan.php" method="POST" enctype="multipart/form-data">
                <div class="card-body">

                    <!-- NAMA KASUS -->
                    <div class="form-group">
                        <label for="namakasus" class="font-weight-bold">
                            Nama Kasus / Pelanggaran <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="namakasus" id="namakasus" class="form-control" placeholder="Contoh: Merokok di Lingkungan Sekolah / Membolos" required>
                    </div>

                    <!-- KATEGORI KASUS -->
                    <div class="form-group">
                        <label for="idkategori" class="font-weight-bold">
                            Kategori Kasus <span class="text-danger">*</span>
                        </label>
                        <select name="idkategori" id="idkategori" class="form-control" required>
                            <option value="">-- Pilih Kategori --</option>
                            <?php while ($k = mysqli_fetch_assoc($qKategori)): ?>
                                <option value="<?= $k['idkategori']; ?>">
                                    <?= htmlspecialchars($k['namakategori']); ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <!-- TINGKAT BAHAYA -->
                    <div class="form-group">
                        <label for="tingkatbahaya" class="font-weight-bold">
                            Tingkat Bahaya / Bobot <span class="text-danger">*</span>
                        </label>
                        <select name="tingkatbahaya" id="tingkatbahaya" class="form-control" required>
                            <option value="Ringan">Ringan</option>
                            <option value="Sedang" selected>Sedang</option>
                            <option value="Berat">Berat / Tinggi</option>
                        </select>
                    </div>

                    <!-- KETERANGAN KASUS -->
                    <div class="form-group">
                        <label for="keterangan" class="font-weight-bold">
                            Deskripsi / Keterangan Tambahan
                        </label>
                        <textarea name="keterangan" id="keterangan" rows="4" class="form-control" placeholder="Penjelasan rincian indikasi atau dampak kasus..."></textarea>
                    </div>

                    <!-- FOTO / ILUSTRASI KASUS -->
                    <div class="form-group">
                        <label for="foto" class="font-weight-bold">
                            Foto / Gambar Kasus <small class="text-muted">(Opsional, max 2MB)</small>
                        </label>
                        <input type="file" name="foto" id="foto" class="form-control-file" accept="image/*">
                    </div>

                </div>

                <div class="card-footer bg-light text-right">
                    <a href="index.php?halaman=kasus" class="btn btn-secondary mr-2">
                        <i class="fas fa-arrow-left mr-1"></i> Batal
                    </a>
                    <button type="submit" name="submit" class="btn btn-primary">
                        <i class="fas fa-save mr-1"></i> Simpan Data
                    </button>
                </div>
            </form>
        </div>

    </div>
</section>