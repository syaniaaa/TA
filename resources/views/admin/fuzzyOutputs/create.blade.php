<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Kelola Bobot Penyakit') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="post" action="{{ route('fuzzy_output.store') }}" class="mt-6 space-y-6">
                        @csrf

                        <!-- Input disease -->
                        <div class="max-w-xl">
                            <x-input-label for="disease_id" value="Penyakit" />
                            <select id="disease_id" name="disease_id" class="mt-1 block w-full" required>
                                @foreach ($diseases as $id => $nama)
                                    <option value="{{ $id }}"
                                        {{ old('disease_id') == $id ? 'selected' : '' }}>{{ $nama }}</option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('disease_id')" />
                        </div>

                        <!-- Input Kategori -->
                        <div class="max-w-xl">
                            <x-input-label for="kategori" value="Kategori" />
                            <select id="kategori" name="kategori"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200"
                                required>
                                <option value="rendah" {{ old('kategori') == 'rendah' ? 'selected' : '' }}>Rendah
                                </option>
                                <option value="sedang" {{ old('kategori') == 'sedang' ? 'selected' : '' }}>Sedang
                                </option>
                                <option value="tinggi" {{ old('kategori') == 'tinggi' ? 'selected' : '' }}>Tinggi
                                </option>
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('kategori')" />
                        </div>


                        <!-- Input Min -->
                        <div class="max-w-xl">
                            <x-input-label for="min" value="Min" />
                            <x-text-input id="min" type="number" name="min" class="mt-1 block w-full"
                                value="{{ old('min') }}" required step="0.01" min="0" max="100" />
                            <x-input-error class="mt-2" :messages="$errors->get('min')" />
                        </div>

                        <!-- Input Max -->
                        <div class="max-w-xl">
                            <x-input-label for="max" value="Max" />
                            <x-text-input id="max" type="number" name="max" class="mt-1 block w-full"
                                value="{{ old('max') }}" required step="0.01" min="0" />
                            <x-input-error class="mt-2" :messages="$errors->get('max')" />
                        </div>

                        <div>
                            <x-secondary-button tag="a"
                                href="{{ route('fuzzy_output') }}">Kembali</x-secondary-button>
                            <x-primary-button name="save_and_create" value="true">Simpan & Buat</x-primary-button>
                            <x-primary-button name="save" value="true">Simpan</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
