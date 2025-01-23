<section class="grid auto-rows-min items-start gap-2 md:grid-cols-3">
    @foreach ($this->jadwalMataPelajarans() as $hari => $jadwal)
        <div class="rounded-md border border-zinc-300 p-2">
            <h1 class="text-center">{{ $hari }}</h1>
            <hr />
            <div class="mt-2 space-y-2">
                @foreach ($jadwal as $item)
                    <div class="flex items-center justify-between rounded-md border border-zinc-300 p-1 text-sm">
                        <div>
                            <h1 class="">{{ $item->jam }}</h1>
                            <h1 class="">{{ $item->mataPelajaran->name }}</h1>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
</section>
