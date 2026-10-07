<?php
session_start();
require_once 'session.php';
checkLogin();

$aksi = $_GET['aksi'] ?? '';

if ($aksi === 'tambah' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $namasanksi = trim($_POST['namasanksi']);
    $bobot      = $_POST['bobot'];
    $keterangan = trim($_POST['keterangan']);

    $stmt = $pdo->prepare("INSERT INTO sanksi (namasanksi, bobot, keterangan) VALUES (:nama, :bobot, :ket)");
    $stmt->execute(['nama' => $namasanksi, 'bobot' => $bobot, 'ket' => $keterangan]);

    header('Location: ../views/user/sanksi/index.php');
    exit;
}

if ($aksi === 'hapus') {
    $id = $_GET['id'] ?? 0;
    $stmt = $pdo->prepare("DELETE FROM sanksi WHERE idsanksi = :id");
    $stmt->execute(['id' => $id]);

    header('Location: ../views/user/sanksi/index.php');
    exit;
}
?>