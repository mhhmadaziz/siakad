<x-app-layout>
    <section class="mx-auto min-h-full w-full max-w-screen-xl space-y-4 px-2 pt-4 text-black md:px-16">
        <div class="space-y-2 rounded border border-zinc-300 p-2">
            <div>
                <h1 class="font-semibold">KEHADIRAN SISWA {{ $kelas->fullName }}</h1>
                <h2 class="text-xs">{{ $mataPelajaran->name }}</h2>
            </div>

            <div>
                <livewire:guru.kehadiran-siswa-detail :$kelas :$mataPelajaran />
            </div>
        </div>
    </section>
</x-app-layout>
