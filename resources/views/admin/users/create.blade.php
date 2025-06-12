<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Kelola Pengguna') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="post" action="{{ route('user.store') }}" enctype="multipart/form-data"
                        class="mt-6 space-y-6">
                        @csrf
                        <div class="max-w-xl">
                            <x-input-label for="name" value="Nama" />
                            <x-text-input id="name" type="text" name="name" class="mt-1 block w-full"
                                value="{{ old('name') }}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>
                        <div class="max-w-xl">
                            <x-input-label for="tgl_lahir" value="Tanggal Lahir" />
                            <x-text-input id="tgl_lahir" type="text" name="tgl_lahir" class="mt-1 block w-full"
                                value="{{ old('tgl_lahir') }}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('tgl_lahir')" />
                        </div>
                        <div class="max-w-xl mt-4">
                            <x-input-label for="kelamin" value="Jenis Kelamin" />
                            <select id="kelamin" name="kelamin" class="mt-1 block w-full" required>
                                <option value="">-- Pilih Jenis Kelamin --</option>
                                <option value="Laki-laki" {{ old('kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('kelamin')" />
                        </div>
                        <div class="max-w-xl">
                            <x-input-label for="email" value="Email" />
                            <x-text-input id="email" type="email" name="email" class="mt-1 block w-full"
                                value="{{ old('email') }}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('email')" />
                        </div>
                        <div class="max-w-xl">
                            <x-input-label for="phone_number" value="No. HP" />
                            <x-text-input id="phone_number" type="text" name="phone_number" class="mt-1 block w-full"
                                value="{{ old('phone_number') }}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('phone_number')" />
                        </div>
                        <div class="max-w-xl">
                            <x-input-label for="alamat" value="Alamat" />
                            <x-text-input id="alamat" type="text" name="alamat" class="mt-1 block w-full"
                                value="{{ old('alamat') }}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('alamat')" />
                        </div>
                        <div class="max-w-xl text-white">
                            <x-input-label for="password" value="Password" />
                            <x-text-input id="password" type="text" name="password" class="mt-1 block w-full"
                                value="{{ old('password') }}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('password')" />
                        </div>
                        <div class="max-w-xl">
                            <x-input-label for="role_id" value="Category" />
                            <select id="role_id" name="role_id" class="mt-1 block w-full" required>
                                @foreach ($roles as $id => $name)
                                    <option value="{{ $id }}" {{ old('role_id') == $id ? 'selected' : '' }}>
                                        {{ $name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('role_id')" />
                        </div>

                        <div>
                            <x-secondary-button tag="a"
                                href="{{ route('user') }}">Kembali</x-secondary-button>
                            <x-primary-button name="save_and_create" value="true">Simpan & Buat</x-primary-button>
                            <x-primary-button name="save" value="true">Simpan</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
