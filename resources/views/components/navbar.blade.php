<div class="space-y-4">
    <header class="flex flex-wrap sm:justify-start sm:flex-nowrap w-full bg-blue-500 text-sm py-4 dark:bg-green-500">
        <nav class="max-w-[85rem] w-full mx-auto px-4 sm:flex sm:items-center sm:justify-between" aria-label="Global">
            <div class="flex items-center justify-between">
                <a class="flex-none" href="#">
                    <img class="w-10 h-auto" src="img/logo.png">
                </a>
                <a class="flex-none text-xl font-semibold text-white dark:text-neutral-800" href="#">Sistem Pakar</a>
                <div class="sm:hidden">
                    <button type="button"
                        class="hs-collapse-toggle p-2 inline-flex justify-center items-center gap-2 rounded-lg border border-gray-100 font-medium bg-gray-100 text-green-400 shadow-sm align-middle hover:bg-gray-100/20 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-gray-100 transition-all text-sm dark:bg-white dark:hover:bg-gray-100 dark:border-gray-200 dark:text-gray-600 dark:focus:ring-offset-white"
                        data-hs-collapse="#navbar-dark" aria-controls="navbar-dark" aria-label="Toggle navigation">
                        <svg class="hs-collapse-open:hidden flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="3" x2="21" y1="6" y2="6" />
                            <line x1="3" x2="21" y1="12" y2="12" />
                            <line x1="3" x2="21" y1="18" y2="18" />
                        </svg>
                        <svg class="hs-collapse-open:block hidden flex-shrink-0 size-4"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M18 6 6 18" />
                            <path d="m6 6 12 12" />
                        </svg>
                    </button>
                </div>
            </div>
            <div id="navbar-dark"
                class="hs-collapse hidden overflow-hidden transition-all duration-300 basis-full grow sm:block">
                <div class="flex flex-col gap-5 mt-5 sm:flex-row sm:items-center sm:justify-end sm:mt-0 sm:ps-5">
                    <x-navbar-link href="/home" :active="request()->is('home')">
                        Beranda
                    </x-navbar-link>

                    <x-navbar-link href="/menu" :active="request()->is('menu')">
                        Menu
                    </x-navbar-link>

                    <x-navbar-link href="/reservation" :active="request()->is('reservation', 'reservation-menu', 'edit-menu', 'edit')">
                        Reservasi
                    </x-navbar-link>
                    {{--
                    <x-navbar-link href="/contact" :active="request()->is('contact')">
                        Kontak
                    </x-navbar-link> --}}
                    @if (Route::has('login'))
                        @auth
                            <x-navbar-link href="/transaction" :active="request()->is('transaction')">
                                Pembayaran
                            </x-navbar-link>
                            {{-- <div class="font-semibold text-lg text-gray-600 hover:text-gray-400">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </div> --}}

                            <x-navbar-link href="{{ route('profile.edit') }}"
                                class="font-semibold text-lg text-white hover:text-gray-400">
                                {{ __('Profil') }}
                            </x-navbar-link>


                            <div class="font-semibold text-lg text-white hover:text-gray-400">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-navbar-link href="{{ route('logout') }}" class="text-sm"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                        {{ __('Keluar') }}
                                    </x-navbar-link>
                                </form>
                            </div>
                        @else
                            <x-navbar-link href="{{ route('login') }}" :active="request()->is('login')">
                                Masuk
                            </x-navbar-link>

                            <x-navbar-link href="{{ route('register') }}" :active="request()->is('register')">
                                Registrasi
                            </x-navbar-link>
                            {{-- <a class="font-semibold text-lg text-gray-100 hover:text-red-500"
                                href="{{ route('login') }}">Masuk</a>
                            <a class="font-semibold text-lg text-gray-100 hover:text-red-500"
                                href="{{ route('register') }}">Registrasi</a> --}}
                        @endauth
                    @endif
                </div>
            </div>
        </nav>
    </header>
</div>
