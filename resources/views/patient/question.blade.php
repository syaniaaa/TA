<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-white">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Halaman Tanya Jawab Seputar TB</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="font-inter">
    <x-navbar></x-navbar>

    <div class="mt-24">


        <section class="pt-10 px-4 lg:px-24 text-center">
            <h2 class="text-3xl font-bold text-green-800 mb-6">Kumpulan jawaban yang sering ditanyakan terkait TB</h2>

            <br>


            <div class="space-y-4 text-left max-w-4xl mx-auto">
                <details class="border rounded-lg shadow" open>
                    <summary
                        class="flex justify-between items-center px-6 py-4 hover:bg-gray-100 font-semibold text-lg text-green-700">
                        <span>Apa itu Tuberkulosis (TB)?</span>
                        <span class="text-xl">⌄</span>
                    </summary>
                    <div class="px-6 py-4 bg-white text-gray-700 border-t">
                        Tuberkulosis (TB) adalah penyakit menular yang disebabkan oleh bakteri <em>Mycobacterium
                            tuberculosis</em>, biasanya menyerang paru-paru.
                    </div>
                </details>

                <details class="border rounded-lg shadow">
                    <summary
                        class="flex justify-between items-center px-6 py-4 hover:bg-gray-100 font-semibold text-lg text-green-700">
                        <span>Apa saja gejala umum TB?</span>
                        <span class="text-xl">⌄</span>
                    </summary>
                    <div class="px-6 py-4 bg-white text-gray-700 border-t">
                        Batuk berdahak lebih dari 2 minggu, demam, berat badan turun, berkeringat di malam hari, dan
                        lemas.
                    </div>
                </details>

                <details class="border rounded-lg shadow" open>
                    <summary
                        class="flex justify-between items-center px-6 py-4 hover:bg-gray-100 font-semibold text-lg text-green-700">
                        <span> Apakah TB bisa disembuhkan?</span>
                        <span class="text-xl">⌄</span>
                    </summary>
                    <div class="px-6 py-4 bg-white text-gray-700 border-t">
                        Ya, TB bisa disembuhkan dengan pengobatan yang teratur selama minimal 6 bulan sesuai anjuran
                        tenaga kesehatan.
                    </div>
                </details>

                <details class="border rounded-lg shadow">
                    <summary
                        class="flex justify-between items-center px-6 py-4 hover:bg-gray-100 font-semibold text-lg text-green-700">
                        <span> Bagaimana cara mencegah penularan TB?</span>
                        <span class="text-xl">⌄</span>
                    </summary>
                    <div class="px-6 py-4 bg-white text-gray-700 border-t">
                        Menghindari kontak erat dengan pasien TB aktif, menggunakan masker, ventilasi yang baik, dan
                        pengobatan segera bagi penderita.
                    </div>
                </details>

                <details class="border rounded-lg shadow">
                    <summary
                        class="flex justify-between items-center px-6 py-4 hover:bg-gray-100 font-semibold text-lg text-green-700">
                        <span> Apakah pengobatan TB gratis?</span>
                        <span class="text-xl">⌄</span>
                    </summary>
                    <div class="px-6 py-4 bg-white text-gray-700 border-t">
                        Ya, pengobatan TB dasar disediakan gratis oleh pemerintah di Puskesmas dan fasilitas kesehatan
                        yang bekerja sama.
                    </div>
                </details>

            </div>
        </section>

    </div>

    <div class="mt-16">
        <x-footer></x-footer>
    </div>
</body>

</html>
