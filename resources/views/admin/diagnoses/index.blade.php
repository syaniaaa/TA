<x-app-layout>
    <x-slot name="header">
        <h2 class="font-poppins font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Kelola Diagnosis') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white light:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-black dark:text-black">
                    <div class="flex justify-end items-center px-6 py-4">
                        <div class="relative max-w-xs">
                            <form action="{{ route('diagnosis.search') }}" method="GET" class="flex">
                                <div class="relative">
                                    <input type="text" name="query" id="hs-table-search"
                                        class="font-poppins text-sm peer py-2 pl-4 pr-10 w-64 border border-gray-300 rounded-full shadow-md transition-all duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-white placeholder-gray-500 dark:placeholder-neutral-500"
                                        placeholder="Cari Hasil Diagnosis...">
                                    <button type="submit"
                                        class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 hover:text-blue-600 transition-colors">
                                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z" />
                                        </svg>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <br>

                    <x-table>
                        <x-slot name="header">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Hasil</th>
                                    <th>Penyakit</th>
                                    <th>Tanggal Tes</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                        </x-slot>
                        <tbody>
                            @php $num = 1; @endphp
                            @foreach ($diagnoses as $diagnosis)
                                <tr>
                                    <td>{{ $num++ }}</td>
                                    <td>{{ $diagnosis->user->name ?? '-' }}</td>
                                    <td>{{ $diagnosis->hasil }}</td>
                                    <td>{{ $diagnosis->tingkat_kemungkinan }} {{ $diagnosis->fuzzyOutput->disease->nama }} </td>
                                    <td>{{ $diagnosis->tanggal }}</td>
                                    <td class="flex space-x-2">
                                        <x-tertiary-button tag="a"
                                            class="inline-flex items-center px-3 py-1 bg-yellow-400 hover:bg-yellow-500 text-white text-sm font-medium rounded-xl shadow-sm transition transform hover:scale-105"
                                            href="{{ route('diagnosis.show', $diagnosis->id) }}">
                                            <svg class="w-4 h-4 mr-1 text-white" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15.232 5.232l3.536 3.536M4 20h4l10-10-4-4L4 16v4z" />
                                            </svg>
                                            Detail
                                        </x-tertiary-button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </x-table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
