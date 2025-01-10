<x-app-layout>
    <section class="mx-auto min-h-full w-full max-w-screen-xl space-y-4 px-16 pt-4 text-black">
        <div class="space-y-2 rounded border border-zinc-300 p-2">
            <h1 class="font-semibold">ATURAN & KEBIJAKAN</h1>

            <div class="rounded-lg bg-primary p-3 py-6">
                <div class="flex gap-2 text-white">
                    <i class="fa-solid fa-graduation-cap text-6xl"></i>
                    <div class="flex w-full items-center justify-between">
                        <div class="">
                            <h2>Tahun Ajaran</h2>
                            <h1 class="text-3xl font-semibold">{{ $tahunAkademik->name }}</h1>
                        </div>
                    </div>
                </div>
            </div>

            <div class="divide-y divide-zinc-300 rounded border border-zinc-300">
                <div class="flex items-center justify-between p-2">
                    <h1>Kalender Akademik</h1>
                    <div class="flex justify-end gap-2 text-white">
                        <button class="rounded-md bg-black px-4 py-2">UNDUH</button>
                        <button class="rounded-md bg-yellowCustom px-4 py-2 text-black">UNGGAH BARU</button>
                        <a href="{{ route('admin.tahun-akademik.kalender-akademik', $tahunAkademik->id) }}">
                            <button class="rounded-md bg-primary px-4 py-2">LIHAT</button>
                        </a>
                    </div>
                </div>

                <div class="flex items-center justify-between p-2">
                    <h1>Kelas</h1>
                    <div class="flex justify-end gap-2 text-white">
                        <a href="{{ route('admin.tahun-akademik.kelas', $tahunAkademik->id) }}">
                            <button class="rounded-md bg-primary px-4 py-2">LIHAT</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
