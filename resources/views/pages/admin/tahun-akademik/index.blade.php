<x-app-layout>
    <section class="mx-auto min-h-full w-full max-w-screen-xl space-y-4 px-16 pt-4 text-black">
        <div class="space-y-2 rounded border border-zinc-300 p-2">
            <h1 class="font-semibold">TAHUN AJARAN</h1>

            <div class="rounded-lg bg-primary p-3 pb-4">
                <h1 class="max-w-fit rounded bg-green-600 px-2 py-1 text-sm text-white">SEDANG AKTIF</h1>
                <div class="mt-4 flex gap-2 text-white">
                    <i class="fa-solid fa-graduation-cap text-6xl"></i>
                    <div class="flex w-full items-center justify-between">
                        <div class="">
                            <h2>Tahun Ajaran</h2>
                            <h1 class="text-3xl font-semibold">{{ $currentTahunAkademik->name }}</h1>
                        </div>
                        <a href="{{ route('admin.tahun-akademik.show', $currentTahunAkademik->id) }}">
                            <button class="rounded-md bg-white px-8 py-2 text-sm font-semibold text-primary">
                                LIHAT ATURAN & KEBIJAKAN
                            </button>
                        </a>
                    </div>
                </div>
            </div>

            @foreach ($tahunAkademik as $item)
                @if ($item->id == $currentTahunAkademik->id || $upcomingTahunAkademik->contains($item->id))
                    @continue
                @endif

                <div class="rounded-lg bg-zinc-100 p-3 pb-4">
                    <h1 class="max-w-fit rounded bg-yellowCustom px-2 py-1 text-sm">DIARSIPKAN</h1>
                    <div class="mt-4 flex gap-2 text-black">
                        <i class="fa-solid fa-graduation-cap text-6xl"></i>
                        <div class="flex w-full items-center justify-between">
                            <div class="">
                                <h2>Tahun Ajaran</h2>
                                <h1 class="text-3xl font-semibold">{{ $item->name }}</h1>
                            </div>
                            <button class="rounded-md bg-white px-8 py-2 text-sm font-semibold text-primary">
                                LIHAT ATURAN & KEBIJAKAN
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="space-y-2 rounded border border-zinc-300 p-2">
            <h1 class="font-semibold">RENCANA TAHUN AJARAN MENDATANG</h1>

            @foreach ($upcomingTahunAkademik as $item)
                @if ($item->id == $currentTahunAkademik->id)
                    @continue
                @endif

                <div class="rounded-lg bg-yellowCustom p-3 pb-4">
                    <h1 class="max-w-fit rounded bg-primary px-2 py-1 text-sm text-white">DRAFT</h1>
                    <div class="mt-4 flex gap-2 text-black">
                        <i class="fa-solid fa-graduation-cap text-6xl"></i>
                        <div class="flex w-full items-center justify-between">
                            <div class="">
                                <h2>Tahun Ajaran</h2>
                                <h1 class="text-3xl font-semibold">{{ $item->name }}</h1>
                            </div>
                            <button class="rounded-md bg-white px-8 py-2 text-sm font-semibold text-primary">
                                LIHAT ATURAN & KEBIJAKAN
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
</x-app-layout>
