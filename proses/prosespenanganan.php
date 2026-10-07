<?php
session_start();
require_once 'session.php';
checkLogin();

$aksi = $_GET['aksi'] ?? '';

if ($aksi === 'proses' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $idpengajuan   = $_POST['idpengajuan'];
    $iduser        = $_SESSION['iduser'];
    $idsanksi      = $_POST['idsanksi'];
    $tglpenanganan = $_POST['tglpenanganan'];
    $catatan       = trim($_POST['catatan']);
    $status        = $_POST['status'];

    // Simpan penanganan
    $stmtPen = $pdo->prepare("INSERT INTO penanganan (idpengajuan, iduser, idsanksi, tglpenanganan, catatan) 
                              VALUES (:idpengajuan, :iduser, :idsanksi, :tgl, :catatan)");
    $stmtPen->execute([
        'idpengajuan' => $idpengajuan,
        'iduser'      => $iduser,
        'idsanksi'    => $idsanksi,
        'tgl'         => $tglpenanganan,
        'catatan'     => $catatan
    ]);

    // Update status pengajuan
    $stmtUpd = $pdo->prepare("UPDATE pengajuan SET status = :status WHERE idpengajuan = :id");
    $stmtUpd->execute(['status' => $status, 'id' => $idpengajuan]);

    header('Location: ../views/user/penanganan/index.php');
    exit;
}
?>