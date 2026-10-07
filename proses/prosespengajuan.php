<?php
session_start();
require_once 'session.php';
checkSiswaOnly();

$aksi = $_GET['aksi'] ?? '';

if ($aksi === 'tambah' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $idsiswa      = $_SESSION['idsiswa'];
    $idkasus      = $_POST['idkasus'];
    $tglpengajuan = $_POST['tglpengajuan'];
    $keterangan   = trim($_POST['keterangan']);
    $fotoName     = 'default.png';

    if (isset($_FILES['foto']['name']) && $_FILES['foto']['name'] !== '') {
        $fotoName = time() . '_' . $_FILES['foto']['name'];
        $target   = '../assets/images/pengajuan/' . $fotoName;
        move_uploaded_file($_FILES['foto']['tmp_name'], $target);
    }

    $stmt = $pdo->prepare("INSERT INTO pengajuan (idsiswa, idkasus, tglpengajuan, keterangan, foto, status) 
                           VALUES (:idsiswa, :idkasus, :tgl, :ket, :foto, 'pending')");
    $stmt->execute([
        'idsiswa' => $idsiswa,
        'idkasus' => $idkasus,
        'tgl'     => $tglpengajuan,
        'ket'     => $keterangan,
        'foto'    => $fotoName
    ]);

    header('Location: ../views/siswa/riwayatkasus.php');
    exit;
}
?>