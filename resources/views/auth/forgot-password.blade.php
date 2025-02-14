<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('index/assets/img/masjid_uika.png') }}">
</head>

<body>
    <div class="login-dark">
        <form method="POST" action="{{ route('forgot-password-act') }}" id="forgotPasswordForm">
            @csrf
            <p class="login-box-msg">Masukkan E-Mail yang terdaftar</p>
            <div class="illustration"><i class="icon ion-ios-locked-outline"></i></div>
            <div class="form-group">
                <input class="form-control" type="email" name="email" placeholder="Email" required>
            </div>
            <div class="form-group">
                <button class="btn btn-primary btn-block" type="submit">Submit</button>
            </div>
        </form>
    </div>

    <!-- Modal Pop-up -->
    <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Reset Password Terkirim</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Link reset password telah dikirim ke email Anda. Silakan cek inbox atau folder spam.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#forgotPasswordForm').submit(function (event) {
                event.preventDefault(); // Mencegah form langsung submit
                
                // Tampilkan modal setelah klik submit
                $('#successModal').modal('show');

                // Simpan data form ke server (jika diperlukan)
                this.submit();
            });
        });
    </script>
</body>

</html>
