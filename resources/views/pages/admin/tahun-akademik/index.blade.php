<x-app-layout>
    <section class="mx-auto min-h-full w-full max-w-screen-xl space-y-4 px-2 pb-16 pt-4 text-black md:px-16">
        <div class="space-y-2 rounded border border-zinc-300 p-2">
            <h1 class="font-semibold">TAHUN AJARAN</h1>

            <div class="flex justify-end">
                <a href="{{ route('admin.tahun-akademik.create') }}">
                    <button class="rounded-md bg-black px-4 py-2 text-white">Tambah</button>
                </a>
            </div>

            @foreach ($tahunAkademik as $item)
                <div class="rounded-lg bg-primary p-3 pb-4 text-white">
                    <div class="mt-4 flex gap-2">
                        <i class="fa-solid fa-graduation-cap text-6xl"></i>
                        <div class="flex w-full flex-wrap items-center justify-between">
                            <div class="">
                                <h2>
                                    Tahun Ajaran
                                    @if ($currentTahunAkademik->id == $item->id)
                                        <span class="rounded-full bg-green-600 px-4 py-1 text-sm">Aktif</span>
                                    @endif
                                </h2>
                                <h1 class="text-3xl font-semibold">
                                    {{ $item->name }}
                                </h1>
                            </div>
                            <a href="{{ route('admin.tahun-akademik.show', $item->id) }}">
                                <button class="rounded-md bg-white px-8 py-2 text-sm font-semibold text-primary">
                                    LIHAT
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
</x-app-layout>
