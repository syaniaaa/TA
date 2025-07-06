<nav class="font-poppins bg-white shadow-md fixed w-full top-0 z-50">
    <div class="max-w-screen-xl mx-auto px-4 py-3 flex flex-wrap items-center justify-between">

        <!-- Logo + Nama -->
        <div class="flex items-center gap-3 font-poppins">
            <img src="/img/logo.png" class="h-10" alt="Logo">
            <span class="text-2xl font-bold text-green-700 drop-shadow">Puskesmas Cugenang</span>
        </div>

        <!-- Menu Desktop -->
        <div class="font-poppins hidden md:flex space-x-8 items-center">
            <a href="/home"
                class="text-base font-medium transition-all duration-200
            {{ request()->is('home') ? 'text-green-500 font-bold border-b-2 border-green-500' : 'text-green-700 hover:text-green-300' }}">
                Beranda
            </a>
            <a href="/symptomTest"
                class="text-base font-medium transition-all duration-200
            {{ request()->is('symptomTest') ? 'text-green-500 font-bold border-b-2 border-green-500' : 'text-green-700 hover:text-green-300' }}">
                Diagnosis
            </a>
            <a href="/diagnosisHistory/history"
                class="text-base font-medium transition-all duration-200
            {{ request()->is('diagnosisHistory/history') ? 'text-green-500 font-bold border-b-2 border-green-500' : 'text-green-700 hover:text-green-300' }}">
                Riwayat Diagnosis
            </a>
            <a href="/question"
                class="text-base font-medium transition-all duration-200
            {{ request()->is('question') ? 'text-green-500 font-bold border-b-2 border-green-500' : 'text-green-700 hover:text-green-300' }}">
                Tanya Jawab Seputar TB
            </a>
            <a href="/aboutUs"
                class="text-base font-medium transition-all duration-200
            {{ request()->is('aboutUs') ? 'text-green-500 font-bold border-b-2 border-green-500' : 'text-green-700 hover:text-green-300' }}">
                Tentang
            </a>
        </div>

        <!-- Login / Logout -->
        <div class="flex items-center space-x-3">
            @auth
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="bg-white text-green-700 font-semibold px-4 py-2 rounded-full shadow hover:bg-green-300 transition">
                        Keluar
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}"
                    class="bg-green-600 text-white font-semibold px-4 py-2 rounded-full shadow hover:bg-green-400 transition">
                    Masuk
                </a>
            @endauth
        </div>
    </div>
</nav>
