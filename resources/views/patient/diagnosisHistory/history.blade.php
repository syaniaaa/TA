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
        <!-- Header -->
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
                    {{ $diagnosis->first()?->tanggal ? \Carbon\Carbon::parse($diagnosis->first()->tanggal)->format('d-m-Y') : '-' }}
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

        <!-- Tabel Riwayat Diagnosis -->
        <div class="px-4 mt-10 lg:mx-24">
            <x-table>
                <x-slot name="header">
                    <tr>
                        <th class="text-left">No</th>
                        <th class="text-left">Tanggal</th>
                        <th class="text-left">Jenis TB</th>
                        <th class="text-left">Diagnosis</th>
                        <th class="text-left"></th>
                    </tr>
                </x-slot>

                @php $no = 1; @endphp
                @forelse ($diagnosis as $item)
                    <tr class="bg-white">
                        <td class="p-3">{{ $no++ }}</td>
                        <td class="p-3">{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                        <td class="p-3">{{ $item->fuzzyOutput->disease->nama ?? '-' }}</td>
                        <td class="p-3">{{ $item->hasil ?? '-' }}%</td>
                        <td class="p-3">
                            <x-primary-button tag="a"
                                class="inline-flex items-center px-3 py-1 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-xl shadow-sm transition transform hover:scale-105"
                                href="{{ route('patient.diagnosisHistory.show', $item->id) }}">
                                <svg class="w-4 h-4 text-gray-100 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-width="2"
                                        d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z" />
                                    <path stroke="currentColor" stroke-width="2"
                                        d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                                    Lihat Detail
                            </x-primary-button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-4 text-center text-gray-500">Belum ada data diagnosis</td>
                    </tr>
                @endforelse
            </x-table>
        </div>
        <!-- Tombol Mulai Diagnosis Baru -->
        <div class="px-4 mt-10 text-center lg:mx-24">
            <a href="/symptomTest"
                class="inline-block px-6 py-3 font-semibold text-white bg-green-700 rounded hover:bg-green-800">
                Mulai Diagnosis Baru
            </a>
        </div>
    </div>

    <!-- Footer -->
    <div class="mt-16">
        <x-footer></x-footer>
    </div>
</body>

</html>
