<x-guest-layout>
    @include('layouts.home-header')
    <section class="mx-auto min-h-screen max-w-screen-xl p-4">
        <h1 class="text-2xl font-bold">Galeri</h1>
        <h2 class="">Dokumentasi Kegiatan SMA Negeri 1 Jati Agung</h2>
        <div class="mt-4 flex w-full flex-col md:flex-row">
            <nav class="w-[200px]">
                <ul class="space-y-1">
                    <li>
                        <a href="{{ route('home.galeri') }}">Foto</a>
                    </li>
                    <li class="font-semibold">
                        <a href="{{ route('home.galeri.video') }}">Video</a>
                    </li>
                </ul>
            </nav>
            <section class="mt-2 w-full md:mt-0">
                <div class="grid grid-cols-2 gap-2 md:grid-cols-4 md:gap-4">
                    @forelse ($videos as $item)
                        <div class="flex flex-col rounded-lg border border-zinc-200 bg-white p-2 shadow-lg">
                            <div class="h-full w-full rounded-lg bg-zinc-300">
                                <x-embed :url="$item['video']" />
                            </div>
                        </div>
                    @empty
                        <div class="col-span-4 text-center">Tidak ada video</div>
                    @endforelse
                </div>
            </section>
        </div>
    </section>

    @include('layouts.home-footer')
</x-guest-layout>
