<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Kelola Pengguna') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflowhidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray100">
                    <form method="post" action="{{ route('user.update', $user->id) }}" enctype="multipart/form-data"
                        class="mt-6 space-y6">
                        @csrf
                        @method('PATCH')
                        <div class="max-w-xl">
                            <x-input-label for="name" value="Nama" />
                            <x-text-input id="name" type="text" name="name" class="mt-1 block w-full"
                                value="{{ old('name', $user->name) }}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>
                        <div class="max-w-xl mt-4">
                            <x-input-label for="tgl_lahir" value="Tanggal Lahir" />
                            <x-text-input id="tgl_lahir" type="date" name="tgl_lahir" class="mt-1 block w-full"
                                value="{{ old('tgl_lahir', $user->tgl_lahir ? \Carbon\Carbon::parse($user->tgl_lahir)->format('Y-m-d') : '') }}"
                                required />
                            <x-input-error class="mt-2" :messages="$errors->get('tgl_lahir')" />
                        </div>
                        <div class="max-w-xl mt-4">
                            <x-input-label for="kelamin" value="Jenis Kelamin" />
                            <select id="kelamin" name="kelamin" class="mt-1 block w-full" required>
                                <option value="">-- Pilih Jenis Kelamin --</option>
                                <option value="Laki-laki" {{ old('kelamin', $user->kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('kelamin', $user->kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('kelamin')" />
                        </div>
                        <div class="max-w-xl">
                            <x-input-label for="email" value="Email" />
                            <x-text-input id="email" type="text" name="email" class="mt-1 block w-full"
                                value="{{ old('email', $user->email) }}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('email')" />
                        </div>
                        <div class="max-w-xl">
                            <x-input-label for="phone_number" value="No HP" />
                            <x-text-input id="phone_number" type="text" name="phone_number" class="mt-1 block w-full"
                                value="{{ old('phone_number', $user->phone_number) }}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('phone_number')" />
                        </div>

                        <div class="max-w-xl mt-4">
                            <x-input-label for="alamat" value="Alamat" />
                            <textarea id="alamat" name="alamat" rows="3"
                                class="mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                required>{{ old('alamat', $user->alamat) }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('alamat')" />
                        </div>

                        <x-secondary-button tag="a" href="{{ route('user') }}">Kembali</x-secondary-button>
                        <x-tertiary-button value="true">Update</x-tertiary-button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
