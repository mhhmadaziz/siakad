<nav class="bg-primary px-8 py-2 text-white transition-all" x-data="{ open: false }">
    <div class="container mx-auto flex flex-col justify-between transition-all md:flex-row md:items-center">
        <!-- Logo -->
        <a class="flex flex-col gap-2 md:flex-row" href="{{ route('home.index') }}">
            <div class="h-16 w-16">
                <img
                    src="{{ Vite::asset('resources/images/logo.png') }}"
                    alt="logo"
                    class="h-full w-full object-contain"
                />
            </div>
            <div class="text-sm font-extrabold">
                <h1>SMA NEGERI 1</h1>
                <h2 class="text-2xl">JATI AGUNG</h2>
            </div>
        </a>

        <!-- Mobile Menu Button -->
        <div class="flex justify-end md:hidden">
            <button @click="open = ! open" class="focus:outline-none focus:ring-0" aria-label="Toggle Menu">
                <i class="fa-solid fa-bars text-2xl" x-show="!open"></i>
                <i class="fa-solid fa-xmark text-2xl" x-show="open" x-cloak></i>
            </button>
        </div>

        <!-- Menu -->

        <section x-cloak class="mt-4 hidden items-center gap-4 md:mt-0 md:flex md:flex-row md:justify-end md:gap-4">
            <ul class="flex flex-col gap-4 md:flex-row md:gap-8">
                @foreach ($menuData->home as $menu)
                    <li>
                        <a href="{{ route($menu->route) }}" class="flex items-center gap-2 hover:underline">
                            <i class="{{ $menu->icon }} text-sm"></i>
                            {{ $menu->label }}
                        </a>
                    </li>
                @endforeach
            </ul>

            @auth
                <a href="{{ route('dashboard') }}">
                    <button class="rounded bg-yellowCustom px-4 py-1 text-blue-800">
                        <i class="fa-solid fa-right-to-bracket"></i>
                        Dashboard
                    </button>
                </a>
            @else
                <a href="{{ route('login') }}">
                    <button class="rounded bg-yellowCustom px-4 py-1 text-blue-800">
                        <i class="fa-solid fa-right-to-bracket"></i>
                        Masuk
                    </button>
                </a>
            @endauth
        </section>

        <section x-cloak class="mt-4 md:hidden" x-show="open" x-transition>
            <ul class="flex flex-col gap-4 md:flex-row md:gap-8">
                @foreach ($menuData->home as $menu)
                    <li>
                        <a href="{{ route($menu->route) }}" class="flex items-center gap-2 hover:underline">
                            <i class="{{ $menu->icon }} text-sm"></i>
                            {{ $menu->label }}
                        </a>
                    </li>
                @endforeach
            </ul>

            <div class="mt-4">
                @auth
                    <a href="{{ route('dashboard') }}">
                        <button class="rounded bg-yellowCustom px-4 py-1 text-blue-800">
                            <i class="fa-solid fa-right-to-bracket"></i>
                            Dashboard
                        </button>
                    </a>
                @else
                    <a href="{{ route('login') }}">
                        <button class="rounded bg-yellowCustom px-4 py-1 text-blue-800">
                            <i class="fa-solid fa-right-to-bracket"></i>
                            Masuk
                        </button>
                    </a>
                @endauth
            </div>
        </section>
    </div>
</nav>
