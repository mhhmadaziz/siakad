<x-app-layout>
    <section class="mx-auto min-h-full w-full max-w-screen-xl space-y-4 px-16 pt-4 text-black">
        <div class="mb-4 min-h-screen space-y-2 rounded border border-zinc-300 p-2">
            <h1 class="mb-2 font-semibold">FORMULIR MATA PELAJARAN PILIHAN</h1>

            <h2 class="">
                Anda telah mengisi formulir mata pelajaran pilihan.
                <a href="{{ route('siswa.form.show') }}" class="text-blue-500 underline">
                    Lihat formulir yang telah diisi
                </a>
            </h2>
        </div>
    </section>
</x-app-layout>
