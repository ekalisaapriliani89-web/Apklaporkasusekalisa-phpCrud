<?php
require_once 'proses/koneksi.php';
require_once 'proses/session.php';

/*
|--------------------------------------------------------------------------
| ROUTING UTAMA
|--------------------------------------------------------------------------
*/
$halaman = $_GET['halaman'] ?? 'home';

/*
|--------------------------------------------------------------------------
| HALAMAN AUTH
|--------------------------------------------------------------------------
*/
$authPages = [
    'loginuser',
    'loginsiswa',
    'registersiswa'
];

/*
|--------------------------------------------------------------------------
| HALAMAN LANDING (PUBLIC)
|--------------------------------------------------------------------------
*/
$landingPages = [
    'home',
    'daftarkasus',
    'detilkasus',
    'daftarkategori',
    'tentang',
    'kontak',
    'panduan'
];

include 'views/component/header.php';
?>

<!-- ==================================================================== -->
<!-- BODY DINAMIS SESUAI ROLE: TAMU / PUBLIC, SISWA, PETUGAS, MAUPUN ADMIN -->
<!-- ==================================================================== -->
<?php
$isPublic =
    in_array($halaman, $landingPages) ||
    in_array($halaman, $authPages) ||
    $halaman === 'logout';

if ($isPublic) {
    $bodyClass = 'hold-transition layout-top-nav';
} else {
    $bodyClass = 'hold-transition sidebar-mini layout-fixed';
}
?>

<body class="<?= $bodyClass; ?>">

<?php
/*
|--------------------------------------------------------------------------
| LOGOUT
|--------------------------------------------------------------------------
*/
if ($halaman === 'logout') {
    include 'views/auth/logout.php';
}

/*
|--------------------------------------------------------------------------
| ZONA TAMU / PUBLIC + AUTH
|--------------------------------------------------------------------------
*/
elseif (
    in_array($halaman, $landingPages) ||
    in_array($halaman, $authPages)
) {
?>
<div class="wrapper">
    <?php include 'views/component/tamu/navbar.php'; ?>
    <?php
    if (in_array($halaman, $authPages)) {
        if (file_exists("views/auth/{$halaman}.php")) {
            include "views/auth/{$halaman}.php";
        } else {
            include "views/errors/404.php";
        }
    } else {
        if (file_exists("views/landing/{$halaman}.php")) {
            include "views/landing/{$halaman}.php";
        } else {
            include "views/errors/404.php";
        }
    }
    ?>
    <?php include 'views/component/tamu/footer.php'; ?>
</div>
<?php
}

