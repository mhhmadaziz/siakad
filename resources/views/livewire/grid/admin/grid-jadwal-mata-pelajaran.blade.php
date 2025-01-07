<section class="grid auto-rows-min grid-cols-3 items-start gap-2">
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
                        <div class="text-white">
                            <button class="rounded-md bg-yellow-500 p-1 px-3 text-xs">Edit</button>
                            <button class="rounded-md bg-red-600 p-1 px-3 text-xs">Hapus</button>
                        </div>
                    </div>
                @endforeach

                <button
                    class="w-full rounded-md bg-blue-800 py-2 text-center text-white"
                    wire:click="$dispatch('openModal', {
                        component: 'modal.tambah-jadwal-mata-pelajaran',
                        arguments: {
                            kelas: {{ $kelas }},
                            hari: '{{ $hari }}'
                        }
                    })"
                >
                    Tambah Jadwal
                </button>
            </div>
        </div>
    @endforeach
</section>
