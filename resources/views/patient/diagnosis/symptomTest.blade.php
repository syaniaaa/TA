<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Halaman Diagnosis</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

                @if (session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        {{ session('error') }}
                    </div>
                @endif

                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif


                <form method="POST" action="{{ route('fuzzy.store') }}">
                    @csrf
                    <div class="space-y-4 text-gray-800">
                        @foreach ($symptoms as $symptom)
                            <div x-data="{ checked: false }" class="mb-4">
                                <label class="flex items-center space-x-3">
                                    <input type="checkbox" x-model="checked" name="gejala[{{ $symptom->id }}]"
                                        value="0"
                                        class="form-checkbox h-5 w-5 text-green-600 transition duration-150 ease-in-out">
                                    <span class="text-sm">{{ $symptom->nama }}</span>
                                </label>

                                <div x-show="checked" x-transition class="ml-8 mt-2">
                                    @php
                                        $unit = $symptom->FuzzyInputs->first()->unit ?? 'Hari';
                                    @endphp

                                    <div class="flex items-center space-x-2 mb-1">
                                        <label class="block text-sm font-medium text-gray-600">
                                            Berapa {{ $unit }} yang Anda rasakan?
                                        </label>

                                        @if ($unit === 'Skala')
                                            <button type="button" onclick="showKeteranganSkala()"
                                                class="text-xs bg-yellow-300 hover:bg-yellow-400 text-gray-800 font-semibold px-2 py-1 rounded">
                                                Keterangan
                                            </button>
                                        @endif
                                    </div>

                                    <input type="number" name="gejala[{{ $symptom->id }}]" min="0"
                                        placeholder="Masukkan Jumlah" class="w-full p-2 border border-gray-300 rounded">
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="pt-4 flex flex-col sm:flex-row sm:justify-end gap-4">
                        <button type="submit"
                            class="w-full sm:w-auto text-center bg-white hover:bg-green-300 text-green-600 font-semibold py-2 px-6 rounded-xl transition duration-200
                                shadow-lg hover:shadow-2xl outline-none hover:outline-2 hover:outline-green-600">
                            Lanjutkan
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 inline-block text-green-600 ml-2"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M12 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </section>

        <script src="//unpkg.com/alpinejs" defer></script>



    </div>

    <div class="mt-16">
        <x-footer></x-footer>
    </div>
    {{-- <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
        });

        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}";
            switch (type) {
                case 'info':
                    Toast.fire({
                        icon: 'info',
                        title: "{{ Session::get('message') }}"
                    });
                    break;
                case 'success':
                    Toast.fire({
                        icon: 'success',
                        title: "{{ Session::get('message') }}"
                    });
                    break;
                case 'warning':
                    Toast.fire({
                        icon: 'warning',
                        title: "{{ Session::get('message') }}"
                    });
                    break;
                case 'error':
                    Toast.fire({
                        icon: 'error',
                        title: "{{ Session::get('message') }}"
                    });
                    break;
                case 'dialog_error':
                    Swal.fire({
                        icon: 'error',
                        title: "Oops!",
                        text: "{{ Session::get('message') }}"
                    });
                    break;
            }
        @endif
    </script> --}}

    <script>
        function showKeteranganSkala() {
            Swal.fire({
                title: 'Keterangan Skala',
                html: `
                    <div class="text-left text-sm">
                        <b>Skala 1–10</b><br>
                        1 = Tidak<br>
                        2–4 = Ringan<br>
                        5–7 = Sedang<br>
                        8–10 = Parah
                    </div>
                `,
                icon: null, // tidak pakai ikon
                showConfirmButton: true,
                confirmButtonText: 'Tutup',
                customClass: {
                    popup: 'rounded-lg p-4', // lebih kecil dan rapi
                    title: 'text-lg font-semibold text-gray-800',
                    confirmButton: 'bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600'
                },
                width: '400px' // lebih kecil
            });
        }
    </script>

</body>

</html>
