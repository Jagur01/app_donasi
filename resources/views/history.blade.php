<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Donasi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Poppins', sans-serif;
        }

        .container {
            max-width: 900px;
            background: white;
            padding: 30px;
            margin-top: 50px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            font-weight: 600;
            color: #343a40;
        }

        table {
            border-radius: 10px;
            overflow: hidden;
        }

        thead {
            background: #343a40;
            color: white;
        }

        .badge {
            font-size: 14px;
            padding: 5px 10px;
            border-radius: 5px;
        }

        .btn {
            transition: all 0.3s ease-in-out;
        }

        .btn:hover {
            transform: scale(1.05);
        }

        .alert {
            font-size: 18px;
            font-weight: 500;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2 class="mb-4 text-center">📜 Riwayat Donasi</h2>

        @if ($donations->isEmpty())
            <div class="alert alert-warning text-center">
                Kamu belum pernah berdonasi. Yuk mulai berbagi! 🤝
            </div>
        @else
            <table class="table table-hover text-center align-middle">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Tanggal</th>
                        <th>Nominal</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($donations as $donation)
                        <tr>
                            <td>{{ $donation->campaign->title }}</td>
                            <td>{{ $donation->created_at->format('d M Y') }}</td>
                            <td>Rp {{ number_format($donation->amount, 0, ',', '.') }}</td>
                            <td>
                                @if ($donation->status == 'pending')
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @elseif($donation->status == 'approved')
                                    <span class="badge bg-success">Disetujui</span>
                                @else
                                    <span class="badge bg-danger">Ditolak</span>
                                @endif
                            </td>
                            <td>

                                {{-- <a href="{{ route('donations.certificate', $donation->id) }}"
                                    class="btn btn-success btn-sm">🏅 Sertifikat</a>


                                <a href="{{ route('donations.download', $donation->id) }}"
                                    class="btn btn-primary btn-sm">📄 Bukti Donasi</a> --}}

                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

</body>

</html>
