<section class="grid auto-rows-min items-start gap-2 md:grid-cols-3">
    @foreach ($this->jadwalMataPelajarans() as $hari => $jadwal)
        <div class="rounded-md border border-zinc-300 p-2">
            <h1 class="text-center">{{ $hari }}</h1>
            <hr />
            <div class="mt-2 space-y-2">
                @foreach ($jadwal as $item)
                    <div
                        class="flex items-center justify-between rounded-md border border-zinc-300 p-1 text-sm"
                        wire:key="jadwal-{{ $item->id }}"
                    >
                        <div>
                            <h1 class="">{{ $item->jam }}</h1>
                            <h1 class="">{{ $item->mataPelajaran->name }}</h1>
                        </div>
                        <div class="text-white">
                            <button
                                class="rounded-md bg-yellow-500 p-1 px-3 text-xs"
                                wire:click="$dispatch('openModal', {
                                component: 'modal.edit-jadwal-mata-pelajaran',
                                arguments: {
                                    id: {{ $item->id }}
                                }
                            })"
                            >
                                Edit
                            </button>
                            <button
                                class="rounded-md bg-red-600 p-1 px-3 text-xs disabled:opacity-50"
                                wire:click="hapus({{ $item }})"
                                wire:loading.attr="disabled"
                                wire:target="hapus({{ $item }})"
                            >
                                Hapus
                            </button>
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
