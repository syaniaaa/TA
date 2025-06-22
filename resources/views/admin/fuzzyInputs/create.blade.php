<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Kelola Bobot Gejala') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="post" action="{{ route('fuzzy_input.store') }}" class="mt-6 space-y-6">
                        @csrf

                        <!-- Input Symptom -->
                        <div class="max-w-xl">
                            <x-input-label for="symptom_id" value="Gejala" />
                            <select id="symptom_id" name="symptom_id" class="mt-1 block w-full" required>
                                @foreach ($symptoms as $id => $nama)
                                    <option value="{{ $id }}"
                                        {{ old('symptom_id') == $id ? 'selected' : '' }}>{{ $nama }}</option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('symptom_id')" />
                        </div>

                        <!-- Input Rentang -->
                        <div class="max-w-xl">
                            <x-input-label value="Isi rentang nilai:" />
                            <div class="flex space-x-2">
                                <div class="flex-1">
                                    <x-input-label for="min" value="Dari" class="text-sm text-gray-500" />
                                    <x-text-input id="min" type="number" name="min" class="mt-1 block w-full"
                                        value="{{ old('min') }}" required step="0.01" min="0"
                                        max="100" />
                                    <x-input-error class="mt-2" :messages="$errors->get('min')" />
                                </div>
                                <div class="flex-1">
                                    <x-input-label for="max" value="Sampai" class="text-sm text-gray-500" />
                                    <x-text-input id="max" type="number" name="max" class="mt-1 block w-full"
                                        value="{{ old('max') }}" required step="0.01" min="0" />
                                    <x-input-error class="mt-2" :messages="$errors->get('max')" />
                                </div>
                            </div>
                        </div>

                        <!-- Input Unit -->
                        <div class="max-w-xl">
                            <x-input-label for="unit" value="Unit" />
                            <select id="unit" name="unit" class="mt-1 block w-full" required>
                                <option value="Hari" {{ old('unit') == 'Hari' ? 'selected' : '' }}>Hari</option>
                                <option value="Kg" {{ old('unit') == 'Kg' ? 'selected' : '' }}>Kg</option>
                                <option value="Cm" {{ old('unit') == 'Cm' ? 'selected' : '' }}>Cm</option>
                                <option value="Skala" {{ old('unit') == 'Skala' ? 'selected' : '' }}>Skala</option>
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('unit')" />
                        </div>

                        <!-- Tombol Simpan -->
                        <div>
                            <x-secondary-button tag="a"
                                href="{{ route('fuzzy_input') }}">Kembali</x-secondary-button>
                            <x-primary-button name="save_and_create" value="true">Simpan & Buat</x-primary-button>
                            <x-primary-button name="save" value="true">Simpan</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
