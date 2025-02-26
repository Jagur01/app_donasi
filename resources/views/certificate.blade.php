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
        <h2>Sertifikat Donasi</h2>
        <p>Nama: {{ $donor }}</p>
        <p>Kampanye: {{ $campaign }}</p>
        <p>Jumlah Donasi: Rp {{ number_format($amount, 0, ',', '.') }}</p>
        <p>Tanggal: {{ $date }}</p>
        <p class="status {{ $status == 'Pending' ? 'pending' : ($status == 'Disetujui' ? 'approved' : 'rejected') }}">
            {{ ucfirst($status) }}
        </p>

        <p>Semoga kebaikan Anda mendapat balasan yang berlipat ganda.</p>
        <br>
        <p><strong>Dewan Kemakmuran Masjid</strong></p>
    </div>
</body>

</html>
