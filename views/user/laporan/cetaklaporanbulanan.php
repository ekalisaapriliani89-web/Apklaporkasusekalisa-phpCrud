<?php
// Inisialisasi koneksi dengan pengecekan path aman
$pathKoneksi = __DIR__ . '/../../../koneksi.php';
if (file_exists($pathKoneksi)) {
    include $pathKoneksi;
} else {
    include '../../../koneksi.php';
}

/** @var mysqli $koneksi */

// Ambil parameter bulan dan tahun (cast ke integer)
$bulan = isset($_GET['bulan']) ? (int)$_GET['bulan'] : (int)date('m');
$tahun = isset($_GET['tahun']) ? (int)$_GET['tahun'] : (int)date('Y');

// Array Nama Bulan Bahasa Indonesia
$namaBulan = [
    1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
    5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
    9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
];

$teksBulan = $namaBulan[$bulan] ?? date('F');

// Query data pengajuan kasus bulanan
$query = "SELECT p.*, s.namasiswa, s.nisn, s.kelas, k.namakasus, kt.namakategori
          FROM pengajuan p
          LEFT JOIN siswa s ON p.idsiswa = s.idsiswa
          LEFT JOIN kasus k ON p.idkasus = k.idkasus
          LEFT JOIN kategori kt ON k.idkategori = kt.idkategori
          WHERE MONTH(p.tanggalkejadian) = $bulan AND YEAR(p.tanggalkejadian) = $tahun
          ORDER BY p.idpengajuan DESC";

$result = mysqli_query($koneksi, $query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Laporan Bulanan Kasus - <?= $teksBulan; ?> <?= $tahun; ?></title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; margin: 20px; }
        .text-center { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        table, th, td { border: 1px solid #333; padding: 6px 8px; }
        th { background-color: #f2f2f2; text-align: center; }
    </style>
</head>
<body onload="window.print()">

    <div class="text-center">
        <h2 style="margin-bottom: 5px;">LAPORAN BULANAN PENGAJUAN KASUS SISWA</h2>
        <h3 style="margin-top: 0; font-weight: normal;">APLIKASI LAPOR KASUS SEKALISA</h3>
        <p><strong>Periode:</strong> <?= $teksBulan; ?> <?= $tahun; ?></p>
    </div>
    <hr style="border: 1px solid #000;">

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="15%">Tanggal</th>
                <th>Nama Siswa</th>
                <th width="10%">Kelas</th>
                <th>Jenis Kasus / Pelanggaran</th>
                <th width="15%">Kategori</th>
                <th width="12%">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result && mysqli_num_rows($result) > 0): ?>
                <?php $no = 1; while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td class="text-center"><?= $no++; ?></td>
                        <td class="text-center"><?= date('d/m/Y', strtotime($row['tanggalkejadian'] ?? 'now')); ?></td>
                        <td><?= htmlspecialchars($row['namasiswa'] ?? 'Siswa'); ?></td>
                        <td class="text-center"><?= htmlspecialchars($row['kelas'] ?? '-'); ?></td>
                        <td><?= htmlspecialchars($row['namakasus'] ?? 'Umum'); ?></td>
                        <td><?= htmlspecialchars($row['namakategori'] ?? 'Umum'); ?></td>
                        <td class="text-center"><?= htmlspecialchars($row['status'] ?? 'Pending'); ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" class="text-center" style="padding: 20px;">
                        <em>Tidak ada data laporan pengajuan kasus pada periode bulan ini.</em>
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div style="margin-top: 30px; float: right; text-align: center; width: 200px;">
        <p>Dicetak Pada: <?= date('d/m/Y'); ?></p>
        <br><br><br>
        <p><strong>( Petugas BK / Admin )</strong></p>
    </div>

</body>
</html>