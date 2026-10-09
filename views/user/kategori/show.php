<?php
/*
|--------------------------------------------------------------------------
| FORM EDIT KATEGORI KASUS - APLIKASI LAPOR KASUS SEKALISA
|--------------------------------------------------------------------------
*/

/** @var mysqli $koneksi */

$idkategori = isset($_GET['id']) ? (int) $_GET['id'] : 0;

// Query data kategori berdasarkan ID
$qKategori = mysqli_query($koneksi, "SELECT * FROM kategori WHERE idkategori = '$idkategori' LIMIT 1");
$kategori  = mysqli_fetch_assoc($qKategori);

if (!$kategori) {
    echo "<script>alert('Data kategori tidak ditemukan!'); window.location='index.php?halaman=kategori';</script>";
    exit;
}
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 font-weight-bold">
                    <i class="fas fa-edit text-warning mr-2"></i>Edit Kategori Kasus
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php?halaman=dashboardadmin">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="index.php?halaman=kategori">Kategori Kasus</a></li>
                    <li class="breadcrumb-item active">Edit Kategori</li>
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
                    <i class="fas fa-pen mr-1"></i> Edit Data Kategori #<?= $kategori['idkategori']; ?>
                </h3>
            </div>

            <form action="proses/kategori/update.php" method="POST">
                <input type="hidden" name="idkategori" value="<?= $kategori['idkategori']; ?>">

                <div class="card-body">

                    <!-- NAMA KATEGORI -->
                    <div class="form-group">
                        <label for="namakategori" class="font-weight-bold">
                            Nama Kategori Kasus <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="namakategori" id="namakategori" class="form-control" value="<?= htmlspecialchars($kategori['namakategori']); ?>" required>
                    </div>

                    <!-- KETERANGAN KATEGORI -->
                    <div class="form-group">
                        <label for="keterangan" class="font-weight-bold">
                            Deskripsi / Keterangan Kategori
                        </label>
                        <textarea name="keterangan" id="keterangan" rows="4" class="form-control"><?= htmlspecialchars($kategori['keterangan'] ?? ''); ?></textarea>
                    </div>

                </div>

                <div class="card-footer bg-light text-right">
                    <a href="index.php?halaman=kategori" class="btn btn-secondary mr-2">
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