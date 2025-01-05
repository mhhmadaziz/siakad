<header class="flex items-center justify-between px-8 py-2 text-primary">
    <!--logo-->
    <section class="flex gap-2">
        <div class="h-16 w-16">
            <img
                src="{{ Vite::asset('resources/images/logo.png') }}"
                alt="logo"
                class="h-full w-full object-contain"
            />
        </div>
        <div class="flex flex-col justify-center gap-0 font-semibold leading-4">
            <h1 class="">SMA NEGERI 1</h1>
            <h2 class="">JATI AGUNG</h2>
        </div>
    </section>
</header>
<nav class="relative bg-primary">
    <div class="absolute h-10 w-8 bg-green-600"></div>
    <div class="flex w-full justify-end">
        <button class="bg-yellowCustom flex items-center gap-2 px-4 py-2">
            <i class="fas fa-user text-xs"></i>
            @auth
                {{ auth()->user()->name }}
            @endauth
        </button>
        <button class="flex items-center gap-2 bg-red-700 px-4 py-2 text-white">
            <i class="fa-solid fa-right-from-bracket"></i>
            Keluar
        </button>
    </div>
</nav>
