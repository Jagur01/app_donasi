<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/register.css') }}">
</head>

<body>
    <div class="login-dark">
        <form id="register-form" method="POST">
            @csrf
            <h2 class="sr-only">Register Form</h2>
            <div class="illustration"><i class="icon ion-ios-locked-outline"></i></div>
            <div class="card-body" style="margin-top: 20px; width: 500px;">

                <div class="row mb-3">
                    <label for="name" class="col-md-4 col-form-label text-md-end">Nama</label>
                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control" name="name" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>
                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control" name="email" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="phone" class="col-md-4 col-form-label text-md-end">No Telepon</label>
                    <div class="col-md-6">
                        <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror"
                            name="phone" value="{{ old('phone') }}" required autocomplete="phone">
                        @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="password" class="col-md-4 col-form-label text-md-end">Password</label>
                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control" name="password" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-end">Konfirmasi
                        Password</label>
                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                            required>
                    </div>
                </div>

                <div class="row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">Register</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Tambahkan Library JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('index/assets/js/jquery.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('form').submit(function(event) {
                event.preventDefault(); // Hindari form submit langsung

                $.ajax({
                    url: "{{ route('register') }}",
                    type: "POST",
                    data: $(this).serialize(),
                    success: function(response) {
                        Swal.fire({
                            title: "Berhasil!",
                            text: response.message,
                            icon: "success",
                            confirmButtonText: "OK"
                        }).then(() => {
                            window.location.href =
                                "{{ route('login') }}"; // Redirect ke login
                        });
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            let errorMessage = "";

                            $.each(errors, function(key, value) {
                                errorMessage += value[0] + "\n";
                            });

                            Swal.fire({
                                title: "Error!",
                                text: errorMessage,
                                icon: "error",
                                confirmButtonText: "OK"
                            });
                        } else {
                            Swal.fire({
                                title: "Error!",
                                text: "Terjadi kesalahan saat registrasi.",
                                icon: "error",
                                confirmButtonText: "OK"
                            });
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>
