<?php

require_once "../../proses/koneksi.php";

session_start();

$error = "";

if (isset($_SESSION['login']) && $_SESSION['login'] === true) {

    if ($_SESSION['role'] === 'admin') {
        header("Location: ../user/dashboard/dashboardadmin.php");
        exit;
    }

    if ($_SESSION['role'] === 'petugas') {
        header("Location: ../user/dashboard/dashboardpetugas.php");
        exit;
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($username === '' || $password === '') {

        $error = "Username dan password wajib diisi.";

    } else {

        $sql = "SELECT *
                FROM `user`
                WHERE `unsername` = ?
                LIMIT 1";

        $stmt = $koneksi->prepare($sql);
        $stmt->execute([$username]);

        $user = $stmt->fetch();

        if ($user && $password === $user['password']) {

            session_regenerate_id(true);

            $_SESSION['login'] = true;
            $_SESSION['iduser'] = $user['iduser'];
            $_SESSION['namauser'] = $user['namauser'];
            $_SESSION['username'] = $user['unsername'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['nohp'] = $user['nohp'];
            $_SESSION['foto'] = $user['fot'];

            if ($user['role'] === 'admin') {

                header("Location: ../user/dashboard/dashboardadmin.php");
                exit;

            } elseif ($user['role'] === 'petugas') {

                header("Location: ../user/dashboard/dashboardpetugas.php");
                exit;

            }

        } else {

            $error = "Username atau password salah.";

        }
    }
}

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Login User</title>

    <link rel="stylesheet"
          href="../../assets/css/style.css">

</head>

<body>

<div class="login-container">

    <div class="login-box">

        <h1>Login User</h1>

        <p class="login-subtitle">
            Admin / Petugas
        </p>

        <?php if ($error): ?>

            <div class="alert alert-danger">
                <?= htmlspecialchars($error); ?>
            </div>

        <?php endif; ?>


        <form method="POST">

            <div class="form-group">

                <label>Username</label>

                <input
                    type="text"
                    name="username"
                    placeholder="Masukkan username"
                    required
                >

            </div>


            <div class="form-group">

                <label>Password</label>

                <input
                    type="password"
                    name="password"
                    placeholder="Masukkan password"
                    required
                >

            </div>


            <button
                type="submit"
                class="btn btn-primary btn-full"
            >
                Login
            </button>

        </form>


        <div class="login-footer">

            <a href="../../index.php">
                ← Kembali ke halaman utama
            </a>

        </div>

    </div>

</div>

</body>

</html>