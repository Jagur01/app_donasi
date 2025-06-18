<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sertifikat Donasi</title>
    <style>
   @page {
    size: A4 landscape;
    margin: 0;
}

@media print {
    body, html {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
        overflow: hidden;
    }

    .certificate {
        width: 100%;
        height: 100%;
        page-break-inside: avoid;
        break-inside: avoid;
        
    }
}

        body {
            font-family: 'Times New Roman', serif;
            background: #EBE5C2;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }
   
        .gold-border {
            position: absolute;
            width: 92%;
            height: 88%;
            border: 4px solid #504B38;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        h1 {
            color: #504B38;
            text-transform: uppercase;
            font-size: 40px;
            margin-bottom: 20px;
        }
        .info {
            font-size: 35px;
            margin: 50px 0;
            color: #333;
        }
        .status {
            font-size: 22px;
            font-weight: bold;
            padding: 10px 20px;
            margin-top: 20px;
            border-radius: 5px;
            display: inline-block;
            color: white;
        }
        .approved { background: #28a745; color: white; }
        .pending { background: #ffc107; color: black; }
        .rejected { background: #dc3545; color: white; }
        
        .signature-section {
            display: flex;
            justify-content: space-between;
            margin-top: 40px;
        }
        .signature {
            font-size: 18px;
            text-align: center;
        }
        .seal {
            width: 100px;
            opacity: 0.8;
        }
    </style>
</head>
<body>
    <div class="certificate">
        <div class="gold-border"></div>
        <h1 style="text-align: center; margin-top:100px;">Sertifikat Donasi</h1>
        <p class="info" style="text-align: center; margin-top:40px;"><strong>Nama Donatur:</strong> {{ $donor }}</p>
        <p class="info" style="text-align: center; margin-top:40px;"><strong>Untuk Kampanye:</strong> {{ $campaign }}</p>
        <p class="info" style="text-align: center; margin-top:40px;"><strong>Jumlah Donasi:</strong> Rp {{ number_format($amount, 0, ',', '.') }}</p>
        <p class="info" style="text-align: center; margin-top:40px;"><strong>Tanggal Donasi:</strong> {{ $date }}</p>
        <h4 style="text-align: center; margin-top:25px; font-size: 25px">Status: {{ $status }}</h4>
        <div class="signature-section">
            <div class="signature">
                
                <p style="border-top: 2px solid #2c3e50; width: 500px; margin: 10px auto; padding-top: 15px; font-size: 25px; text-align: center;">
                    <span style="display: block; margin-bottom: 15px;">Ketua Dewan Kemakmuran Masjid</span>  
                    <strong>Dr. H. Dedi Supriadi, M.Pd., M.Si.,</strong>
                </p>
                
            </div>
        </div>
    </div>
</body>
</html>