<?php
session_start();
require_once 'session.php';
checkLogin();

$aksi = $_GET['aksi'] ?? '';

if ($aksi === 'tambah' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $namakategori = trim($_POST['namakategori']);
    $deskripsi    = trim($_POST['deskripsi']);

    $stmt = $pdo->prepare("INSERT INTO kategori (namakategori, deskripsi) VALUES (:nama, :desk)");
    $stmt->execute(['nama' => $namakategori, 'desk' => $deskripsi]);

    header('Location: ../views/user/kategori/index.php');
    exit;
}

if ($aksi === 'hapus') {
    $id = $_GET['id'] ?? 0;
    $stmt = $pdo->prepare("DELETE FROM kategori WHERE idkategori = :id");
    $stmt->execute(['id' => $id]);

    header('Location: ../views/user/kategori/index.php');
    exit;
}
?>