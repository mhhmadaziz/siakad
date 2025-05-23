<x-app-layout>
    <section class="mx-auto min-h-full w-full max-w-screen-xl space-y-4 px-2 pt-4 text-black md:px-16">
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
                    <div class="mx-auto h-56 max-w-44 bg-zinc-400">
                        <img
                            src="{{ $siswa->user?->photoUrl }}"
                            alt="{{ $siswa->user?->name }}"
                            class="h-full w-full object-cover"
                        />
                    </div>
                </div>
                @foreach ($dataDiri as $key => $value)
                    <div class="grid px-1 py-2 md:grid-cols-2">
                        <div>
                            <h1 class="font-semibold">
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

                <div class="grid px-1 py-2 md:grid-cols-2">
                    <div>
                        <h1 class="font-semibold">Kelas</h1>
                    </div>
                    <div>
                        <h2>
                            @foreach ($siswa->kelas as $item)
                                {{ $item->fullName }}
                                <br />
                            @endforeach
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
