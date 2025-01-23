<x-app-layout>
    <section class="mx-auto min-h-full w-full max-w-screen-xl space-y-4 px-2 pt-4 text-black md:px-16">
        <div class="space-y-2 rounded border border-zinc-300 p-2">
            <h1 class="font-semibold">KELAS</h1>

            <livewire:table.admin.table-kelas-tahun-akademik :$tahunAkademik />
        </div>
    </section>
</x-app-layout>
