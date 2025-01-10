<x-app-layout>
    <section class="mx-auto min-h-full w-full max-w-screen-xl space-y-4 px-16 pt-4 text-black">
        <div class="space-y-2 rounded border border-zinc-300 p-2">
            <div class="flex items-center gap-2">
                <h1 class="font-semibold">KEHADIRAN SISWA {{ $kelas->fullName }}</h1>
            </div>

            <section>
                <h1 class="font-semibold">Mata Pelajaran</h1>

                <livewire:table.admin.table-mata-pelajaran-kehadiran-siswa :kelas="$kelas" />
            </section>
        </div>
    </section>
</x-app-layout>
