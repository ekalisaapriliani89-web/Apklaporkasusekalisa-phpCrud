<?php
require_once 'proses/koneksi.php';
require_once 'proses/helper.php';
require_once 'proses/session.php';

/*
|--------------------------------------------------------------------------
| ROUTING UTAMA
|--------------------------------------------------------------------------
*/
$halaman = $_GET['halaman'] ?? 'home';

/*
|--------------------------------------------------------------------------
| HALAMAN AUTH & PUBLIC
|--------------------------------------------------------------------------
*/
$authPages = ['loginuser', 'loginsiswa', 'registersiswa'];

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

$isPublic = in_array($halaman, $landingPages) || in_array($halaman, $authPages) || $halaman === 'logout';
$bodyClass = $isPublic ? 'hold-transition layout-top-nav' : 'hold-transition sidebar-mini layout-fixed';
?>

<body class="<?= $bodyClass; ?>">

<?php
/*
|--------------------------------------------------------------------------
| LOGOUT & ZONA TAMU / PUBLIC
|--------------------------------------------------------------------------
*/
if ($halaman === 'logout') {
    include 'views/auth/logout.php';
} 
elseif ($isPublic) {
?>
<div class="wrapper">
    <?php include 'views/component/tamu/navbar.php'; ?>
    <?php
    if (in_array($halaman, $authPages)) {
        include "views/auth/{$halaman}.php";
    } else {
        include "views/landing/{$halaman}.php";
    }
    ?>
    <?php include 'views/component/tamu/footer.php'; ?>
</div>
<?php
}

/*
|--------------------------------------------------------------------------
| ZONA USER (ADMIN & PETUGAS)
|--------------------------------------------------------------------------
*/
elseif (isset($_SESSION['iduser'])) {
?>
<div class="wrapper">
    <?php include 'views/component/user/navbar.php'; ?>
    <?php
    // Memanggil sidebar admin/petugas
    $sidebar = ($_SESSION['role'] ?? '') === 'admin' ? 'sidebaradmin.php' : 'sidebarpetugas.php';
    include "views/component/user/{$sidebar}";
    ?>

    <div class="content-wrapper">
        <?php
        switch ($halaman) {
            /* --- DASHBOARD --- */
            case 'dashboardadmin':
                cekAdmin();
                include 'views/user/dashboard/dashboardadmin.php';
                break;

            case 'dashboardpetugas':
                cekPetugas();
                include 'views/user/dashboard/dashboardpetugas.php';
                break;

            /* --- MANAJEMEN USER / PETUGAS (KHUSUS ADMIN) --- */
            case 'user':
            case 'createuser':
            case 'edituser':
            case 'showuser':
                cekAdmin();
                $file = str_replace(['createuser', 'edituser', 'showuser', 'user'], ['create', 'edit', 'show', 'index'], $halaman);
                include "views/user/user/{$file}.php";
                break;

            /* --- DATA PELAPOR --- */
            case 'pelapor':
            case 'createpelapor':
            case 'editpelapor':
            case 'showpelapor':
                $file = str_replace(['createpelapor', 'editpelapor', 'showpelapor', 'pelapor'], ['create', 'edit', 'show', 'index'], $halaman);
                include "views/user/pelapor/{$file}.php";
                break;

            /* --- MASTER SISWA --- */
            case 'siswa':
            case 'createsiswa':
            case 'editsiswa':
            case 'showsiswa':
                $file = str_replace(['createsiswa', 'editsiswa', 'showsiswa', 'siswa'], ['create', 'edit', 'show', 'index'], $halaman);
                include "views/user/siswa/{$file}.php";
                break;

            /* --- KATEGORI KASUS --- */
            case 'kategori':
            case 'createkategori':
            case 'editkategori':
            case 'showkategori':
                $file = str_replace(['createkategori', 'editkategori', 'showkategori', 'kategori'], ['create', 'edit', 'show', 'index'], $halaman);
                include "views/user/kategori/{$file}.php";
                break;

            /* --- MASTER KASUS --- */
            case 'kasus':
            case 'createkasus':
            case 'editkasus':
            case 'showkasus':
                $file = str_replace(['createkasus', 'editkasus', 'showkasus', 'kasus'], ['create', 'edit', 'show', 'index'], $halaman);
                include "views/user/kasus/{$file}.php";
                break;

            /* --- MASTER SANKSI --- */
            case 'sanksi':
            case 'createsanksi':
            case 'editsanksi':
            case 'showsanksi':
                $file = str_replace(['createsanksi', 'editsanksi', 'showsanksi', 'sanksi'], ['create', 'edit', 'show', 'index'], $halaman);
                include "views/user/sanksi/{$file}.php";
                break;

            /* --- PENANGANAN LAPORAN KASUS --- */
            case 'penanganan':
            case 'createpenanganan':
            case 'editpenanganan':
            case 'showpenanganan':
                $file = str_replace(['createpenanganan', 'editpenanganan', 'showpenanganan', 'penanganan'], ['create', 'edit', 'show', 'index'], $halaman);
                include "views/user/penanganan/{$file}.php";
                break;

            /* --- PROFIL USER --- */
            case 'profiluser':
                include 'views/user/profil.php';
                break;

            /* --- LAPORAN & REKAP --- */
            case 'laporanharian':
                include 'views/user/laporan/laporanharian.php';
                break;
            case 'cetaklaporanharian':
                include 'views/user/laporan/cetaklaporanharian.php';
                break;

            case 'laporanbulanan':
                include 'views/user/laporan/laporanbulanan.php';
                break;
            case 'cetaklaporanbulanan':
                include 'views/user/laporan/cetaklaporanbulanan.php';
                break;

            case 'laporantahunan':
                include 'views/user/laporan/laporantahunan.php';
                break;
            case 'cetaklaporantahunan':
                include 'views/user/laporan/cetaklaporantahunan.php';
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
| ZONA SISWA / PELAPOR
|--------------------------------------------------------------------------
*/
elseif (isset($_SESSION['idsiswa'])) {
?>
<div class="wrapper">
    <?php include 'views/component/siswa/navbar.php'; ?>
    <?php include 'views/component/siswa/sidebar.php'; ?>
    
    <div class="content-wrapper">
        <?php
        switch ($halaman) {
            case 'dashboardsiswa':
                include 'views/siswa/dashboardsiswa.php';
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
| ERROR / UNUATHORIZED
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