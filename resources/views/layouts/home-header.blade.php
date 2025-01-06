<nav class="flex items-center justify-between bg-primary px-8 py-2 text-white">
    <!--logo-->
    <section class="flex gap-2">
        <div class="h-16 w-16">
            <img
                src="{{ Vite::asset('resources/images/logo.png') }}"
                alt="logo"
                class="h-full w-full object-contain"
            />
        </div>
        <div class="font-extrabold">
            <h1>SMA NEGERI 1</h1>
            <h2 class="text-2xl">JATI AGUNG</h2>
        </div>
    </section>

    <!--menu-->
    <section class="flex items-center gap-4">
        <ul class="flex gap-8">
            @foreach ($menuData->home as $menu)
                <li>
                    <a href="{{ route($menu->route) }}" class="flex items-center gap-2 hover:underline">
                        <i class="{{ $menu->icon }} text-sm"></i>
                        {{ $menu->label }}
                    </a>
                </li>
            @endforeach
        </ul>
        <a href="{{ route('login') }}">
            <button class="rounded bg-yellowCustom px-4 py-1 text-blue-800">
                <i class="fa-solid fa-right-to-bracket"></i>
                Masuk
            </button>
        </a>
    </section>
</nav>
