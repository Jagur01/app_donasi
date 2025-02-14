<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body class="d-flex flex-column justify-content-center align-items-center vh-100" style="background-color: #f8f9fa;">

    <div class="card shadow p-4 text-center" style="max-width: 400px;">
        <h4 class="mb-3">Anda terdapat permintaan reset password</h4>
        <p>Silahkan klik link di bawah ini untuk me-reset password Anda</p>

        <a href="{{ route('validasi-forgot-password', ['token' => $token]) }}" class="btn btn-primary mt-2">
            Klik Disini
        </a>

        <p class="text-muted mt-3">Jika Anda tidak meminta reset password, abaikan pesan ini.</p>
    </div>

    <!-- Footer -->
    <footer class="mt-5 text-center text-muted">
        <p>&copy; {{ date('Y') }} Donasi UIKA. Semua Hak Cipta Dilindungi.</p>
    </footer>

</body>

</html>
