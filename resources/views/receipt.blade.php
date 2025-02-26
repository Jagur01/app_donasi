<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Donasi</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            text-align: center;
            padding: 30px;
            background-color: #f4f7fc;
        }

        .donation-container {
            background: white;
            border: 1px solid #ddd;
            padding: 25px;
            border-radius: 12px;
            max-width: 500px;
            margin: auto;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: left;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #ddd;
            padding-bottom: 12px;
            margin-bottom: 20px;
        }

        .header h2 {
            font-size: 22px;
            font-weight: 700;
            color: #333;
        }

        .donation-details {
            margin-bottom: 20px;
            font-size: 16px;
            color: #555;
        }

        .donation-details p {
            margin: 5px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 10px 0;
        }

        table th,
        table td {
            padding: 10px;
            border-bottom: 1px solid #eee;
            font-size: 16px;
            text-align: left;
        }

        table th {
            background: #f4f4f4;
            font-weight: bold;
        }

        .status {
            font-weight: bold;
            padding: 6px 14px;
            border-radius: 5px;
            display: inline-block;
            font-size: 14px;
        }

        .pending {
            background: #ffcc00;
            color: #fff;
        }

        .approved {
            background: #28a745;
            color: #fff;
        }

        .rejected {
            background: #dc3545;
            color: #fff;
        }

        .footer {
            margin-top: 20px;
            font-size: 16px;
            font-weight: 500;
            color: #555;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="donation-container">
        <div class="header">
            <h2>Bukti Donasi</h2>
        </div>

        <div class="donation-details">
            <p><strong>Tanggal:</strong> {{ $date }}</p>
        </div>

        <table>
            <tr>
                <th>Deskripsi</th>
                <th>Detail</th>
            </tr>
            <tr>
                <td>Nama</td>
                <td>{{ $donor }}</td>
            </tr>
            <tr>
                <td>Judul</td>
                <td>{{ $campaign }}</td>
            </tr>
            <tr>
                <td>Jumlah Donasi</td>
                <td>Rp {{ number_format($amount, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Status</td>
                <td>
                    <span
                        class="status {{ $status == 'Pending' ? 'pending' : ($status == 'Disetujui' ? 'approved' : 'rejected') }}">
                        {{ $status }}
                    </span>
                </td>
            </tr>
        </table>

        <p class="footer">Kami mengucapkan terima kasih atas donasi yang telah Anda berikan. Semoga kebaikan Anda
            mendapatkan balasan yang berlimpah.
        </p>
    </div>
</body>

</html>
