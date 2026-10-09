<?php
/*
|--------------------------------------------------------------------------
| PROSES PENGAJUAN LAPORAN SISWA - APLIKASI LAPOR KASUS SEKALISA
|--------------------------------------------------------------------------
*/

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$pathKoneksi = __DIR__ . '/../koneksi.php';
if (file_exists($pathKoneksi)) {
    include $pathKoneksi;
} else {
    include 'koneksi.php';
}

/** @var mysqli $koneksi */

$aksi = $_GET['aksi'] ?? 'tambah';

if ($aksi == 'tambah') {
    $idsiswa         = $_SESSION['idsiswa'] ?? 0;
    $iduser          = $_SESSION['iduser'] ?? 0; // Mengambil iduser jika ada di session, default 0
    $idkasus         = (int) ($_POST['idkasus'] ?? 0);
    $tanggalkejadian = mysqli_real_escape_string($koneksi, $_POST['tanggalkejadian'] ?? date('Y-m-d'));
    $tempatkejadian  = mysqli_real_escape_string($koneksi, $_POST['lokasi'] ?? '');
    $kronologi       = mysqli_real_escape_string($koneksi, $_POST['keterangan'] ?? '');

    // Validasi siswa harus login
    if ($idsiswa <= 0) {
        echo "<script>alert('Sesi anda telah habis, silakan login ulang!'); window.location='../index.php?halaman=loginsiswa';</script>";
        exit();
    }

    // Penanganan Upload File / Foto Bukti
    $nama_file_db = '';
    if (isset($_FILES['bukti']) && $_FILES['bukti']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath   = $_FILES['bukti']['tmp_name'];
        $fileName      = $_FILES['bukti']['name'];
        $fileSize      = $_FILES['bukti']['size'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        $allowedExtensions = ['jpg', 'jpeg', 'png', 'pdf'];
        
        if (in_array($fileExtension, $allowedExtensions)) {
            if ($fileSize <= 2 * 1024 * 1024) {
                $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
                $uploadFileDir = __DIR__ . '/../assets/uploads/';
                
                if (!is_dir($uploadFileDir)) {
                    mkdir($uploadFileDir, 0777, true);
                }

                $dest_path = $uploadFileDir . $newFileName;
                if (move_uploaded_file($fileTmpPath, $dest_path)) {
                    $nama_file_db = $newFileName;
                }
            } else {
                echo "<script>alert('Ukuran file terlalu besar! Maksimal 2MB.'); window.location='../index.php?halaman=createpengajuan';</script>";
                exit();
            }
        } else {
            echo "<script>alert('Format file tidak didukung! Hanya format gambar atau PDF.'); window.location='../index.php?halaman=createpengajuan';</script>";
            exit();
        }
    }

    // Query INSERT disesuaikan persis dengan kolom database Anda
    $query = "INSERT INTO pengajuan (idkasus, iduser, idsiswa, kronologi, tempatkejadian, tanggalkejadian, foto) 
              VALUES ('$idkasus', '$iduser', '$idsiswa', '$kronologi', '$tempatkejadian', '$tanggalkejadian', '$nama_file_db')";
    
    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Pengajuan laporan berhasil dikirim!'); window.location='../index.php?halaman=dashboardsiswa';</script>";
        exit();
    } else {
        echo "<script>alert('Gagal mengirim pengajuan laporan: " . mysqli_error($koneksi) . "'); window.location='../index.php?halaman=createpengajuan';</script>";
        exit();
    }
} else {
    header("Location: ../index.php?halaman=dashboardsiswa");
    exit();
}
?>