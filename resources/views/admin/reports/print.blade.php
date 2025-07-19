<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Diagnosis</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 22px;
            margin: 0;
        }

        .header h3,
        .header p {
            font-size: 14px;
            margin: 2px 0;
        }

        .title {
            text-align: center;
            margin-top: 30px;
            margin-bottom: 10px;
        }

        .title h2 {
            font-size: 16px;
            text-transform: uppercase;
            margin: 0;
        }

        .subtitle {
            text-align: center;
            font-size: 14px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }

        th {
            background-color: #eee;
        }

        .footer {
            margin-top: 50px;
        }

        .date-location {
            text-align: right;
            margin-right: 40px;
            font-size: 14px;
        }

        .signature {
            margin-top: 60px;
            text-align: right;
            margin-right: 80px;
        }

        .signature p {
            margin: 4px 0;
        }

        .nip {
            font-size: 12px;
        }
    </style>
</head>

<body>

    <div class="header">
        <h1>PUSKESMAS CUGENANG</h1>
        <p>Jl. Raya Cariu No. 1 Ds. Mangunkerta, Kec. Cugenang, Kab. Cianjur, Jawa Barat 43252</p>
        <p>Email: puskesmascugenang@gmail.com</p>
    </div>

    <div class="title">
        <h2>LAPORAN HASIL DIAGNOSIS PASIEN</h2>
    </div>
    <div class="subtitle">
        @php
            \Carbon\Carbon::setLocale('id');
        @endphp
        <p>Dicetak pada: {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pasien</th>
                <th>Hasil Diagnosis</th>
                <th>Penyakit Terdeteksi</th>
                <th>Tanggal Pemeriksaan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reports as $index => $report)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $report->user->name ?? '-' }}</td>
                    <td>
                        {{ $report->hasil }} %
                    </td>
                    <td>{{ $report->tingkat_kemungkinan }}
                        {{ $symptom->fuzzyInputs->first()?->unit ?? '-' }}
                    </td>
                    @php
                        \Carbon\Carbon::setLocale('id');
                    @endphp
                    <td>{{ \Carbon\Carbon::parse($report->created_at)->translatedFormat('d F Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>


    <table style="width: 100%; margin-top: 60px; font-size: 14px; border: none;">
        <tr>
            <td style="width: 60%; border: none;"></td>
            <td style="text-align: center; border: none;">
                @php
                    \Carbon\Carbon::setLocale('id');
                @endphp
                Cianjur, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}<br><br>
                Kepala Puskesmas Cugenang,<br><br><br><br>
                <strong>Dr. H. Deden Mulyana, M.Kes</strong><br>
                <span style="font-size: 12px;">NIP. 19751230 200501 1 004</span>
            </td>
        </tr>
    </table>


</body>

</html>
