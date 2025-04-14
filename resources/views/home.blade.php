<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-white">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Halaman</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="font-inter">
    <x-navbar></x-navbar>

    <div class="mt-24">

        <!-- Hero Section -->
        <section class="p-10 text-center shadow-md rounded-xl mx-4 lg:mx-24 bg-no-repeat bg-cover bg-center"
            style="background-image: linear-gradient(to right, rgba(20, 139, 64, 0.9), rgba(78, 228, 40, 0.9)), url('/img/bg.png');">
            <h1 class="text-4xl lg:text-5xl font-extrabold text-gray-100">
                Sistem Pakar Diagnosis Tuberkulosis (TB)
            </h1>
            <p class="mt-4 text-lg text-gray-100 max-w-3xl mx-auto">
                Membantu Anda mengenali gejala TB lebih awal secara cepat dan akurat, menggunakan metode Fuzzy
                Tsukamoto dan metode Dempster-shafer.
            </p>
            <a href="/diagnosis"
                class="inline-block mt-6 px-8 py-3 bg-white text-green-600 font-semibold rounded-full border border-green-600 shadow hover:bg-green-100 transition">
                Mulai Diagnosis
            </a>
        </section>

        <section class="mt-16 px-4 lg:px-24 text-center">
            <h2 class="text-3xl font-bold text-green-800 mb-6">Tujuan Sistem?</h2>
            <p class="text-gray-700 max-w-4xl mx-auto text-lg">
                Sistem ini bertujuan memberikan deteksi awal berdasarkan gejala yang anda alami. Hasil diagnosa tidak
                menggantikan pemeriksaan medis langsung.
            </p>
        </section>

        <!-- Tentang TB -->
        <section class="mt-16 px-4 lg:px-24 text-center">
            <h2 class="text-3xl font-bold text-green-800 mb-6">Apa itu Tuberkulosis (TB)?</h2>
            <p class="text-gray-700 max-w-4xl mx-auto text-lg">
                TB adalah penyakit menular yang disebabkan oleh bakteri <em>Mycobacterium tuberculosis</em>. Biasanya
                menyerang paru-paru, namun dapat menyebar ke organ lain. Diagnosis dini sangat penting untuk mencegah
                penyebaran dan meningkatkan peluang kesembuhan.
            </p>
        </section>

        <!-- Alasan Diagnosis Dini -->
        <section class="mt-16 px-4 lg:px-24">
            <h2 class="text-2xl font-semibold text-green-700 text-center mb-10">
                Mengapa Diagnosis Dini Itu Penting?
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                <div
                    class="p-6 bg-white rounded-xl border border-green-200 shadow-[0_10px_0px_#16a34a] hover:shadow-[0_12px_0px_#15803d] transition duration-300">
                    <img src="/img/virus.png" alt="Icon Pencegahan" class="w-30 h-24 mx-auto mb-4">
                    <h3 class="font-semibold text-xl text-green-700">Mencegah Penularan</h3>
                    <p class="text-gray-600">
                        TB dapat menular melalui udara. Diagnosis awal dapat melindungi orang sekitar.
                    </p>
                </div>
                <div
                    class="p-6 bg-white rounded-xl border border-green-200 shadow-[0_10px_0px_#16a34a] hover:shadow-[0_12px_0px_#15803d] transition duration-300">
                    <img src="/img/periksa.png" alt="Icon Pengobatan" class="w-30 h-24 mx-auto mb-4">
                    <h3 class="font-semibold text-xl text-green-700">Pengobatan Lebih Efektif</h3>
                    <p class="text-gray-600">
                        Semakin cepat ditangani, pengobatan TB menjadi lebih efektif dan efisien.
                    </p>
                </div>
                <div
                    class="p-6 bg-white rounded-xl border border-green-200 shadow-[0_10px_0px_#16a34a] hover:shadow-[0_12px_0px_#15803d] transition duration-300">
                    <img src="/img/kesehatan.png" alt="Icon Kesehatan" class="w-30 h-24 mx-auto mb-4">
                    <h3 class="font-semibold text-xl text-green-700">Tingkat Kesembuhan Tinggi</h3>
                    <p class="text-gray-600">
                        Diagnosis dini meningkatkan kemungkinan pasien sembuh total.
                    </p>
                </div>
            </div>
        </section>



        <!-- Cara Kerja -->
        <section class="mt-20 px-4 lg:px-24 text-center">
            <h2 class="text-3xl font-bold text-green-800 mb-6">Bagaimana Sistem Ini Bekerja?</h2>
            <p class="text-gray-700 max-w-3xl mx-auto mb-8">
                Sistem ini menggunakan algoritma <strong>Fuzzy Tsukamoto</strong> untuk menganalisis gejala yang Anda
                masukkan dan algoritma <strong>Dempster-shafer</strong> untuk menganalisis risiko yang dirasakan oleh
                anda.
            </p>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div class="py-6">
                    <div
                        class="w-10 h-10 flex items-center justify-center rounded bg-green-600 text-white mx-auto mb-2">
                        1
                    </div>
                    <p class="font-semibold">Input Gejala</p>
                    <p class="text-sm text-gray-600">Pengguna memilih gejala yang dirasakan.</p>
                </div>
                <div class="py-6">
                    <div
                        class="w-10 h-10 flex items-center justify-center rounded bg-green-600 text-white mx-auto mb-2">
                        2
                    </div>
                    <p class="font-semibold">Pemrosesan</p>
                    <p class="text-sm text-gray-600">Sistem melakukan inferensi menggunakan metode fuzzy.</p>
                </div>
                <div class="py-6">
                    <div
                        class="w-10 h-10 flex items-center justify-center rounded bg-green-600 text-white mx-auto mb-2">
                        3
                    </div>
                    <p class="font-semibold">Analisis Risiko</p>
                    <p class="text-sm text-gray-600">Sistem menganalisis risiko menggunakan metode Dempster-Shafer.</p>
                </div>
                <div class="py-6">
                    <div
                        class="w-10 h-10 flex items-center justify-center rounded bg-green-600 text-white mx-auto mb-2">
                        4
                    </div>
                    <p class="font-semibold">Hasil Diagnosa</p>
                    <p class="text-sm text-gray-600">Sistem menampilkan kemungkinan kondisi TB berdasarkan gejala.</p>
                </div>
            </div>


        </section>

        <!-- Statistik Penyakit TB di Kecamatan -->
        <section class="mt-20 px-4 lg:px-24 text-center">
            <h2 class="text-3xl font-bold text-green-800 mb-6">Statistik Penyakit TB di Kecamatan Cugenang</h2>
            <p class="text-gray-700 max-w-4xl mx-auto mb-8">
                Berikut adalah data statistik terkini mengenai penyakit Tuberkulosis (TB) di kecamatan Cugenang :
            </p>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div
                    class="p-6 bg-white rounded-xl border border-green-200 shadow-[0_10px_0px_#16a34a] hover:shadow-[0_12px_0px_#15803d] transition duration-300">
                    <h3 class="text-xl font-semibold text-green-700">Jumlah Kasus</h3>
                    <p class="text-lg text-gray-600">350 Kasus TB terdeteksi tahun ini di kecamatan Cugenang.</p>
                </div>
                <div
                    class="p-6 bg-white rounded-xl border border-green-200 shadow-[0_10px_0px_#16a34a] hover:shadow-[0_12px_0px_#15803d] transition duration-300">
                    <h3 class="text-xl font-semibold text-green-700">Tingkat Penyebaran</h3>
                    <p class="text-lg text-gray-600">Tingkat penyebaran TB di kecamatan Cugenang mencapai 5% per tahun.
                    </p>
                </div>
                <div
                    class="p-6 bg-white rounded-xl border border-green-200 shadow-[0_10px_0px_#16a34a] hover:shadow-[0_12px_0px_#15803d] transition duration-300">
                    <h3 class="text-xl font-semibold text-green-600">Pasien yang Sembuh</h3>
                    <p class="text-lg text-gray-600">80% pasien TB di kecamatan Cugenang berhasil sembuh dengan
                        pengobatan yang tepat.</p>
                </div>
            </div>
        </section>


    </div>

    <div class="mt-16">
        <x-footer></x-footer>
    </div>
</body>

</html>
