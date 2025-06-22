<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Laporan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('report') }}" method="GET">
                        @csrf
                        <h1 class="text-xl font-bold text-center pt-2">Form Laporan</h1>
                        <div class="flex space-x-4 mt-4 justify-center max-w-2xl mx-auto">
                            <div class="w-full">
                                <x-input-label for="start_date" value="Dari Tanggal :" />
                                <x-text-input id="start_date" type="date" name="start_date" class="mt-1 block w-full"
                                    value="{{ old('start_date') }}" required />
                                <x-input-error class="mt-2" :messages="$errors->get('start_date')" />
                            </div>
                            <div class="w-full">
                                <x-input-label for="end_date" value="Sampai Tanggal :" />
                                <x-text-input id="end_date" type="date" name="end_date" class="mt-1 block w-full"
                                    value="{{ old('end_date') }}" required />
                                <x-input-error class="mt-2" :messages="$errors->get('end_date')" />
                            </div>
                        </div>

                        <div class="mt-6 flex justify-center space-x-4">
                            <x-primary-button class="px-6 py-2" type="submit">Cari</x-primary-button>
                            {{-- <x-primary-button class="px-6 py-2">
                                <a href="{{ route('reports.print') }}" target="_blank">Cetak PDF</a>
                            </x-primary-button> --}}
                        </div>
                    </form>

                    @if (isset($diagnoses) && $diagnoses->count())
                        <div class="mt-6">
                            <h2 class="text-lg font-semibold text-gray-700 dark:text-white">Hasil Pencarian</h2>
                            <x-table>
                                <x-slot name="header">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Hasil</th>
                                        <th>Tanggal</th>
                                    </tr>
                                </x-slot>
                                @php $num = 1; @endphp
                                @foreach ($diagnoses as $diagnosis)
                                    <tr>
                                        <td>{{ $num++ }} </td>
                                        <td>{{ $diagnosis->user->name }}</td>
                                        <td>{{ $diagnosis->hasil }}</td>
                                        <td>{{ \Carbon\Carbon::parse($diagnosis->tanggal)->format('d-m-Y') }}</td>
                                    </tr>
                                @endforeach
                            </x-table>
                        @else
                            <div class="mt-6">
                                <p class="text-center">Tidak ada data yang ditemukan.</p>
                            </div>
                    @endif
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
