<x-app-layout>
    <section class="mx-auto min-h-full w-full max-w-screen-xl space-y-4 px-16 pt-4 text-black">
        <div class="space-y-2 rounded border border-zinc-300 p-2">
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.kelas.show', $kelas->id) }}">
                    <i class="fa-solid fa-angle-left"></i>
                </a>
                <h1 class="font-semibold">Tambah Siswa Kelas {{ $kelas->fullName }}</h1>
            </div>

            <livewire:table.admin.table-tambah-siswa-kelas :kelas="$kelas" />
        </div>
    </section>
</x-app-layout>
