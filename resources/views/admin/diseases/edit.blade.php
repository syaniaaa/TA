<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Kelola Penyakit') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflowhidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray100">
                    <form method="post" action="{{ route('disease.update', $disease->id) }}" enctype="multipart/form-data"
                        class="mt-6 space-y6">
                        @csrf
                        @method('PATCH')
                        <div class="max-w-xl">
                            <x-input-label for="nama" value="Nama" />
                            <x-text-input id="nama" type="text" name="nama" class="mt-1 block w-full"
                                value="{{ old('nama', $disease->nama) }}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('nama')" />
                        </div>

                        <div class="max-w-xl">
                            <x-input-label for="deskripsi" value="deskripsi" />
                            <x-text-input id="deskripsi" type="text" name="deskripsi" class="mt-1 block w-full"
                                value="{{ old('deskripsi', $disease->deskripsi) }}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('deskripsi')" />
                        </div>

                        <div class="max-w-xl">
                            <x-input-label for="solusi" value="Solusi" />
                            <x-text-input id="solusi" type="text" name="solusi" class="mt-1 block w-full"
                                value="{{ old('solusi', $disease->solusi) }}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('solusi')" />
                        </div>

                        <x-secondary-button tag="a" href="{{ route('disease') }}">Kembali</x-secondary-button>
                        <x-tertiary-button value="true">Update</x-tertiary-button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