/*
|--------------------------------------------------------------------------
| ZONA USER (ADMIN / PETUGAS)
|--------------------------------------------------------------------------
*/
elseif (isset($_SESSION['iduser'])) {
?>
<div class="wrapper">
    <?php include 'views/component/user/navbar.php'; ?>
    <?php
    $sidebar =
        (($_SESSION['role'] ?? '') === 'admin')
        ? 'sidebaradmin.php'
        : 'sidebarpetugas.php';
    include "views/component/user/{$sidebar}";
    ?>

    <div class="content-wrapper p-3">
        <?php
        switch ($halaman) {
            /*
            ==================================================
            DASHBOARD USER
            ==================================================
            */
            case 'dashboardadmin':
                cekAdmin();
                include 'views/user/dashboard/dashboardadmin.php';
                break;
            case 'dashboardpetugas':
                cekPetugasOrAdmin();
                include 'views/user/dashboard/dashboardpetugas.php';
                break;

            /*
            ==================================================
            MANAJEMEN USER (KHUSUS ADMIN - FITUR 8)
            ==================================================
            */
            case 'user':
            case 'createuser':
            case 'edituser':
            case 'showuser':
                cekAdmin(); // Blokir Petugas yang mencoba akses via URL
                $file = str_replace('user', '', $halaman);
                $file = empty($file) ? 'index' : $file;
                include "views/user/user/{$file}.php";
                break;

            /*
            ==================================================
            DATA PELAPOR (FITUR 9 & 12)
            ==================================================
            */
            case 'pelapor':
            case 'createpelapor':
            case 'editpelapor':
            case 'showpelapor':
                $file = str_replace('pelapor', '', $halaman);
                $file = empty($file) ? 'index' : $file;
                include "views/user/pelapor/{$file}.php";
                break;

            /*
            ==================================================
            MASTER SISWA
            ==================================================
            */
            case 'siswa':
            case 'createsiswa':
            case 'editsiswa':
            case 'showsiswa':
                $file = str_replace('siswa', '', $halaman);
                $file = empty($file) ? 'index' : $file;
                include "views/user/siswa/{$file}.php";
                break;

            /*
            ==================================================
            KATEGORI KASUS
            ==================================================
            */
            case 'kategori':
            case 'createkategori':
            case 'editkategori':
            case 'showkategori':
                $file = str_replace('kategori', '', $halaman);
                $file = empty($file) ? 'index' : $file;
                include "views/user/kategori/{$file}.php";
                break;

            /*
            ==================================================
            MASTER KASUS (FITUR 10)
            ==================================================
            */
            case 'kasus':
            case 'createkasus':
            case 'editkasus':
            case 'showkasus':
                $file = str_replace('kasus', '', $halaman);
                $file = empty($file) ? 'index' : $file;
                include "views/user/kasus/{$file}.php";
                break;

            /*
            ==================================================
            MASTER SANKSI (FITUR 11)
            ==================================================
            */
            case 'sanksi':
            case 'createsanksi':
            case 'editsanksi':
            case 'showsanksi':
                $file = str_replace('sanksi', '', $halaman);
                $file = empty($file) ? 'index' : $file;
                include "views/user/sanksi/{$file}.php";
                break;

            /*
            ==================================================
            PENANGANAN KASUS (FITUR 14)
            ==================================================
            */
            case 'penanganan':
            case 'createpenanganan':
            case 'editpenanganan':
            case 'showpenanganan':
                $file = str_replace('penanganan', '', $halaman);
                $file = empty($file) ? 'index' : $file;
                include "views/user/penanganan/{$file}.php";
                break;

            /*
            ==================================================
            REKAP LAPORAN (FITUR 6)
            ==================================================
            */
            case 'laporanharian':
            case 'cetaklaporanharian':
            case 'laporanbulanan':
            case 'cetaklaporanbulanan':
            case 'laporantahunan':
            case 'cetaklaporantahunan':
                include "views/user/laporan/{$halaman}.php";
                break;

            /*
            ==================================================
            ERROR HANDLING
            ==================================================
            */
            case '403':
                include 'views/errors/403.php';
                break;

            default:
                include 'views/errors/404.php';
                break;
        }
        ?>
    </div>
    <?php include 'views/component/user/footer.php'; ?>
</div>
<?php
}

/*
|--------------------------------------------------------------------------
| ZONA SISWA / PELAPOR (LOGIN SISWA)
|--------------------------------------------------------------------------
*/
elseif (isset($_SESSION['idsiswa'])) {
?>
<div class="wrapper">
    <?php include 'views/component/siswa/navbar.php'; ?>
    <?php include 'views/component/siswa/sidebar.php'; ?>

    <div class="content-wrapper p-3">
        <?php
        switch ($halaman) {
           case 'dashboardsiswa':
    include 'views/user/dashboard/dashboardsiswa.php';
    break;

            case 'profil':
                include 'views/siswa/profil.php';
                break;

            case 'pengajuan':
                include 'views/siswa/pengajuan/index.php';
                break;

            case 'createpengajuan':
                include 'views/siswa/pengajuan/create.php';
                break;

            case 'riwayatkasus':
                include 'views/siswa/riwayatkasus.php';
                break;

            default:
                include 'views/errors/404.php';
                break;
        }
        ?>
    </div>
    <?php include 'views/component/siswa/footer.php'; ?>
</div>
<?php
}

/*
|--------------------------------------------------------------------------
| ERROR 404 / UNAUTHORIZED
|--------------------------------------------------------------------------
*/
else {
?>
<div class="wrapper">
    <?php include 'views/component/tamu/navbar.php'; ?>
    <?php include 'views/errors/404.php'; ?>
    <?php include 'views/component/tamu/footer.php'; ?>
</div>
<?php
}

include 'views/component/footerjs.php';
?>
</body>
</html>