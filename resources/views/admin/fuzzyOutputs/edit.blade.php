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
                    <form method="post" action="{{ route('fuzzy_output.update', $fuzzy_output->id) }}" class="mt-6 space-y-6">
                        @csrf
                        @method('PATCH')

                        <div class="max-w-xl">
                            <x-input-label for="disease_id" value="Nama Penyakit" />
                            <select name="disease_id" id="disease_id" class="mt-1 block w-full">
                                @foreach ($diseases as $id => $nama)
                                    <option value="{{ $id }}"
                                        {{ $fuzzy_output->disease_id == $id ? 'selected' : '' }}>
                                        {{ $nama }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('disease_id')" />
                        </div>

                        <div class="max-w-xl">
                            <x-input-label for="himpunan" value="Himpunan" />
                            <x-text-input id="himpunan" type="text" name="himpunan" class="mt-1 block w-full"
                                value="{{ old('himpunan', $fuzzy_output->himpunan) }}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('himpunan')" />
                        </div>

                        <div class="max-w-xl">
                            <x-input-label for="min" value="Nilai Minimum (min)" />
                            <x-text-input id="min" type="number" step="any" name="min"
                                class="mt-1 block w-full" value="{{ old('min', $fuzzy_output->min) }}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('min')" />
                        </div>

                        <div class="max-w-xl">
                            <x-input-label for="max" value="Nilai Maksimum (max)" />
                            <x-text-input id="max" type="number" step="any" name="max"
                                class="mt-1 block w-full" value="{{ old('max', $fuzzy_output->max) }}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('max')" />
                        </div>

                        <div class="flex space-x-2">
                            <x-secondary-button tag="a"
                                href="{{ route('fuzzy_output') }}">Kembali</x-secondary-button>
                            <x-tertiary-button value="true">Update</x-tertiary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
