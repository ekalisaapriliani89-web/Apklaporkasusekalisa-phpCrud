<?php
// proses/session.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/koneksi.php';

function checkLogin() {
    if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {
        header('Location: /apklaporkasusekalisa/views/auth/loginuser.php');
        exit;
    }
}

function checkAdminOnly() {
    checkLogin();
    if ($_SESSION['role'] !== 'admin') {
        header('Location: /apklaporkasusekalisa/views/errors/403.php');
        exit;
    }
}

function checkSiswaOnly() {
    if (!isset($_SESSION['is_siswa_logged_in']) || $_SESSION['is_siswa_logged_in'] !== true) {
        header('Location: /apklaporkasusekalisa/views/auth/loginsiswa.php');
        exit;
    }
}
?>