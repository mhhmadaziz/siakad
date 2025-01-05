<x-app-layout>
    <section class="mx-auto min-h-full w-full max-w-screen-xl space-y-4 px-16 pt-4 text-black">
        <div class="rounded border border-zinc-300 p-2">
            <h1 class="mb-2 font-semibold">JUMLAH GURU</h1>
            <div class="grid grid-cols-2 rounded border border-zinc-300 p-2 text-center">
                <div class="divide-y">
                    <h2 class="py-2 font-semibold text-green-500">LAKI-LAKI</h2>
                    <h3 class="py-4 text-2xl font-semibold">{{ $jumlahGuru->lakiLaki }}</h3>
                </div>

                <div class="divide-y">
                    <h2 class="py-2 font-semibold text-green-500">PEREMPUAN</h2>
                    <h3 class="py-4 text-2xl font-semibold">{{ $jumlahGuru->perempuan }}</h3>
                </div>
            </div>
        </div>

        <div class="space-y-2 rounded border border-zinc-300 p-2">
            <h1 class="font-semibold">SEMUA GURU</h1>

            <!--table-->
            <livewire:table.admin.table-guru />
        </div>
    </section>
</x-app-layout>
