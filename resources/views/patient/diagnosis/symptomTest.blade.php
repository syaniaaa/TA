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

        <section class="mt-20 px-10">
            <div class="max-w-4xl mx-auto">
                <x-stepper></x-stepper>

            </div>
        </section>


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
