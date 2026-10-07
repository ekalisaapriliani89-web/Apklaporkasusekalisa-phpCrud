<?php

require_once "../../proses/koneksi.php";
require_once "../../proses/session.php";


// Jika sudah login
if (sudahLogin()) {

    if ($_SESSION['role'] === 'siswa') {

        header("Location: ../siswa/dashboardsiswa.php");
        exit;

    }

    if (
        $_SESSION['role'] === 'admin' ||
        $_SESSION['role'] === 'petugas'
    ) {

        header("Location: ../user/dashboard/dashboardadmin.php");
        exit;
    }
}


$error = "";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');


    if ($username === '' || $password === '') {

        $error = "Username dan password wajib diisi.";

    } else {

        $sql = "
            SELECT *
            FROM siswa
            WHERE username = ?
            LIMIT 1
        ";

        $stmt = $koneksi->prepare($sql);

        $stmt->execute([$username]);

        $siswa = $stmt->fetch();


        if (
            $siswa &&
            $password === $siswa['password']
        ) {

            session_regenerate_id(true);

            $_SESSION['login'] = true;

            $_SESSION['role'] = 'siswa';

            $_SESSION['idsiswa'] =
                $siswa['idsiswa'];

            $_SESSION['namasiswa'] =
                $siswa['namasiswa'];

            $_SESSION['username'] =
                $siswa['username'];

            $_SESSION['kelas'] =
                $siswa['kelas'];

            $_SESSION['foto'] =
                $siswa['foto'];


            header(
                "Location: ../siswa/dashboardsiswa.php"
            );

            exit;

        } else {

            $error =
                "Username atau password salah.";

        }
    }
}

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Login Siswa - Lapor Kasus</title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f1f5f9;
        }

        .login-container {
            min-height: 100vh;

            display: flex;

            justify-content: center;

            align-items: center;

            padding: 20px;
        }

        .login-box {
            width: 100%;
            max-width: 420px;

            background: white;

            padding: 35px;

            border-radius: 15px;

            box-shadow:
                0 10px 30px rgba(0,0,0,.1);
        }

        .login-box h1 {
            margin-top: 0;

            text-align: center;

            color: #1e293b;
        }

        .login-subtitle {
            text-align: center;

            color: #64748b;

            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;

            margin-bottom: 7px;

            font-weight: bold;

            color: #334155;
        }

        input {
            width: 100%;

            padding: 12px;

            border: 1px solid #cbd5e1;

            border-radius: 8px;

            font-size: 15px;
        }

        input:focus {
            outline: none;

            border-color: #2563eb;
        }

        .btn {
            border: none;

            padding: 12px 18px;

            border-radius: 8px;

            cursor: pointer;

            font-size: 15px;
        }

        .btn-primary {
            background: #2563eb;

            color: white;
        }

        .btn-primary:hover {
            background: #1d4ed8;
        }

        .btn-full {
            width: 100%;
        }

        .alert {
            padding: 12px;

            border-radius: 8px;

            margin-bottom: 20px;

            background: #fee2e2;

            color: #991b1b;
        }

        .login-footer {
            text-align: center;

            margin-top: 25px;
        }

        .login-footer a {
            color: #2563eb;

            text-decoration: none;
        }

    </style>

</head>

<body>

<div class="login-container">

    <div class="login-box">

        <h1>Login Siswa</h1>

        <p class="login-subtitle">
            Sistem Informasi Lapor Kasus
        </p>


        <?php if ($error): ?>

            <div class="alert">
                <?= e($error); ?>
            </div>

        <?php endif; ?>


        <form method="POST">

            <div class="form-group">

                <label>
                    Username
                </label>

                <input
                    type="text"
                    name="username"
                    placeholder="Masukkan username"
                    required
                >

            </div>


            <div class="form-group">

                <label>
                    Password
                </label>

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

            <p>
                Belum mempunyai akun?
            </p>

            <a href="registersiswa.php">
                Registrasi Siswa
            </a>

            <br><br>

            <a href="../../index.php">
                ← Kembali
            </a>

        </div>

    </div>

</div>

</body>

</html>