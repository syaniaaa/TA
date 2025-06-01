<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Halaman Diagnosis</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- <script>
        // Fungsi untuk menangani perubahan pada opsi "Ya" dan "Tidak"
        function toggleForm(symptomId) {
            const yesOption = document.getElementById('yes_' + symptomId);
            const formInput = document.getElementById('input_' + symptomId);
            if (yesOption.checked) {
                formInput.style.display = 'block'; // Menampilkan form input
            } else {
                formInput.style.display = 'none'; // Menyembunyikan form input
            }
        }
    </script> --}}
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

        <section class="mt-20 px-10">
            <div class="max-w-4xl mx-auto">
                <x-stepper></x-stepper>

            </div>
        </section>

        {{-- <form action="{{ route('diagnosis.symptomTest.store') }}" method="POST"
            class="max-w-4xl mx-auto mt-10 space-y-8 px-4">
            @csrf

            <section class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-bold mb-6 text-gray-700">Pertanyaan Gejala</h2>

                @foreach ($symptoms as $index => $symptom)
                    @php
                        $fuzzyInput = $symptom->fuzzyInputs->first();
                    @endphp
                    <div class="mb-6 border-b pb-4">
                        <label class="block font-semibold text-gray-800 mb-2">
                            {{ $loop->iteration }}. Apakah Anda mengalami <span
                                class="text-green-700">{{ $symptom->nama }}</span>?
                        </label>

                        <div class="space-y-2 pl-4">
                            <div class="flex items-center gap-4">
                                <label for="yes_{{ $symptom->id }}">
                                    <input type="radio" name="jawaban[{{ $symptom->id }}]" value="yes"
                                        id="yes_{{ $symptom->id }}" onclick="toggleForm({{ $symptom->id }})">
                                    Ya
                                </label>
                                <label for="no_{{ $symptom->id }}">
                                    <input type="radio" name="jawaban[{{ $symptom->id }}]" value="no"
                                        id="no_{{ $symptom->id }}" onclick="toggleForm({{ $symptom->id }})">
                                    Tidak
                                </label>
                            </div>

                            <div id="input_{{ $symptom->id }}" class="mt-4 hidden">
                                @if ($fuzzyInput)
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Berapa
                                        {{ $fuzzyInput->unit == 'skala' ? '(skala 1-10)' : '(' . $fuzzyInput->unit . ')' }}
                                        yang Anda rasakan?
                                    </label>

                                    <x-text-input id="field_{{ $symptom->id }}" type="number"
                                        name="jawaban_input[{{ $symptom->id }}]" class="mt-1 block w-full"
                                        step="{{ $fuzzyInput->unit == 'skala' ? 1 : 'any' }}"
                                        min="{{ $fuzzyInput->unit == 'skala' ? 1 : null }}"
                                        max="{{ $fuzzyInput->unit == 'skala' ? 10 : null }}"
                                        placeholder="{{ $fuzzyInput->unit == 'hari'
                                            ? 'Masukkan jumlah hari'
                                            : ($fuzzyInput->unit == 'kg'
                                                ? 'Masukkan berat (kg)'
                                                : ($fuzzyInput->unit == 'skala'
                                                    ? 'Masukkan angka antara 1 - 10'
                                                    : 'Masukkan nilai')) }}"
                                        required />

                                    <x-input-error class="mt-2" :messages="$errors->get('jawaban_input.{{ $symptom->id }}')" />
                                @else
                                    <p class="text-red-600 text-sm">Tidak ada input fuzzy untuk gejala ini.</p>
                                @endif

                                <x-input-error class="mt-2" :messages="$errors->get('jawaban_input.{{ $symptom->id }}')" />
                            </div>
                        </div>
                    </div>
                @endforeach
            </section>

            <div class="pt-4 flex flex-col sm:flex-row sm:justify-between gap-4">
                <!-- Tombol Simpan -->
                <button type="submit"
                    class="w-full sm:w-auto bg-green-600 hover:bg-green-600 text-white font-semibold py-2 px-6 rounded-xl transition duration-200">
                    Simpan
                </button>

                <!-- Tombol Lanjutkan -->
                <a href="{{ route('diagnosis.riskTest') }}"
                    class="w-full sm:w-auto text-center bg-white hover:bg-green-300 text-green-600 font-semibold py-2 px-6 rounded-xl transition duration-200
                    shadow-lg hover:shadow-2xl outline-none hover:outline-2 hover:outline-green-600">
                    Lanjutkan
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 inline-block text-green-600 ml-2"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M12 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </form> --}}
        <section class="mt-10 px-10">
            <div class="max-w-4xl mx-auto bg-white p-6 rounded-xl shadow-md">
                <h2 class="text-xl font-semibold mb-4 text-gray-700">Pilih Gejala yang Dirasakan</h2>

                <form method="POST" action="{{ route('diagnosis.symptomTest.store') }}">
                    @csrf
                    <div class="space-y-4 text-gray-800">
                        @foreach ($symptoms as $symptom)
                            <div x-data="{ checked: false }" class="mb-4">
                                <label class="flex items-center space-x-3">
                                    <input type="checkbox" name="jawaban[{{ $symptom->id }}][checked]" value="1"
                                        x-model="checked"
                                        class="form-checkbox h-5 w-5 text-green-600 transition duration-150 ease-in-out">
                                    <span class="text-sm">{{ $symptom->nama }}</span>
                                </label>

                                <div x-show="checked" class="ml-8 mt-2">
                                    <label class="block text-sm font-medium text-gray-600 mb-1">
                                        Berapa {{ $symptom->FuzzyInputs->first()->unit ?? '...' }} ?
                                    </label>
                                    <div class="flex items-center gap-2">
                                        <input type="number" name="jawaban[{{ $symptom->id }}][nilai]" min="0"
                                            placeholder="Masukkan nilai"
                                            class="w-full p-2 border border-gray-300 rounded">
                                        {{-- <span class="text-gray-600 text-sm">
                                            {{ $symptom->FuzzyInputs->first()->unit ?? '' }}
                                        </span> --}}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="pt-4 flex flex-col sm:flex-row sm:justify-end gap-4">
                        <a href="{{ route('diagnosis.riskTest') }}"
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

        <script src="//unpkg.com/alpinejs" defer></script>



    </div>

    <div class="mt-16">
        <x-footer></x-footer>
    </div>
</body>

</html>
