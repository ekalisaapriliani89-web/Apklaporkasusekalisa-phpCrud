<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Petugas / Admin - Lapor Kasus</title>
    <!-- CSS Bootstrap via CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center min-vh-100">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <h4 class="fw-bold text-primary">Login Petugas</h4>
                        <p class="text-muted small">Silakan masuk menggunakan akun petugas/admin</p>
                    </div>

                   <form action="/5APKLAPORKASUSEKALISA/proses/prosesuser.php" method="POST">
                        <div class="mb-3">
                            <label for="username" class="form-label fw-semibold">Username</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username" required autofocus>
                        </div>
                        
                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 fw-bold py-2 mt-2">Masuk</button>
                    </form>

                    <div class="text-center mt-3">
                        <a href="../../index.php" class="text-decoration-none small text-muted">← Kembali ke Halaman Utama</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>