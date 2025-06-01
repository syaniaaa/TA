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
            style="background-image: linear-gradient(to right, rgba(32, 232, 152))">
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

        {{-- <section class="mt-10 px-10">
            <div class="max-w-4xl mx-auto bg-white p-6 rounded-xl shadow-md">
                <h2 class="text-xl font-semibold mb-4 text-gray-700">Pilih Risiko yang Diketahui</h2>
                <form method="POST" action="#">
                    <div class="space-y-4 text-gray-800">
                        <label class="flex items-center space-x-3">
                            <input type="checkbox" name="risiko[]" value="HIV/AIDS"
                                class="form-checkbox h-5 w-5 text-green-600 transition duration-150 ease-in-out">
                            <span class="text-sm">HIV/AIDS</span>
                        </label>
                        <label class="flex items-center space-x-3">
                            <input type="checkbox" name="risiko[]" value="Tempat tinggal"
                                class="form-checkbox h-5 w-5 text-green-600 transition duration-150 ease-in-out">
                            <span class="text-sm">Tempat tinggal</span>
                        </label>
                    </div>
                </form>
            </div>
        </section> --}}

        <section class="mt-10 px-10">
            <div class="max-w-4xl mx-auto bg-white p-6 rounded-xl shadow-md">
                <h2 class="text-xl font-semibold mb-4 text-gray-700">Pilih Risiko yang Dirasakan</h2>

                <form method="POST" action="{{ route('diagnosis.riskTest.store3') }}">
                    @csrf
                    <div class="space-y-4 text-gray-800">
                        @foreach ($risks as $risk)
                            <label class="flex items-center space-x-3">
                                <input type="checkbox" name="jawaban[risiko][]" value="{{ $risk->id }}"
                                    class="form-checkbox h-5 w-5 text-green-600 transition duration-150 ease-in-out">
                                <span class="text-sm">{{ $risk->nama }}</span>
                            </label>
                        @endforeach
                    </div>

                    <div class="pt-4 flex flex-col sm:flex-row sm:justify-end gap-4">
                        <a href="{{ route('diagnosis.result') }}"
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
