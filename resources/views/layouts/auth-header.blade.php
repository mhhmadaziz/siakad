<nav class="flex items-center justify-between px-8 py-2 text-primary">
    <!--logo-->
    <section class="flex gap-2">
        <div class="h-16 w-16">
            <img
                src="{{ Vite::asset('resources/images/logo.png') }}"
                alt="logo"
                class="h-full w-full object-contain"
            />
        </div>
        <div class="">
            <h1 class="">Sistem Informasi Akademik</h1>
            <h2 class="text-2xl font-semibold">SMA NEGERI 1 JATI AGUNG</h2>
        </div>
    </section>

    <!--menu-->
    <section class="flex items-center gap-4">
        <a href="{{ route('home.index') }}" class="flex items-center gap-2 hover:underline">
            <i class="fas fa-home text-sm"></i>
            Beranda
        </a>
    </section>
</nav>
