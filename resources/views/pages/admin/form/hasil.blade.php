<x-app-layout>
    <section class="mx-auto min-h-full w-full max-w-screen-xl space-y-4 px-16 pt-4 text-black">
        <div class="mb-8 rounded border border-zinc-300 p-2">
            <h1 class="mb-2 font-semibold">
                HASIL PENGISIAN FORMULIR MATA PELAJARAN PILIHAN
                {{ $tahunAkademik->name }}
            </h1>

            <livewire:table.admin.table-hasil-kuisioner :$tahunAkademik />
        </div>
    </section>
</x-app-layout>
