<x-app-layout>
    <section class="mx-auto min-h-full w-full max-w-screen-xl space-y-4 px-16 pt-4 text-black">
        <div class="space-y-2 rounded border border-zinc-300 p-2">
            <div>
                <h1 class="font-semibold">KEHADIRAN SISWA {{ $kelas->fullName }}</h1>
                <h2 class="text-xs">{{ $mataPelajaran->name }}</h2>
            </div>

            <div>
                <livewire:admin.kehadiran-siswa-detail :$kelas :$mataPelajaran />
            </div>
        </div>
    </section>
</x-app-layout>
