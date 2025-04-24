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
                    <form method="post" action="{{ route('fuzzy_set.store') }}" class="mt-6 space-y-6">
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

                        <!-- Input Kategori -->
                        <div class="max-w-xl">
                            <x-input-label for="kategori" value="Kategori" />
                            <x-text-input id="kategori" type="text" name="kategori" class="mt-1 block w-full"
                                value="{{ old('kategori') }}" required />
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

                        <div class="max-w-xl">
                            <x-input-label for="unit" value="Unit" />
                            <select id="unit" name="unit" class="mt-1 block w-full" required>
                                <option value="Hari" {{ old('unit') == 'Hari' ? 'selected' : '' }}>Hari</option>
                                <option value="kg" {{ old('unit') == 'kg' ? 'selected' : '' }}>kg</option>
                                <option value="cm" {{ old('unit') == 'cm' ? 'selected' : '' }}>cm</option>
                                <option value="Skala" {{ old('unit') == 'Skala' ? 'selected' : '' }}>Skala</option>
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('unit')" />
                        </div>



                        <div>
                            <x-secondary-button tag="a"
                                href="{{ route('fuzzy_set') }}">Kembali</x-secondary-button>
                            <x-primary-button name="save_and_create" value="true">Simpan & Buat</x-primary-button>
                            <x-primary-button name="save" value="true">Simpan</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
