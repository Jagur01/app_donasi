
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('index/assets/img/masjid_uika.png') }}">
</head>

<body>
    <div class="login-dark">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <input type="hidden" name="redirect_to" value="{{ old('redirect_to', URL::previous()) }}">
            <button type="submit">Login</button>
        </form>
        <form id="login-form">
            @csrf
            <h2 class="sr-only">Login Form</h2>
            <div class="illustration"><i class="icon ion-ios-locked-outline"></i></div>
            <div class="form-group">
                <input class="form-control" type="email" name="email" placeholder="Email" required>
            </div>
            <div class="form-group">
                <input class="form-control" type="password" name="password" placeholder="Password" required>
            </div>
            <div class="form-group">
                <button class="btn btn-primary btn-block" type="submit">Log In</button>
                <a href="{{ route('register') }}" class="btn btn-primary btn-block">Register</a>
            </div>
            <p>
                <a href="{{ route('forgot-password') }}">Lupa password?</a>
            </p>
        </form>
    </div>

    <!-- JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function () {
            $('#login-form').submit(function (event) {
                event.preventDefault(); // Hindari reload halaman

                $.ajax({
                    url: "{{ route('login') }}",
                    type: "POST",
                    data: $(this).serialize(),
                    success: function (response) {
                        Swal.fire({
                            title: "Berhasil!",
                            text: response.message,
                            icon: "success",
                            confirmButtonText: "OK"
                        }).then(() => {
                            window.location.href = response.redirect;
                        });
                    },
                    error: function (xhr) {
                        Swal.fire({
                            title: "Gagal!",
                            text: xhr.responseJSON.message,
                            icon: "error",
                            confirmButtonText: "Coba Lagi"
                        });
                    }
                });
            });
        });
    </script>

</body>

</html>
