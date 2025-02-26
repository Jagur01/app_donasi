<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sertifikat Donasi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 50px;
        }

        .certificate {
            border: 10px solid #ccc;
            padding: 20px;
            width: 80%;
            margin: 0 auto;
        }

        h1 {
            color: #2c3e50;
        }

        p {
            font-size: 18px;
        }
    </style>
</head>

<body>
    <div class="certificate">
        <h1>SERTIFIKAT DONASI</h1>
        <p>Dengan ini kami mengucapkan terima kasih kepada:</p>

        @if (isset($donation) && $donation->user)
            <h2>{{ $donation->user->name }}</h2>
            <p>Atas donasi sebesar <strong>Rp{{ number_format($donation->amount, 0, ',', '.') }}</strong></p>
            <p>untuk program <strong>{{ $donation->campaign->title }}</strong>.</p>
        @else
            <p><strong>Data tidak ditemukan.</strong></p>
        @endif

        <p>Semoga kebaikan Anda mendapat balasan yang berlipat ganda.</p>
        <br>
        <p><strong>Dewan Kemakmuran Masjid</strong></p>
    </div>
</body>

</html>
