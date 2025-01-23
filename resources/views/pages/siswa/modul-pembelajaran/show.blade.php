<x-app-layout>
    <section class="mx-auto min-h-full w-full max-w-screen-xl space-y-4 px-2 pt-4 text-black md:px-16">
        <div class="space-y-2 rounded border border-zinc-300 p-2">
            <h1 class="font-semibold">{{ $modulPembelajaran->name }}</h1>
            <div class="flex justify-end">
                <a
                    href="{{
                        route('pdf.download', urlencode('modul-pembelajaran/' . $modulPembelajaran->file)) .
                            '?name=' .
                            urlencode($modulPembelajaran->name)
                    }}"
                >
                    <button class="rounded bg-primary px-4 py-2 text-white">Unduh</button>
                </a>
            </div>

            <livewire:pdf-viewer src="{{ asset('storage/modul-pembelajaran/' . $modulPembelajaran->file) }}" />
        </div>
    </section>
</x-app-layout>
