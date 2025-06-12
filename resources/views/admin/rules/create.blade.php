<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Kelola Aturan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="post" action="{{ route('rule.store') }}" class="space-y-6">
                        @csrf

                        <div class="max-w-xl">
                            <x-input-label for="kode_aturan" value="Kode Aturan" />
                            <x-text-input id="kode_aturan" type="text" name="kode_aturan" class="mt-1 block w-full"
                                value="{{ old('kode_aturan') }}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('kode_aturan')" />
                        </div>

                        <div class="max-w-xl mt-6">
                            <x-input-label value="Gejala dan Himpunan" />
                            @foreach ($fuzzy_inputs as $input)
                                <div class="flex items-center space-x-4 mt-2">
                                    <label class="w-1/2">{{ $input->symptom->nama ?? 'Nama Gejala' }}</label>
                                    <input type="checkbox" name="fuzzy_input_ids[]" value="{{ $input->id }}"
                                        class="form-checkbox h-5 w-5 text-green-600 transition duration-150 ease-in-out">
                                    <span>{{ $input->himpunan }}</span>
                                </div>
                            @endforeach
                            <x-input-error class="mt-2" :messages="$errors->get('fuzzy_input_ids')" />
                        </div>


                        <div class="max-w-xl mt-6">
                            <x-input-label for="fuzzy_output_id" value="Penyakit & himpunan" />
                            <select name="fuzzy_output_id"
                                class="mt-1 block w-full rounded border-gray-300 dark:bg-gray-700" required>
                                <option value="">Pilih Penyakit</option>
                                @foreach ($fuzzy_outputs as $output)
                                    <option value="{{ $output->id }}">
                                        {{ $output->disease->nama ?? 'Nama Penyakit' }} - {{ $output->himpunan }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('fuzzy_output_id')" />
                        </div>


                        <div>
                            <x-secondary-button tag="a" href="{{ route('rule') }}">Kembali</x-secondary-button>
                            <x-primary-button name="save_and_create" value="true">Simpan & Buat</x-primary-button>
                            <x-primary-button name="save" value="true">Simpan</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
