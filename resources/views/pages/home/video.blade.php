<x-guest-layout>
    @include('layouts.home-header')
    <section class="mx-auto max-w-screen-xl py-4">
        <h1 class="text-2xl font-bold">Galeri</h1>
        <h2 class="">Dokumentasi Kegiatan SMA Negeri 1 Jati Agung</h2>
        <div class="mt-4 flex w-full">
            <nav class="w-[200px]">
                <ul class="space-y-4">
                    <li>
                        <a href="{{ route('home.galeri') }}">Foto</a>
                    </li>
                    <li>
                        <a href="{{ route('home.galeri.video') }}">Video</a>
                    </li>
                </ul>
            </nav>
            <section class="w-full">
                <div class="grid grid-cols-4 gap-4">
                    @for ($i = 0; $i < 24; $i++)
                        <div class="flex h-48 flex-col rounded-lg border border-zinc-200 bg-white p-2 shadow-lg">
                            <div class="h-full w-full rounded-lg bg-zinc-300"></div>
                        </div>
                    @endfor
                </div>
            </section>
        </div>
    </section>

    @include('layouts.home-footer')
</x-guest-layout>
