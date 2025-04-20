<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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


        {{-- <section class="p-10 mt-10 bg-white rounded-xl mx-4 lg:mx-24 shadow-md">
            <h2 class="text-3xl font-bold text-green-700 text-center mb-6">Langkah-langkah Tes Diagnosis</h2>

            <div class="text-left text-gray-700 max-w-3xl mx-auto space-y-6 text-base leading-relaxed text-justify">
                <p><strong>1. Mengisi Data Pribadi:</strong> Isi informasi dasar seperti nama, usia, dan jenis kelamin
                    yang diperlukan untuk proses diagnosis.</p>
                <p><strong>2. Mengisi Gejala yang Dirasakan:</strong> Pilih gejala-gejala yang Anda alami, seperti
                    batuk, demam, atau penurunan berat badan, yang mungkin berhubungan dengan penyakit Tuberkulosis.</p>
                <p><strong>3. Mengisi Risiko yang Dirasakan:</strong> Tentukan faktor risiko yang mungkin Anda miliki,
                    seperti kontak dengan penderita TB, riwayat perjalanan ke daerah endemis, atau kondisi medis lainnya
                    yang berisiko.</p>
                <p><strong>4. Hasil Diagnosis:</strong> Berdasarkan data yang Anda masukkan, sistem akan menghitung
                    kemungkinan Anda terkena Tuberkulosis dan memberikan rekomendasi apakah Anda perlu melakukan
                    pemeriksaan lebih lanjut atau tidak.</p>
            </div>
        </section> --}}

        <section class="p-10 mt-10 bg-white rounded-xl mx-4 lg:mx-24 shadow-md">
            <div class="bg-white shadow-xl rounded-2xl p-8 w-full max-w-2xl mx-auto">
                <h2 class="text-2xl font-bold text-green-700 mb-8 text-center">Isi Data Diri</h2>

                <form action="/profile" method="POST" class="space-y-6">
                    @csrf

                    <!-- Nama -->
                    <div>
                        <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                        <input type="text" id="nama" name="nama"
                            class="w-full border border-gray-300 rounded-xl px-4 py-2 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-400 transition"
                            value="{{ old('nama') }}" placeholder="Nama lengkap">
                        @error('nama')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tanggal Lahir -->
                    <div>
                        <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700 mb-1">Tanggal
                            Lahir</label>
                        <input type="date" id="tanggal_lahir" name="tanggal_lahir"
                            class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-400 transition"
                            value="{{ old('tanggal_lahir') }}">
                        @error('tanggal_lahir')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Jenis Kelamin -->
                    <div>
                        <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700 mb-1">Jenis
                            Kelamin</label>
                        <select id="jenis_kelamin" name="jenis_kelamin"
                            class="w-full border border-gray-300 rounded-xl px-4 py-2 bg-white focus:outline-none focus:ring-2 focus:ring-green-400 transition">
                            <option value="">Pilih jenis kelamin</option>
                            <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>
                                Laki-laki</option>
                            <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>
                                Perempuan</option>
                        </select>
                        @error('jenis_kelamin')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tombol Simpan & Lanjutkan -->
                    <div class="pt-4 flex flex-col sm:flex-row sm:justify-between gap-4">
                        <!-- Tombol Simpan -->
                        <button type="submit"
                            class="w-full sm:w-auto bg-green-600 hover:bg-green-600 text-white font-semibold py-2 px-6 rounded-xl transition duration-200">
                            Simpan
                        </button>

                        <!-- Tombol Lanjutkan -->
                        <a href="{{ route('diagnosis.symptomTest') }}"
                            class="w-full sm:w-auto text-center bg-white hover:bg-green-300 text-green-600 font-semibold py-2 px-6 rounded-xl transition duration-200
                        shadow-lg hover:shadow-2xl outline-none hover:outline-2 hover:outline-green-600">
                            Lanjutkan
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 inline-block text-green-600 ml-2"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M12 5l7 7-7 7"></path>
                            </svg>
                        </a>

                    </div>

                </form>
            </div>
        </section>




    </div>

    <div class="mt-16">
        <x-footer></x-footer>
    </div>

</body>

</html>
