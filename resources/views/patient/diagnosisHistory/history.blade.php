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

    <div class="mt-24">
        <section class="p-10 text-center shadow-md rounded-xl mx-4 lg:mx-24 bg-no-repeat bg-cover bg-center"
            style="background-image: linear-gradient(to right, rgba(20, 139, 64, 0.9), rgba(78, 228, 40, 0.9))">
            <h1 class="text-2xl lg:text-4xl font-extrabold text-gray-100">
                Riwayat Diagnosis
            </h1>
        </section>

        <!-- Statistik Diagnosis -->
        <div class="grid grid-cols-1 gap-4 px-4 mt-10 text-center sm:grid-cols-3 lg:mx-24">
            <div class="p-6 bg-white border rounded shadow">
                <p class="text-lg font-semibold text-gray-700">Total Diagnosis</p>
                <p class="mt-2 text-2xl font-bold text-green-700">{{ $diagnosis->count() }} Kali</p>
            </div>
            <div class="p-6 bg-white border rounded shadow">
                <p class="text-lg font-semibold text-gray-700">Diagnosis Terakhir</p>
                <p class="mt-2 text-2xl font-bold text-green-700">
                    {{ $diagnosis->first()?->tanggal->format('d-m-Y') }}
                </p>
            </div>
            <div class="p-6 bg-white border rounded shadow">
                <p class="text-lg font-semibold text-gray-700">Status Diagnosis Terakhir</p>
                <p class="mt-2 text-2xl font-bold text-green-700">
                    {{ $diagnosis->first()?->hasil ?? '-' }}%
                    ({{ $diagnosis->first()?->fuzzyOutput->disease->nama ?? '-' }})
                </p>
            </div>
        </div>

        <!-- Diagnosis Table -->
        <div class="px-4 mt-10 lg:mx-24">
            <table class="w-full text-center border border-collapse table-auto">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="border p-2">Tanggal</th>
                        <th class="border p-2">Jenis TB</th>
                        <th class="border p-2">Diagnosis</th>
                        <th class="border p-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($diagnosis as $item)
                        <tr class="bg-white">
                            <td class="border p-2">{{ $item->tanggal->format('d-m-Y') }}</td>
                            <td class="border p-2">{{ $item->fuzzyOutput->disease->nama }}</td>
                            <td class="border p-2">{{ $item->hasil }}%</td>
                            <td class="border p-2">
                                <a href="{{ route('patient.diagnosisHistory.show', $item->id) }}"
                                    class="px-3 py-1 text-sm text-white bg-blue-600 rounded hover:bg-blue-700">
                                    Lihat Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="p-4 text-gray-500">Belum ada data diagnosis</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- New Diagnosis Button -->
        <div class="px-4 mt-10 text-center lg:mx-24">
            <a href="/symptomTest"
                class="inline-block px-6 py-3 font-semibold text-white bg-green-700 rounded hover:bg-green-800">
                Mulai Diagnosis Baru
            </a>
        </div>
    </div>

    <div class="mt-16">
        <x-footer></x-footer>
    </div>
</body>

</html>
