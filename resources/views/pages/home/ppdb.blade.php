<x-guest-layout>
    @include('layouts.home-header')
    <section class="mx-auto max-w-screen-xl py-4">
        <h1 class="text-2xl font-bold">PENGUMUMAN PENERIMA PESERTA DIDIK BARU (PPDB)</h1>
        <h2 class="">SMA Negeri 1 Jati Agung</h2>
        <div class="mt-4 flex w-full">
            <nav class="w-[200px]">
                <h1 class="font-semibold">Tahun Ajaran</h1>
                <ul class="mt-2">
                    @foreach ($tahunAkademiks as $item)
                        <li>
                            <a href="">{{ $item }}</a>
                        </li>
                    @endforeach
                </ul>
            </nav>
            <section class="w-full">
                <div class="mx-auto min-h-[1000px] w-[600px]">
                    <div class="mb-4 flex items-center justify-between">
                        <h1 class="text-lg font-semibold">Dokumen PPDB 2024/2025</h1>
                        <a href="">
                            <button class="rounded-md bg-primary px-4 py-2 text-white">Unduh</button>
                        </a>
                    </div>
                    <div class="h-[900px] w-full bg-zinc-200"></div>
                </div>
            </section>
        </div>
    </section>

    @include('layouts.home-footer')
</x-guest-layout>
