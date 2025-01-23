<x-app-layout>
    <section class="mx-auto min-h-full w-full max-w-screen-xl space-y-4 px-2 pt-4 text-black md:px-16">
        <div class="space-y-2 rounded border border-zinc-300 p-2">
            <h1 class="font-semibold">GALERI DAN KONTEN</h1>

            <div class="grid grid-cols-2 gap-2 md:grid-cols-4">
                @foreach ($menuData->home as $menu)
                    <a href="{{ route($menu->cms) }}">
                        <button
                            class="flex w-full flex-col items-center justify-center rounded-md border border-zinc-300 py-16 shadow"
                        >
                            <i class="{{ $menu->icon }} text-4xl"></i>
                            {{ $menu->label }}
                        </button>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
</x-app-layout>
