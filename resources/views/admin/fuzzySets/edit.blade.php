<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Kelola Fuzzy Set') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="post" action="{{ route('fuzzy_set.update', $fuzzy_set->id) }}" class="mt-6 space-y-6">
                        @csrf
                        @method('PATCH')

                        <div class="max-w-xl">
                            <x-input-label for="symptom_id" value="Nama Gejala" />
                            <select name="symptom_id" id="symptom_id" class="mt-1 block w-full">
                                @foreach ($symptoms as $id => $nama)
                                    <option value="{{ $id }}"
                                        {{ $fuzzy_set->symptom_id == $id ? 'selected' : '' }}>
                                        {{ $nama }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('symptom_id')" />
                        </div>

                        <div class="max-w-xl">
                            <x-input-label for="kategori" value="Kategori" />
                            <x-text-input id="kategori" type="text" name="kategori" class="mt-1 block w-full"
                                value="{{ old('kategori', $fuzzy_set->kategori) }}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('kategori')" />
                        </div>

                        <div class="max-w-xl">
                            <x-input-label for="min" value="Nilai Minimum (min)" />
                            <x-text-input id="min" type="number" step="any" name="min"
                                class="mt-1 block w-full" value="{{ old('min', $fuzzy_set->min) }}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('min')" />
                        </div>

                        <div class="max-w-xl">
                            <x-input-label for="max" value="Nilai Maksimum (max)" />
                            <x-text-input id="max" type="number" step="any" name="max"
                                class="mt-1 block w-full" value="{{ old('max', $fuzzy_set->max) }}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('max')" />
                        </div>

                        <div class="max-w-xl">
                            <x-input-label for="unit" value="Unit" />
                            <select id="unit" name="unit" class="mt-1 block w-full">
                                <option value="hari" {{ old('unit', $fuzzy_set->unit) == 'hari' ? 'selected' : '' }}>
                                    Hari</option>
                                <option value="kg" {{ old('unit', $fuzzy_set->unit) == 'kg' ? 'selected' : '' }}>
                                    Kilogram (kg)</option>
                                <option value="cm" {{ old('unit', $fuzzy_set->unit) == 'cm' ? 'selected' : '' }}>
                                    Centimeter (cm)</option>
                                <option value="skala"
                                    {{ old('unit', $fuzzy_set->unit) == 'skala' ? 'selected' : '' }}>Skala</option>
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('unit')" />
                        </div>


                        <div class="flex space-x-2">
                            <x-secondary-button tag="a"
                                href="{{ route('fuzzy_set') }}">Kembali</x-secondary-button>
                            <x-tertiary-button value="true">Update</x-tertiary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
