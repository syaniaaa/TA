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

        <form action="{{ route('diagnosis.symptomTest.store') }}" method="POST"
            class="max-w-4xl mx-auto mt-10 space-y-8 px-4">
            @csrf

            <section class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-bold mb-6 text-gray-700">Pertanyaan Gejala</h2>

                @foreach ($symptoms as $index => $symptom)
                    <div class="mb-6 border-b pb-4">
                        <label class="block font-semibold text-gray-800 mb-2">
                            {{ $loop->iteration }}. Apakah Anda mengalami <span
                                class="text-green-700">{{ $symptom->nama }}</span>?
                        </label>

                        <div class="space-y-2 pl-4">
                            @foreach ($symptom->fuzzySets as $fuzzySet)
                                <div class="flex items-center gap-2">
                                    <input class="form-check-input rounded text-green-600 focus:ring-green-500"
                                        type="checkbox" value="{{ $fuzzySet->id }}"
                                        name="jawaban[{{ $symptom->id }}][]" id="fuzzy_{{ $fuzzySet->id }}">
                                    <label for="fuzzy_{{ $fuzzySet->id }}" class="text-gray-700">
                                        {{ $fuzzySet->kategori }} <span
                                            class="text-sm text-gray-500">({{ $fuzzySet->domain }})</span>
                                    </label>
                                </div>
                            @endforeach
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
        </form>



    </div>

    <div class="mt-16">
        <x-footer></x-footer>
    </div>

</body>

</html>
