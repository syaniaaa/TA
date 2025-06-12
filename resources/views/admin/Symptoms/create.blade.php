<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Kelola Gejala') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="post" action="{{ route('symptom.store') }}" enctype="multipart/form-data"
                        class="mt-6 space-y-6">
                        @csrf

                        <div class="max-w-xl">
                            <x-input-label for="kode_gejala" value="Kode Gejala" />
                            <x-text-input id="kode_gejala" type="text" name="kode_gejala" class="mt-1 block w-full"
                                value="{{ old('kode_gejala') }}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('kode_gejala')" />
                        </div>

                        <div class="max-w-xl">
                            <x-input-label for="nama" value="Nama" />
                            <x-text-input id="nama" type="text" name="nama" class="mt-1 block w-full"
                                value="{{ old('nama') }}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('nama')" />
                        </div>

                        <div class="max-w-xl">
                            <x-input-label for="jenis_gejala" value="Jenis Gejala" />
                            <select id="jenis_gejala" name="jenis_gejala" class="mt-1 block w-full" required>
                                <option value="">-- Pilih Jenis Gejala --</option>
                                <option value="Khusus" {{ old('jenis_gejala') == 'Khusus' ? 'selected' : '' }}>Khusus</option>
                                <option value="Umum" {{ old('jenis_gejala') == 'Umum' ? 'selected' : '' }}>Umum</option>
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('jenis_gejala')" />
                        </div>

                        <div>
                            <x-secondary-button tag="a"
                                href="{{ route('symptom') }}">Kembali</x-secondary-button>
                            <x-primary-button name="save_and_create" value="true">Simpan & Buat</x-primary-button>
                            <x-primary-button name="save" value="true">Simpan</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
