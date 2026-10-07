<?php
session_start();
require_once 'session.php';
checkLogin();

$aksi = $_GET['aksi'] ?? '';

if ($aksi === 'tambah' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $idkategori = $_POST['idkategori'];
    $namakasus  = trim($_POST['namakasus']);
    $deskripsi  = trim($_POST['deskripsi']);

    $stmt = $pdo->prepare("INSERT INTO kasus (idkategori, namakasus, deskripsi) VALUES (:idkategori, :nama, :desk)");
    $stmt->execute(['idkategori' => $idkategori, 'nama' => $namakasus, 'desk' => $deskripsi]);

    header('Location: ../views/user/kasus/index.php');
    exit;
}

if ($aksi === 'hapus') {
    $id = $_GET['id'] ?? 0;
    $stmt = $pdo->prepare("DELETE FROM kasus WHERE idkasus = :id");
    $stmt->execute(['id' => $id]);

    header('Location: ../views/user/kasus/index.php');
    exit;
}
?>