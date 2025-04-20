<nav class="font-poppins bg-white shadow-md fixed w-full top-0 z-50">
    <div class="max-w-screen-xl mx-auto px-4 py-3 flex flex-wrap items-center justify-between">

        <!-- Logo + Nama -->
        <div class="flex items-center gap-3 font-poppins">
            <img src="/img/logo.png" class="h-10" alt="Logo">
            <span class="text-2xl font-bold text-green-700 drop-shadow">Puskesmas Cugenang</span>
        </div>

        <!-- Menu Desktop -->
        <div class="font-poppins hidden md:flex space-x-6 items-center">
            <a href="/home"
                class="font-poppins text-green-700 text-base font-medium hover:text-yellow-100 transition-all duration-200">Beranda</a>
            <a href="/informasi"
                class="font-poppins text-green-700 text-base font-medium hover:text-yellow-100 transition-all duration-200">Informasi</a>
                <a href="/patientData"
                class="font-poppins text-green-700 text-base font-medium hover:text-yellow-100 transition-all duration-200">
                Diagnosis </a>
            <a href="/diagnosis"
                class="font-poppins text-green-700 text-base font-medium hover:text-yellow-100 transition-all duration-200">Riwayat Diagnosis</a>
            <a href="/diagnosis"
                class="font-poppins text-green-700 text-base font-medium hover:text-yellow-100 transition-all duration-200">Tentang
                Kami</a>
            <a href="/kontak"
                class="font-poppins text-green-700 text-base font-medium hover:text-yellow-100 transition-all duration-200">Kontak</a>
        </div>

        <!-- Login / Logout -->
        <div class="flex items-center space-x-3">
            @auth
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="bg-white text-green-700 font-semibold px-4 py-2 rounded-full shadow hover:bg-green-100 transition">
                        Keluar
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}"
                    class="bg-white text-green-700 font-semibold px-4 py-2 rounded-full shadow hover:bg-green-100 transition">
                    Masuk
                </a>
            @endauth
        </div>
    </div>
</nav>
