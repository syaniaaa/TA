<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-white">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Halaman Tentang</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-inter">
    <x-navbar></x-navbar>

    <div class="mt-24">
        <section class="pt-10 px-4 lg:px-24 text-center">
            <h2 class="text-3xl font-bold text-green-800 mb-6">Tentang Kami</h2>
            <div class="text-gray-700 max-w-4xl mx-auto text-lg space-y-6 text-justify">
                <p>
                    <strong>Sistem Pakar Diagnosa TB</strong> adalah aplikasi berbasis web yang dikembangkan untuk
                    membantu proses
                    identifikasi awal penyakit Tuberkulosis (TB) secara cerdas dan terukur. Sistem ini dirancang untuk
                    digunakan oleh masyarakat umum maupun tenaga kesehatan sebagai alat bantu skrining awal terhadap
                    risiko TB.
                </p>

                <p>Aplikasi ini menggabungkan dua pendekatan kecerdasan buatan:</p>

                <ul class="list-disc list-inside text-left ml-4">
                    <li><strong>Fuzzy Tsukamoto</strong>: digunakan untuk menghitung tingkat keparahan gejala yang
                        dialami pasien. Metode ini memungkinkan penilaian yang fleksibel dan mendekati cara berpikir
                        manusia dalam menangani informasi yang bersifat tidak pasti atau samar.</li>
                    <li><strong>Teori Dempster-Shafer</strong>: digunakan untuk menggabungkan hasil perhitungan fuzzy
                        menjadi suatu tingkat kepercayaan terhadap diagnosis TB. Pendekatan ini memungkinkan
                        penggabungan beberapa evidensi gejala untuk menghasilkan probabilitas risiko secara
                        komprehensif.</li>
                </ul>

                <p><strong>Alur proses sistem ini adalah sebagai berikut:</strong></p>
                <ol class="list-decimal list-inside text-left ml-4">
                    <li>Pengguna mengisi data gejala klinis yang dirasakan.</li>
                    <li>Sistem melakukan penilaian tingkat gejala menggunakan logika fuzzy (Tsukamoto).</li>
                    <li>Nilai hasil fuzzy dijadikan evidensi dan diproses lebih lanjut menggunakan teori
                        Dempster-Shafer.</li>
                    <li>Sistem memberikan hasil berupa tingkat keyakinan terhadap risiko TB.</li>
                </ol>

                <p>
                    Kami percaya bahwa pendekatan ini memberikan nilai tambah dalam mendeteksi TB secara lebih presisi,
                    terutama di wilayah dengan keterbatasan akses medis.
                </p>

                <p>
                    <em>Catatan:</em> Sistem ini bukan untuk menggantikan peran dokter, melainkan sebagai alat bantu
                    skrining awal untuk meningkatkan kesadaran dan kewaspadaan terhadap penyakit TB.
                </p>
            </div>
        </section>
    </div>

    <div class="mt-16">
        <x-footer></x-footer>
    </div>
</body>

</html>
