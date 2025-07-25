<nav class="font-poppins bg-white shadow-md fixed w-full top-0 z-50">
    <div class="max-w-screen-xl mx-auto px-4 py-3 flex flex-wrap items-center justify-between">

        <!-- Logo + Nama -->
        <div class="flex items-center gap-3 font-poppins">
            <img src="/img/logo.png" class="h-10" alt="Logo">
            <span class="text-2xl font-bold text-green-600 drop-shadow">SIPARTU</span>
        </div>

        <!-- Menu Desktop -->
        <div class="font-poppins hidden md:flex space-x-8 items-center">
            <a href="/home"
                class="text-base font-medium transition-all duration-200
            {{ request()->is('home') ? 'text-green-500 font-bold border-b-2 border-yellow-300' : 'text-green-700 hover:text-green-300' }}">
                Beranda
            </a>
            <a href="/symptomTest"
                class="text-base font-medium transition-all duration-200
            {{ request()->is('symptomTest') ? 'text-green-500 font-bold border-b-2 border-yellow-300' : 'text-green-700 hover:text-green-300' }}">
                Diagnosis
            </a>
            @auth
                <a href="/diagnosisHistory/history"
                    class="text-base font-medium transition-all duration-200
                {{ request()->is('diagnosisHistory/history') ? 'text-green-500 font-bold border-b-2 border-yellow-300' : 'text-green-700 hover:text-green-300' }}">
                    Riwayat Diagnosis
                </a>
            @endauth
            <a href="/question"
                class="text-base font-medium transition-all duration-200
            {{ request()->is('question') ? 'text-green-500 font-bold border-b-2 border-yellow-300' : 'text-green-700 hover:text-green-300' }}">
                Seputar TB
            </a>
            <a href="/aboutUs"
                class="text-base font-medium transition-all duration-200
            {{ request()->is('aboutUs') ? 'text-green-500 font-bold border-b-2 border-yellow-300' : 'text-green-700 hover:text-green-300' }}">
                Tentang
            </a>
        </div>

        <!-- Login / Logout -->
        <div class="flex items-center space-x-3">
            @auth
                {{-- <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="bg-yellow-400 text-white font-semibold px-4 py-2 rounded-full shadow hover:bg-yellow-300 transition">
                        Keluar
                    </button>
                </form> --}}
                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            @if (Auth::user()->role_id == 2)
                                <x-dropdown-link :href="route('profile.edit-frontend')">
                                    {{ __('Profil') }}
                                </x-dropdown-link>
                            @else
                                <x-dropdown-link :href="route('profile.edit')">
                                    {{ __('Profil') }}
                                </x-dropdown-link>
                            @endif

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">
                                    {{ __('Keluar') }}
                                </button>
                            </form>
                        </x-slot>

                    </x-dropdown>
                </div>
            @else
                <a href="{{ route('login') }}"
                    class="bg-yellow-400 text-white font-semibold px-4 py-2 rounded-full shadow hover:bg-yellow-300 transition">
                    Masuk
                </a>
            @endauth
        </div>
    </div>
</nav>
