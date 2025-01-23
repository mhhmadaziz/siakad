<x-guest-layout>
    @include('layouts.home-header')
    <section class="mx-auto min-h-screen max-w-screen-xl p-4">
        <h1 class="text-2xl font-bold">PENGUMUMAN PENERIMA PESERTA DIDIK BARU (PPDB)</h1>
        <h2 class="">SMA Negeri 1 Jati Agung</h2>
        <div class="mt-4 flex w-full flex-col gap-2 md:flex-row">
            <nav class="w-[200px]">
                <h1 class="font-semibold">Tahun Ajaran</h1>
                <ul class="mt-2">
                    @foreach ($tahunAkademiks as $key => $item)
                        <li
                            @class([
                                'font-semibold' => $key == $currentTahunAkademik->id,
                            ])
                        >
                            <a href="{{ route('home.ppdb.show', $key) }}">{{ $item }}</a>
                        </li>
                    @endforeach
                </ul>
            </nav>
            <section class="min-h-screen w-full">
                @if ($currentTahunAkademik && $currentTahunAkademik->file_ppdb)
                    <div class="mx-auto min-h-[1000px] w-full md:w-[600px]">
                        <div class="mb-4 flex items-center justify-between">
                            <h1 class="text-lg font-semibold">Dokumen PPDB {{ $currentTahunAkademik->name }}</h1>
                            <a
                                href="{{
                                    route('pdf.download', urlencode('ppdb/' . $currentTahunAkademik->file_ppdb)) .
                                        '?name=' .
                                        urlencode('PPDB ' . Str::of($currentTahunAkademik->name)->replace('/', '-'))
                                }}"
                            >
                                <button class="rounded bg-primary px-4 py-2 text-white">Unduh</button>
                            </a>
                        </div>
                        <livewire:pdf-viewer src="{{ asset('storage/ppdb/' . $currentTahunAkademik->file_ppdb) }}" />
                    </div>
                @endif
            </section>
        </div>
    </section>

    @include('layouts.home-footer')
</x-guest-layout>
