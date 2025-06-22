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
                    <form method="post" action="{{ route('fuzzy_input.update', $fuzzy_input->id) }}"
                        class="mt-6 space-y-6">
                        @csrf
                        @method('PATCH')

                        <!-- Input Gejala -->
                        <div class="max-w-xl">
                            <x-input-label for="symptom_id" value="Nama Gejala" />
                            <select name="symptom_id" id="symptom_id" class="mt-1 block w-full">
                                @foreach ($symptoms as $id => $nama)
                                    <option value="{{ $id }}"
                                        {{ $fuzzy_input->symptom_id == $id ? 'selected' : '' }}>
                                        {{ $nama }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('symptom_id')" />
                        </div>

                        <!-- Input Min -->
                        <div class="max-w-xl">
                            <x-input-label for="min" value="Nilai Minimum (min)" />
                            <x-text-input id="min" type="number" step="any" name="min"
                                class="mt-1 block w-full" value="{{ old('min', $fuzzy_input->min) }}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('min')" />
                        </div>

                        <!-- Input Max -->
                        <div class="max-w-xl">
                            <x-input-label for="max" value="Nilai Maksimum (max)" />
                            <x-text-input id="max" type="number" step="any" name="max"
                                class="mt-1 block w-full" value="{{ old('max', $fuzzy_input->max) }}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('max')" />
                        </div>

                        <!-- Input Unit -->
                        <div class="max-w-xl">
                            <x-input-label for="unit" value="Unit" />
                            <select id="unit" name="unit" class="mt-1 block w-full">
                                <option value="Hari"
                                    {{ old('unit', $fuzzy_input->unit) == 'Hari' ? 'selected' : '' }}>Hari</option>
                                <option value="Kg" {{ old('unit', $fuzzy_input->unit) == 'Kg' ? 'selected' : '' }}>
                                    Kilogram (kg)</option>
                                <option value="Cm" {{ old('unit', $fuzzy_input->unit) == 'Cm' ? 'selected' : '' }}>
                                    Centimeter (cm)</option>
                                <option value="Skala"
                                    {{ old('unit', $fuzzy_input->unit) == 'Skala' ? 'selected' : '' }}>Skala</option>
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('unit')" />
                        </div>

                        <!-- Tombol -->
                        <div class="flex space-x-2">
                            <x-secondary-button tag="a"
                                href="{{ route('fuzzy_input') }}">Kembali</x-secondary-button>
                            <x-tertiary-button>Simpan Perubahan</x-tertiary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
