<x-navbar>Register</x-navbar>
<x-guest-layout>
    <div class="pt-24">
        <form method="POST" action="{{ route('register') }}">
            <h1 class="text-center font-bold">Halaman Registrasi</h1>
            @csrf

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Nama')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                    required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Alamat -->
            <div class="mt-4">
                <x-input-label for="alamat" :value="__('Alamat')" />
                <x-text-input id="alamat" class="block mt-1 w-full" type="text" name="alamat" :value="old('alamat')"
                    required autocomplete="street-address" />
                <x-input-error :messages="$errors->get('alamat')" class="mt-2" />
            </div>

            <!-- No HP -->
            <div class="mt-4">
                <x-input-label for="phone_number" :value="__('No. HP')" />
                <x-text-input id="phone_number" class="block mt-1 w-full text-lg py-2 px-3" type="text"
                    name="phone_number" :value="old('phone_number')" required autocomplete="tel" />
                <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
            </div>

            <!-- Tanggal Lahir -->
            <div class="mt-4">
                <x-input-label for="tgl_lahir" :value="__('Tanggal Lahir')" />
                <x-text-input id="tgl_lahir" class="block mt-1 w-full" type="date" name="tgl_lahir"
                    :value="old('tgl_lahir')" required />
                <x-input-error :messages="$errors->get('tgl_lahir')" class="mt-2" />
            </div>

            <!-- Jenis Kelamin -->
            <div class="mt-4">
                <x-input-label for="kelamin" :value="__('Jenis Kelamin')" />
                <select id="kelamin" name="kelamin"
                    class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    required>
                    <option value="">-- Pilih --</option>
                    <option value="Laki-laki" {{ old('kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ old('kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
                <x-input-error :messages="$errors->get('kelamin')" class="mt-2" />
            </div>

            <!-- Email -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required autocomplete="email" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" />

                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                    href="{{ route('login') }}">
                    {{ __('Sudah Punya Akun?') }}
                </a>

                <x-primary-button class="ms-4">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
