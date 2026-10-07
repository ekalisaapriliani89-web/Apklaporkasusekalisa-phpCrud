<?php
session_start();
require_once 'session.php';
checkAdminOnly();

$aksi = $_GET['aksi'] ?? '';

if ($aksi === 'tambah' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $namauser = trim($_POST['namauser']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $role     = $_POST['role'];

    $stmt = $pdo->prepare("INSERT INTO user (namauser, username, password, role, foto) VALUES (:nama, :user, :pass, :role, 'default.png')");
    $stmt->execute(['nama' => $namauser, 'user' => $username, 'pass' => $password, 'role' => $role]);

    header('Location: ../views/user/user/index.php');
    exit;
}

if ($aksi === 'hapus') {
    $id = $_GET['id'] ?? 0;
    $stmt = $pdo->prepare("DELETE FROM user WHERE iduser = :id");
    $stmt->execute(['id' => $id]);

    header('Location: ../views/user/user/index.php');
    exit;
}
?>