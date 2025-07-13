<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Hasil Diagnosis</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        .container {
            width: 100%;
            padding: 20px;
        }

        .section-title {
            font-size: 16px;
            font-weight: bold;
            margin-top: 20px;
            margin-bottom: 10px;
            border-bottom: 1px solid #ccc;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        td,
        th {
            border: 1px solid #999;
            padding: 6px;
        }

        .text-center {
            text-align: center;
        }

        .no-border td {
            border: none;
            padding: 3px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 style="text-align: center;">FORM HASIL DIAGNOSIS</h2>

        {{-- Data Diri --}}
        <div class="section-title">Data Pribadi</div>
        <table class="no-border">
            <tr>
                <td><strong>Nama</strong></td>
                <td>{{ $report->user->name ?? '-' }}</td>
            </tr>
            <tr>
                <td><strong>Tempat, Tanggal Lahir</strong></td>
                <td>{{ $report->user->tgl_lahir ?? '-' }}</td>
            </tr>
            <tr>
                <td><strong>Jenis Kelamin</strong></td>
                <td>{{ $report->user->kelamin ?? '-' }}</td>
            </tr>
            <tr>
                <td><strong>Alamat</strong></td>
                <td>{{ $report->user->alamat ?? '-' }}</td>
            </tr>
        </table>

        {{-- Hasil Diagnosis --}}
        <div class="section-title">Hasil Diagnosis</div>
        <table>
            <tr>
                <td><strong>Tanggal Diagnosis</strong></td>
                <td>{{ $report->tanggal }}</td>
            </tr>
            <tr>
                <td><strong>Persentase Kemungkinan</strong></td>
                <td>{{ $report->hasil }}%</td>
            </tr>
            <tr>
                <td><strong>Tingkat Kemungkinan</strong></td>
                <td>{{ $report->tingkat_kemungkinan }}</td>
            </tr>
            <tr>
                <td><strong>Penyakit</strong></td>
                <td>{{ $report->fuzzyOutput->disease->nama ?? '-' }}</td>
            </tr>
        </table>

        {{-- Gejala Terpilih --}}
        <div class="section-title">Gejala yang Dipilih</div>
        <table>
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th>Gejala</th>
                    <th>Rentang / Nilai</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($report->symptoms as $index => $symptom)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>{{ $symptom->nama }}</td>
                        <td>{{ $symptom->pivot->nilai }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">Tidak ada gejala yang dipilih</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Risiko Terpilih --}}
        <div class="section-title">Risiko yang Dipilih</div>
        <table>
            <thead>
                <tr>
                    <th class="text-center">No</th>
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
    </div>
</body>

</html>
