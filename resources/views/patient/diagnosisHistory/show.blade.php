<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Riwayat Diagnosis</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <x-navbar></x-navbar>

    <div class="py-12">
        <div class="max-w-4xl mx-auto bg-white p-8 rounded shadow border border-gray-300">
            {{-- Tabel Data Diri --}}
            <table class="w-full table-fixed border border-gray-400 text-sm mb-6">
                <tbody>
                    <tr>
                        <td class="border px-3 py-2 w-1/4 ">Nama</td>
                        <td class="border px-3 py-2" colspan="3">{{ $diagnosis->user->name ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="border px-3 py-2 ">Tanggal Lahir</td>
                        <td class="border px-3 py-2" colspan="3">
                            @php
                                \Carbon\Carbon::setLocale('id');
                            @endphp
                            {{ \Carbon\Carbon::parse($diagnosis->user->tanggal_lahir)->translatedFormat('d F Y') }}
                        </td>
                    </tr>
                    <tr>
                        <td class="border px-3 py-2 ">Jenis Kelamin</td>
                        <td class="border px-3 py-2" colspan="3">
                            {{ ucfirst($diagnosis->user->kelamin ?? '-') }}</td>
                    </tr>
                    <tr>
                        <td class="border px-3 py-2 ">Alamat</td>
                        <td class="border px-3 py-2" colspan="3">{{ $diagnosis->user->alamat ?? '-' }}</td>
                    </tr>
                </tbody>
            </table>


            {{-- Tabel Hasil Diagnosis --}}
            <h3 class="text-md font-semibold mb-2">I. Hasil Diagnosis</h3>
            <table class="w-full border border-gray-400 text-sm mb-6">
                <tbody>
                    <tr>
                        <td class="border px-3 py-2 w-1/4">Penyakit</td>
                        <td class="border px-3 py-2">{{ $diagnosis->fuzzyOutput->disease->nama ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="border px-3 py-2">Tingkat Kemungkinan</td>
                        <td class="border px-3 py-2">{{ $diagnosis->tingkat_kemungkinan }}</td>
                    </tr>
                    <tr>
                        <td class="border px-3 py-2">Nilai Fuzzy</td>
                        <td class="border px-3 py-2">{{ $diagnosis->hasil_fuzzy }}%</td>
                    </tr>
                    <tr>
                        <td class="border px-3 py-2">Nilai Akhir</td>
                        <td class="border px-3 py-2">{{ $diagnosis->hasil }}%</td>
                    </tr>
                    <tr>
                        <td class="border px-3 py-2">Tanggal Pemeriksaan</td>
                        <td class="border px-3 py-2" colspan="3">
                            @php
                                \Carbon\Carbon::setLocale('id');
                            @endphp
                            {{ \Carbon\Carbon::parse($diagnosis->tanggal)->translatedFormat('d F Y') }}</td>
                    </tr>
                </tbody>
            </table>

            {{-- Tabel Gejala --}}
            <h3 class="text-md font-semibold mb-2">II. Gejala yang Dipilih</h3>
            <table class="w-full border border-gray-400 text-sm mb-6">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border px-3 py-2 w-1/12 font-medium">No</th>
                        <th class="border px-3 py-2 font-medium">Nama Gejala</th>
                        <th class="border px-3 py-2 font-medium text-left">Rentang / Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($diagnosis->symptoms as $index => $symptom)
                        <tr>
                            <td class="border px-3 py-1 text-center">{{ $index + 1 }}</td>
                            <td class="border px-3 py-1">{{ $symptom->nama }}</td>
                            <td class="border px-3 py-1">{{ $symptom->pivot->nilai }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td class="border px-3 py-1 text-center" colspan="2">Tidak ada gejala yang dipilih</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Tabel Risiko --}}
            <h3 class="text-md font-semibold mb-2">III. Faktor Risiko yang Dipilih</h3>
            <table class="w-full border border-gray-400 text-sm mb-6">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border px-3 py-2 w-1/12 font-medium">No</th>
                        <th class="border px-3 py-2 font-medium">Faktor Risiko</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($diagnosis->risks as $index => $risk)
                        <tr>
                            <td class="border px-3 py-1 text-center">{{ $index + 1 }}</td>
                            <td class="border px-3 py-1">{{ $risk->nama }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td class="border px-3 py-1 text-center" colspan="2">Tidak ada risiko yang dipilih</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <!-- Footer -->
    <div class="mt-16">
        <x-footer></x-footer>
    </div>
</body>

</html>
