<?php
/*
|--------------------------------------------------------------------------
| FORM BUAT PENGAJUAN LAPORAN KASUS (SISWA)
|--------------------------------------------------------------------------
*/

/** @var mysqli $koneksi */

// Pastikan siswa sudah login
if (!isset($_SESSION['idsiswa'])) {
    echo "<script>alert('Silakan login terlebih dahulu!'); window.location='index.php?halaman=loginsiswa';</script>";
    exit;
}

// Ambil parameter idkasus jika dikirim melalui tombol landing page
$selected_idkasus = isset($_GET['idkasus']) ? (int) $_GET['idkasus'] : 0;

// Query opsi master kasus
$qKasus = mysqli_query($koneksi, "SELECT k.*, kt.namakategori FROM kasus k LEFT JOIN kategori kt ON k.idkategori = kt.idkategori ORDER BY k.namakasus ASC");
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 font-weight-bold">
                    <i class="fas fa-paper-plane text-primary mr-2"></i>Buat Laporan Baru
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php?halaman=dashboardsiswa">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="index.php?halaman=pengajuan">Status Laporan</a></li>
                    <li class="breadcrumb-item active">Buat Laporan</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">

        <!-- MULAI FORM DI SINI AGAR SEMUA INPUT MASUK DI DALAMNYA -->
        <form action="proses/prosespengajuan.php?aksi=tambah" method="POST" enctype="multipart/form-data">
            
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h3 class="card-title font-weight-bold text-dark m-0">
                        <i class="fas fa-edit mr-1"></i> Form Pengajuan Laporan Kasus
                    </h3>
                </div>

                <div class="card-body">

                    <!-- PILIH KASUS -->
                    <div class="form-group">
                        <label for="idkasus" class="font-weight-bold">
                            Jenis Kasus / Pelanggaran <span class="text-danger">*</span>
                        </label>
                        <select name="idkasus" id="idkasus" class="form-control" required>
                            <option value="">-- Pilih Jenis Kasus --</option>
                            <?php while ($kasus = mysqli_fetch_assoc($qKasus)): ?>
                                <option value="<?= $kasus['idkasus']; ?>" <?= ($selected_idkasus == $kasus['idkasus']) ? 'selected' : ''; ?>>
                                    <?= htmlspecialchars($kasus['namakasus']); ?> (Kategori: <?= htmlspecialchars($kasus['namakategori'] ?? 'Umum'); ?>)
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <!-- TANGGAL KEJADIAN -->
                    <div class="form-group">
                        <label for="tanggalkejadian" class="font-weight-bold">
                            Tanggal & Waktu Kejadian <span class="text-danger">*</span>
                        </label>
                        <input type="datetime-local" 
                               name="tanggalkejadian" 
                               id="tanggalkejadian" 
                               class="form-control" 
                               value="<?= date('Y-m-d\TH:i'); ?>" 
                               required>
                    </div>

                    <!-- LOKASI KEJADIAN -->
                    <div class="form-group">
                        <label for="lokasi" class="font-weight-bold">
                            Lokasi Kejadian <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                               name="lokasi" 
                               id="lokasi" 
                               class="form-control" 
                               placeholder="Misal: Lapangan Olahraga / Kelas 10-A / Kantin" 
                               required>
                    </div>

                    <!-- DESKRIPSI KRONOLOGI (name diubah menjadi 'keterangan' agar cocok dengan file proses) -->
                    <div class="form-group">
                        <label for="keterangan" class="font-weight-bold">
                            Kronologi / Deskripsi Kejadian <span class="text-danger">*</span>
                        </label>
                        <textarea name="keterangan" 
                                  id="keterangan" 
                                  rows="5" 
                                  class="form-control" 
                                  placeholder="Jelaskan secara singkat dan jelas runtutan kejadian..." 
                                  required></textarea>
                    </div>

                    <!-- BUKTI BUKTI (FOTO/FILE) -->
                    <div class="form-group">
                        <label for="bukti" class="font-weight-bold">
                            Bukti Foto / Lampiran Pendukung <small class="text-muted">(Opsional, max 2MB)</small>
                        </label>
                        <input type="file" 
                               name="bukti" 
                               id="bukti" 
                               class="form-control-file" 
                               accept="image/*,.pdf">
                    </div>

                </div>

                <div class="card-footer bg-light text-right">
                    <a href="index.php?halaman=pengajuan" class="btn btn-secondary mr-2">
                        <i class="fas fa-arrow-left mr-1"></i> Batal
                    </a>
                    <button type="submit" name="submit" class="btn btn-primary">
                        <i class="fas fa-paper-plane mr-1"></i> Kirim Laporan
                    </button>
                </div>
            </div>

        </form>
        <!-- PENUTUP FORM DI SINI -->

    </div>
</section>