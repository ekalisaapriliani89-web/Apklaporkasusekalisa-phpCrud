<?php
/*
|--------------------------------------------------------------------------
| FORM EDIT MASTER KASUS - APLIKASI LAPOR KASUS SEKALISA
|--------------------------------------------------------------------------
*/

/** @var mysqli $koneksi */

$idkasus = isset($_GET['id']) ? (int) $_GET['id'] : 0;

// Query data kasus berdasarkan ID
$qKasus = mysqli_query($koneksi, "SELECT * FROM kasus WHERE idkasus = '$idkasus' LIMIT 1");
$kasus = mysqli_fetch_assoc($qKasus);

if (!$kasus) {
    echo "<script>alert('Data kasus tidak ditemukan!'); window.location='index.php?halaman=kasus';</script>";
    exit;
}

// Query opsi kategori kasus
$qKategori = mysqli_query($koneksi, "SELECT * FROM kategori ORDER BY namakategori ASC");
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 font-weight-bold">
                    <i class="fas fa-edit text-warning mr-2"></i>Edit Data Kasus
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php?halaman=dashboardadmin">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="index.php?halaman=kasus">Master Kasus</a></li>
                    <li class="breadcrumb-item active">Edit Kasus</li>
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
                    <i class="fas fa-pen mr-1"></i> Edit Data Kasus #<?= $kasus['idkasus']; ?>
                </h3>
            </div>

            <form action="proses/kasus/update.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="idkasus" value="<?= $kasus['idkasus']; ?>">
                <input type="hidden" name="fotolama" value="<?= $kasus['foto']; ?>">

                <div class="card-body">

                    <!-- NAMA KASUS -->
                    <div class="form-group">
                        <label for="namakasus" class="font-weight-bold">
                            Nama Kasus / Pelanggaran <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="namakasus" id="namakasus" class="form-control" value="<?= htmlspecialchars($kasus['namakasus']); ?>" required>
                    </div>

                    <!-- KATEGORI KASUS -->
                    <div class="form-group">
                        <label for="idkategori" class="font-weight-bold">
                            Kategori Kasus <span class="text-danger">*</span>
                        </label>
                        <select name="idkategori" id="idkategori" class="form-control" required>
                            <option value="">-- Pilih Kategori --</option>
                            <?php while ($k = mysqli_fetch_assoc($qKategori)): ?>
                                <option value="<?= $k['idkategori']; ?>" <?= ($kasus['idkategori'] == $k['idkategori']) ? 'selected' : ''; ?>>
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
                            <option value="Ringan" <?= ($kasus['tingkatbahaya'] == 'Ringan') ? 'selected' : ''; ?>>Ringan</option>
                            <option value="Sedang" <?= ($kasus['tingkatbahaya'] == 'Sedang') ? 'selected' : ''; ?>>Sedang</option>
                            <option value="Berat" <?= ($kasus['tingkatbahaya'] == 'Berat') ? 'selected' : ''; ?>>Berat / Tinggi</option>
                        </select>
                    </div>

                    <!-- KETERANGAN KASUS -->
                    <div class="form-group">
                        <label for="keterangan" class="font-weight-bold">
                            Deskripsi / Keterangan Tambahan
                        </label>
                        <textarea name="keterangan" id="keterangan" rows="4" class="form-control"><?= htmlspecialchars($kasus['keterangan'] ?? ''); ?></textarea>
                    </div>

                    <!-- FOTO KASUS -->
                    <div class="form-group">
                        <label for="foto" class="font-weight-bold">
                            Ganti Foto Kasus <small class="text-muted">(Biarkan kosong jika tidak diganti)</small>
                        </label>
                        <div class="mb-2">
                            <?php $foto = !empty($kasus['foto']) ? $kasus['foto'] : 'default.png'; ?>
                            <img src="assets/images/kasus/<?= $foto; ?>" alt="Foto Kasus" class="img-thumbnail" style="width: 100px; height: 100px; object-fit: cover;">
                        </div>
                        <input type="file" name="foto" id="foto" class="form-control-file" accept="image/*">
                    </div>

                </div>

                <div class="card-footer bg-light text-right">
                    <a href="index.php?halaman=kasus" class="btn btn-secondary mr-2">
                        <i class="fas fa-arrow-left mr-1"></i> Batal
                    </a>
                    <button type="submit" name="submit" class="btn btn-warning text-white">
                        <i class="fas fa-sync-alt mr-1"></i> Update Data
                    </button>
                </div>
            </form>
        </div>

    </div>
</section>