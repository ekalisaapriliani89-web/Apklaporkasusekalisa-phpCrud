<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 1. Definisi fungsi cekAdmin
function cekAdmin() {
    if (!isset($_SESSION['iduser']) || ($_SESSION['role'] ?? '') !== 'admin') {
        header("Location: index.php?halaman=403");
        exit();
    }
}

// 2. Definisi fungsi cekPetugasOrAdmin
function cekPetugasOrAdmin() {
    if (!isset($_SESSION['iduser'])) {
        header("Location: index.php?halaman=loginuser");
        exit();
    }
}

// 3. Definisi fungsi cekSiswa
function cekSiswa() {
    if (!isset($_SESSION['idsiswa'])) {
        header("Location: index.php?halaman=loginsiswa");
        exit();
    }
}
?>