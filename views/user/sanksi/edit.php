<?php
/*
|--------------------------------------------------------------------------
| FORM TAMBAH SANKSI - APLIKASI LAPOR KASUS SEKALISA
|--------------------------------------------------------------------------
*/

/** @var mysqli $koneksi */
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 font-weight-bold">
                    <i class="fas fa-plus-circle text-primary mr-2"></i>Tambah Master Sanksi
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php?halaman=dashboardadmin">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="index.php?halaman=sanksi">Master Sanksi</a></li>
                    <li class="breadcrumb-item active">Tambah Sanksi</li>
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
                    <i class="fas fa-edit mr-1"></i> Form Input Master Sanksi Pelanggaran
                </h3>
            </div>

            <form action="proses/sanksi/simpan.php" method="POST">
                <div class="card-body">
                    <div class="form-group">
                        <label for="namasanksi" class="font-weight-bold">
                            Nama Sanksi <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="namasanksi" id="namasanksi" class="form-control" placeholder="Contoh: Teguran Lisan / Surat Panggilan Orang Tua / Skorsing" required>
                    </div>

                    <div class="form-group">
                        <label for="tingkat" class="font-weight-bold">
                            Tingkat / Bobot Sanksi <span class="text-danger">*</span>
                        </label>
                        <select name="tingkat" id="tingkat" class="form-control" required>
                            <option value="Ringan">Ringan</option>
                            <option value="Sedang" selected>Sedang</option>
                            <option value="Berat">Berat</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="keterangan" class="font-weight-bold">
                            Deskripsi Sanksi
                        </label>
                        <textarea name="keterangan" id="keterangan" rows="4" class="form-control" placeholder="Penjelasan konsekuensi dan prosedur penjatuhan sanksi..."></textarea>
                    </div>
                </div>

                <div class="card-footer bg-light text-right">
                    <a href="index.php?halaman=sanksi" class="btn btn-secondary mr-2">
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