function cekAdmin() {
    if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
        include 'views/errors/403.php'; // atau redirect/die
        exit();
    }
}

function cekPetugas() {
    if (!isset($_SESSION['role']) || ($_SESSION['role'] !== 'petugas' && $_SESSION['role'] !== 'admin')) {
        include 'views/errors/403.php';
        exit();
    }
}