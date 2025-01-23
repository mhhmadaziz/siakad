<x-app-layout>
    <section class="mx-auto min-h-full w-full max-w-screen-xl space-y-4 px-2 pt-4 text-black md:px-16">
        <div class="space-y-2 rounded border border-zinc-300 p-2">
            <h1 class="font-semibold">JADWAL MATA PELAJARAN {{ $kelas->fullName }}</h1>

            <!-- grid jadwal mata pelajaran -->
            <livewire:grid.admin.grid-jadwal-mata-pelajaran :$kelas />
        </div>
    </section>
</x-app-layout>
