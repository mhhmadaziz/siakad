<x-app-layout>
    <section class="mx-auto min-h-full w-full max-w-screen-xl space-y-4 px-16 pt-4 text-black">
        <div class="space-y-2 rounded border border-zinc-300 p-2">
            <h1 class="font-semibold">DATA SISWA {{ $siswa->user?->name }}</h1>

            <div class="flex items-center justify-end text-black">
                <a href="{{ route('admin.siswa.edit', $siswa->id) }}">
                    <button class="bg-yellowCustom px-4 py-2 text-sm font-semibold">
                        <i class="fa-solid fa-pen"></i>
                        EDIT DATA SISWA
                    </button>
                </a>
            </div>

            <div class="divide-y divide-zinc-300 rounded-md border border-zinc-300">
                <div class="py-2">
                    <div class="mx-auto h-56 max-w-44 bg-zinc-400"></div>
                </div>
                @foreach ($dataDiri as $key => $value)
                    <div class="grid grid-cols-2 px-1 py-2">
                        <div>
                            <h1>
                                @normalCase($key)
                            </h1>
                        </div>
                        <div>
                            <h2>
                                {{ $value }}
                            </h2>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</x-app-layout>
