<x-navbar>Registrasi</x-navbar>
<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        <h1 class="text-center font-bold">Halaman Registrasi</h1>
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nama')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Alamat -->
        <div class="mt-4">
            <x-input-label for="address" :value="__('Alamat')" />
            <select id="address" name="address"
                class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                required>
                <option value="">-- Pilih Alamat --</option>
                <option value="Padaluyu" {{ old('address') == 'Padaluyu' ? 'selected' : '' }}>Desa Padaluyu</option>
                <option value="Wangunjaya" {{ old('address') == 'Wangunjaya' ? 'selected' : '' }}>Desa Wangunjaya
                </option>
                <option value="Mangunkerta" {{ old('address') == 'Mangunkerta' ? 'selected' : '' }}>Desa Mangunkerta
                </option>
                <option value="Talaga" {{ old('address') == 'Talaga' ? 'selected' : '' }}>Desa Talaga</option>
                <option value="Benjot" {{ old('address') == 'Benjot' ? 'selected' : '' }}>Desa Benjot</option>
                <option value="Sarampad" {{ old('address') == 'Sarampad' ? 'selected' : '' }}>Desa Sarampad</option>
            </select>
            <x-input-error :messages="$errors->get('address')" class="mt-2" />
        </div>

        <!-- no hp -->
        <div class="mt-4">
            <x-input-label for="phone_number" :value="__('No. HP')" />
            <x-text-input id="phone_number" class="block mt-1 w-full text-lg py-2 px-3" type="text"
                name="phone_number" :value="old('phone_number')" required autocomplete="phone_number" />
            <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
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

            <x-tertiary-button class="ms-4">
                {{ __('Register') }}
            </x-tertiary-button>
        </div>
    </form>
</x-guest-layout>
