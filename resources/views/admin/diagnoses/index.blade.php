<x-app-layout>
    <x-slot name="header">
        <h2 class="font-poppins font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Hasil Diagnosis') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white light:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-black dark:text-black">
                    <div class="flex justify-between items-center px-6 py-4">
                        <x-table>
                            <x-slot name="header">
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Tanggal Tes</th>
                                    <th>Hasil</th>
                                    <th>Aksi</th>
                                </tr>
                            </x-slot>
                            @php $num=1; @endphp
                            @foreach ($diagnoses as $diagnosis)
                                <tr>
                                    <td>{{ $num++ }} </td>
                                    <td>{{ $diagnosis->nama_pasien }}</td>
                                    <td>{{ $diagnosis->tgl_lahir }}</td>
                                    <td>{{ $diagnosis->kelamin }}</td>
                                    <td>{{ $diagnosis->tanggal }}</td>
                                    <td>{{ $diagnosis->hasil }}</td>
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
                                            Edit
                                        </x-tertiary-button>
                                    </td>
                                </tr>
                            @endforeach
                        </x-table>
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>
