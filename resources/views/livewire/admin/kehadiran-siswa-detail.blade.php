<div class="">
    <section class="mt-8 flex items-start justify-between">
        <div>
            <x-inputs.select
                name="kehadiranSiswa"
                :options="$this->pertemuan()"
                wire:model.live="kehadiranSiswaId"
                empty="Pilih Pertemuan"
            />
        </div>
        <a href="{{ route('admin.kehadiran-siswa.create', [$kelas->id, $mataPelajaran->id]) }}">
            <button class="rounded-md bg-black px-4 py-2 text-white">Tambah Pertemuan</button>
        </a>
    </section>

    @if ($kehadiranSiswa)
        <div wire:loading class="w-full py-16 text-center" wire:target="kehadiranSiswaId">Loading...</div>
        <div wire:loading.remove class="w-full" wire:target="kehadiranSiswaId">
            <section class="mt-2 grid grid-cols-2 rounded-md border border-zinc-300 p-2 text-center md:grid-cols-4">
                @foreach ($this->getStatistik() as $item)
                    <div>
                        <h1>{{ $item->label }}</h1>
                        <h2>{{ $item->total }}</h2>
                    </div>
                @endforeach
            </section>
            <livewire:table.admin.table-siswa-kehadiran-siswa
                :$kelas
                :$kehadiranSiswa
                wire:key="kehadiran-siswa-table-{{ $kehadiranSiswaId }}"
            />
        </div>
    @else
        <div class="mt-4">
            <h1 class="text-center">Silahkan pilih pertemuan</h1>
        </div>
    @endif
</div>
