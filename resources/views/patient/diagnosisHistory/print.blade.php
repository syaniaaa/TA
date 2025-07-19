<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Hasil Diagnosis</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 40px;
            color: #333;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        .section-title {
            font-size: 14px;
            font-weight: bold;
            margin-top: 30px;
            margin-bottom: 10px;
            padding-bottom: 5px;
            border-bottom: 1px solid #888;
        }

        .info-table {
            width: 100%;
            margin-bottom: 20px;
        }

        .info-table td {
            padding: 6px 4px;
            vertical-align: top;
        }

        .info-label {
            font-weight: bold;
            width: 30%;
        }

        table.data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            margin-bottom: 20px;
        }

        table.data-table th,
        table.data-table td {
            border: 1px solid #aaa;
            padding: 6px 8px;
            text-align: left;
        }

        table.data-table th {
            background-color: #f2f2f2;
        }

        .text-center {
            text-align: center;
        }

        .mt-2 {
            margin-top: 10px;
        }

        .mt-4 {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <h2>FORM HASIL DIAGNOSIS</h2>

    <!-- Data Pribadi -->
    <div class="section-title">Data Pribadi</div>
    <table class="info-table">
        <tr>
            <td class="info-label">Nama</td>
            <td>: {{ $report->user->name ?? '-' }}</td>
        </tr>
        <tr>
            <td class="info-label">Tempat, Tanggal Lahir</td>
            <td>: {{ $report->user->tgl_lahir ?? '-' }}</td>
        </tr>
        <tr>
            <td class="info-label">Jenis Kelamin</td>
            <td>: {{ $report->user->kelamin ?? '-' }}</td>
        </tr>
        <tr>
            <td class="info-label">Alamat</td>
            <td>: {{ $report->user->alamat ?? '-' }}</td>
        </tr>
    </table>

    <!-- Hasil Diagnosis -->
    <div class="section-title">Hasil Diagnosis</div>
    <table class="info-table">
        <tr>
            <td class="info-label">Tanggal Diagnosis</td>
            <td>: {{ $report->tanggal }}</td>
        </tr>
        <tr>
            <td class="info-label">Persentase Kemungkinan</td>
            <td>: {{ $report->hasil }}%</td>
        </tr>
        <tr>
            <td class="info-label">Tingkat Kemungkinan</td>
            <td>: {{ $report->tingkat_kemungkinan }}</td>
        </tr>
        <tr>
            <td class="info-label">Penyakit</td>
            <td>: {{ $report->fuzzyOutput->disease->nama ?? '-' }}</td>
        </tr>
    </table>

    <!-- Gejala -->
    <div class="section-title">Gejala yang Dipilih</div>
    <table class="data-table">
        <thead>
            <tr>
                <th class="text-center" width="5%">No</th>
                <th>Gejala</th>
                <th>Rentang / Nilai</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($report->symptoms as $index => $symptom)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $symptom->nama }}</td>
                    <td>{{ $symptom->pivot->nilai }} {{ $symptom->fuzzyInputs->first()?->unit ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">Tidak ada gejala yang dipilih</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Risiko -->
    <div class="section-title">Risiko yang Dipilih</div>
    <table class="data-table">
        <thead>
            <tr>
                <th class="text-center" width="5%">No</th>
                <th>Risiko</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($report->risks as $index => $risk)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $risk->nama }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="2" class="text-center">Tidak ada risiko yang dipilih</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>
