<nav class="flex items-center justify-between px-2 py-2 text-primary md:px-8">
    <!--logo-->
    <section class="flex items-center gap-2 text-sm">
        <div class="h-16 w-16">
            <img
                src="{{ Vite::asset('resources/images/logo.png') }}"
                alt="logo"
                class="h-full w-full object-contain"
            />
        </div>
        <div class="">
            <h1 class="">Sistem Informasi Akademik</h1>
            <h2 class="font-semibold md:text-2xl">SMA NEGERI 1 JATI AGUNG</h2>
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
