<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Diagnosis</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <x-navbar></x-navbar>

    <div class="mt-24">
        <section class="p-10 text-center shadow-md rounded-xl mx-4 lg:mx-24 bg-no-repeat bg-cover bg-center"
            style="background-image: linear-gradient(to right, rgba(20, 139, 64, 0.9), rgba(78, 228, 40, 0.9))">
            <h1 class="text-2xl lg:text-4xl font-extrabold text-gray-100">
                Tes Diagnosis Tuberkulosis (TB)
            </h1>
        </section>

        {{-- progress bar --}}
        <section class="mt-20 px-10">
            <div class="max-w-4xl mx-auto">
                <x-stepper></x-stepper>
            </div>
        </section>

        {{-- hasil diagnosis --}}
        <section class="mt-10 px-10">
            <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-lg p-8">
                <h2 class="text-2xl font-bold text-green-700 mb-6">Hasil Diagnosis</h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 text-sm sm:text-base">
                    <div>
                        <p class="text-gray-500">Nama Pasien</p>
                        <p class="font-semibold text-gray-800">{{ $diagnosis->user->name }}</p>
                    </div>

                    <div>
                        <p class="text-gray-500">Tanggal Lahir</p>
                        <p class="font-semibold text-gray-800">{{ $diagnosis->user->tgl_lahir }}</p>
                    </div>

                    <div>
                        <p class="text-gray-500">Jenis Kelamin</p>
                        <p class="font-semibold text-gray-800">{{ $diagnosis->user->kelamin }}</p>
                    </div>

                    <div>
                        <p class="text-gray-500">Tanggal Diagnosis</p>
                        <p class="font-semibold text-gray-800">{{ $diagnosis->tanggal }}</p>
                    </div>

                    <div>
                        <p class="text-gray-500">Hasil</p>
                        <p class="font-semibold text-gray-800">{{ $diagnosis->hasil }}%</p>
                    </div>

                    <div class="sm:col-span-2">
                        <p class="text-gray-500 mb-1">Hasil Diagnosis</p>
                        <div
                            class="bg-green-100 text-green-700 font-semibold px-6 py-3 rounded-xl inline-block shadow-sm">
                            {{ $diagnosis->fuzzyOutput->disease->nama }} {{ $diagnosis->tingkat_kemungkinan }}
                        </div>
                    </div>
                </div>

                <div class="mt-8">
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Solusi / Rekomendasi</h3>
                    <div class="bg-gray-100 text-gray-800 rounded-xl p-4 leading-relaxed">
                        <ul class="list-disc list-inside space-y-2">
                            @foreach (explode('.', $diagnosis->fuzzyOutput->disease->solusi) as $solusi)
                                @if (trim($solusi) !== '')
                                    <li>{{ trim($solusi) }}.</li>
                                @endif
                            @endforeach
                        </ul>
                        <ul class="list-disc list-inside space-y-2">
                            <li>Segera periksa ke Puskesmas atau rumah sakit terdekat untuk pemeriksaan lanjutan.</li>
                            <li>Ikuti pengobatan rutin minimal selama 6 bulan tanpa terputus.</li>
                            <li>Jaga pola makan sehat dan perbanyak istirahat.</li>
                            <li>Gunakan masker untuk mencegah penularan kepada orang lain.</li>
                            <li>Jangan berhenti pengobatan meskipun gejala mulai membaik.</li>
                        </ul>
                    </div>
                </div>

                <div class="text-center mt-10">
                    <a href="{{ route('homepage') }}"
                        class="inline-block bg-green-600 text-white px-6 py-2 rounded-xl hover:bg-green-700 transition">
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
        </section>
    </div>

    <div class="mt-16">
        <x-footer></x-footer>
    </div>
</body>

</html>
