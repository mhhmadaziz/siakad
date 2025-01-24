<header class="flex items-center justify-between px-2 py-2 text-primary md:px-8">
    <!--logo-->
    <a class="flex gap-2" href="{{ route('home.index') }}">
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
    </a>
</header>
<nav class="flex flex-col bg-primary md:flex-row">
    <div class="flex min-w-fit items-center bg-green-600 px-2">
        <h1 class="font-semibold text-white">Tahun Ajaran {{ $currentTahunAkademik->name }}</h1>
    </div>
    <div class="flex w-full justify-end">
        <a href="{{ route('profile.edit') }}">
            <button class="flex items-center gap-2 bg-yellowCustom px-4 py-2">
                <i class="fas fa-user text-xs"></i>
                @auth
                    {{ auth()->user()->name }}
                @endauth
            </button>
        </a>
        <form action="{{ route('logout') }}" method="post">
            @csrf
            <button class="flex items-center gap-2 bg-red-700 px-4 py-2 text-white">
                <i class="fa-solid fa-right-from-bracket"></i>
                Keluar
            </button>
        </form>
    </div>
</nav>
