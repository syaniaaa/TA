
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-poppins font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Kelola Bobot Gejala') }}
            </h2>
        </x-slot>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white light:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-black dark:text-black">
                        <div class="flex justify-between items-center px-6 py-4">
                            <x-primary-button tag="a" href="{{ route('fuzzy_input.create') }}"
                                class="inline-flex items-center px-4 py-2 bg-green-500 hover:bg-green-700 text-white text-sm font-semibold rounded-xl shadow-md transition transform hover:scale-105"><svg
                                    class="w-4 h-4 text-gray-100 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="4" d="M5 12h14m-7 7V5" />
                                </svg>
                                Tambah</x-primary-button>


                            <div class="relative max-w-xs">
                                {{-- Search --}}
                                <form action="{{ route('fuzzy_input.search') }}" method="GET" class="flex">
                                    <div class="relative">
                                        <input type="text" name="query" id="hs-table-search"
                                            class="font-poppins text-sm peer py-2 pl-4 pr-10 w-64 border border-gray-300 rounded-full shadow-md transition-all duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-white placeholder-gray-500 dark:placeholder-neutral-500"
                                            placeholder="Cari Aturan Gejala...">
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
                                <tr>
                                    <th>No</th>
                                    <th>Nama Gejala</th>
                                    <th>Himpunan</th>
                                    <th>Domain</th>
                                    <th>Aksi</th>
                                </tr>
                                </x-slot>
                                @php $num=1; @endphp
                                @foreach ($fuzzy_inputs as $fuzzy_input)
                                <tr>
                                    <td>{{ $num++ }} </td>
                                    <td>{{ $fuzzy_input->symptom ? $fuzzy_input->symptom->nama : 'Gejala tidak ditemukan' }}</td>
                                    <td>{{ $fuzzy_input->himpunan}}</td>
                                    <td>
                                        @if($fuzzy_input->max)
                                            {{ $fuzzy_input->min }} - {{ $fuzzy_input->max }} {{ $fuzzy_input->unit }}
                                        @else
                                            > {{ $fuzzy_input->min }} {{ $fuzzy_input->unit }}
                                        @endif
                                    </td>
                                    <td class="flex space-x-2">
                                        <x-tertiary-button tag="a"
                                            class="inline-flex items-center px-3 py-1 bg-yellow-400 hover:bg-yellow-500 text-white text-sm font-medium rounded-xl shadow-sm transition transform hover:scale-105"
                                            href="{{ route('fuzzy_input.edit', $fuzzy_input->id) }}">
                                            <svg class="w-4 h-4 mr-1 text-white" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15.232 5.232l3.536 3.536M4 20h4l10-10-4-4L4 16v4z" />
                                            </svg>
                                            Edit
                                        </x-tertiary-button>

                                        <x-danger-button x-data=""
                                            class="inline-flex items-center px-3 py-1 bg-red-500 hover:bg-red-600 text-white text-sm font-medium rounded-xl shadow-sm transition transform hover:scale-105"
                                            x-on:click.prevent="$dispatch('open-modal', 'confirm-menu-deletion')"
                                            x-on:click="$dispatch('set-action', '{{ route('fuzzy_input.destroy', $fuzzy_input->id) }}')">
                                            <svg class="w-4 h-4 text-gray-100 dark:text-white" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                                            </svg>
                                            Hapus
                                        </x-danger-button>

                                    </td>
                                </tr>
                            @endforeach
                        </x-table>

                        <x-modal name="confirm-menu-deletion" focusable maxWidth="xl">
                            <form method="post" x-bind:action="action" class="p-6">
                                @csrf
                                @method('delete')
                                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                    {{ __('Apakah anda yakin akan menghapus data?') }}
                                </h2>
                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                    {{ __('Setelah proses dilaksanakan. Data akan dihilangkan secara permanen.') }}
                                </p>
                                <div class="mt-6 flex justify-end">
                                    <x-secondary-button x-on:click.prevent="$dispatch('close')">
                                        {{ __('Batal') }}
                                    </x-secondary-button>
                                    <x-danger-button class="ml-3">
                                        {{ __('Hapus') }}
                                    </x-danger-button>
                                </div>
                            </form>
                        </x-modal>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
