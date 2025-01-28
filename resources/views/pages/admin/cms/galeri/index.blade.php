<x-app-layout>
    <section class="mx-auto min-h-full w-full max-w-screen-xl space-y-4 px-2 pt-4 text-black md:px-16">
        <div class="space-y-4 rounded border border-zinc-300 p-2">
            <h1 class="text-xl font-semibold">Galeri</h1>

            <section>
                <h1 class="text-lg">Foto</h1>
                <div class="my-1 flex justify-end">
                    <a href="{{ route('admin.cms.galeri.foto-create') }}">
                        <button class="rounded-md bg-black px-4 py-2 text-white">Tambah Foto</button>
                    </a>
                </div>

                <div class="grid grid-cols-2 gap-2 rounded-md border border-zinc-300 p-2 md:grid-cols-5">
                    @forelse ($fotos as $item)
                        <div class="flex flex-col gap-1 rounded-md border border-zinc-300 p-1">
                            <div class="relative" x-data>
                                <img
                                    src="{{ asset('storage/galeri/foto/' . $item['foto']) }}"
                                    alt="{{ $item['judul'] }}"
                                    class="h-32 w-full rounded-md border border-zinc-300 object-cover"
                                />

                                <form
                                    action=" {{ route('admin.cms.galeri.foto-delete', $item['foto']) }} "
                                    class="absolute right-2 top-2"
                                    method="post"
                                    @submit=" confirm('Apakah Anda yakin?') || event.preventDefault() "
                                >
                                    @csrf
                                    @method('DELETE')
                                    <button class="rounded-full bg-red-500 p-1 text-white">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="h-4 w-4"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12"
                                            />
                                        </svg>
                                    </button>
                                </form>
                            </div>

                            <div class="text-xs">
                                <h1 class="line-clamp-1 font-semibold">{{ $item['judul'] }}</h1>
                                <h2>{{ $item['tanggal'] }}</h2>
                            </div>
                        </div>
                    @empty
                        <a class="relative" href="{{ route('admin.cms.galeri.foto-create') }}">
                            <div
                                class="flex h-32 w-full cursor-pointer flex-col items-center justify-center rounded-md border border-zinc-300"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-8 w-8 text-zinc-300"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"
                                    />
                                </svg>
                            </div>
                        </a>
                    @endforelse
                </div>
            </section>

            <section>
                <h1 class="text-lg">Video</h1>
                <div class="my-1 flex justify-end">
                    <a href="{{ route('admin.cms.galeri.video-create') }}">
                        <button class="rounded-md bg-black px-4 py-2 text-white">Tambah Video</button>
                    </a>
                </div>

                <div class="grid grid-cols-2 gap-2 rounded-md border border-zinc-300 p-2 md:grid-cols-5" x-data>
                    @forelse ($videos as $item)
                        <div class="relative">
                            <x-embed :url="$item['video']" />

                            <form
                                action="{{ route('admin.cms.galeri.video-delete', $item['id']) }}"
                                method="post"
                                @submit=" confirm('Apakah Anda yakin?') || event.preventDefault() "
                            >
                                @csrf
                                @method('DELETE')

                                <button class="absolute right-2 top-2 rounded-full bg-red-500 p-1 text-white">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-4 w-4"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"
                                        />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    @empty
                        <a class="relative" href="{{ route('admin.cms.galeri.video-create') }}">
                            <div
                                class="flex h-32 w-full cursor-pointer flex-col items-center justify-center rounded-md border border-zinc-300"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-8 w-8 text-zinc-300"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"
                                    />
                                </svg>
                            </div>
                        </a>
                    @endforelse
                </div>
            </section>
        </div>
    </section>
</x-app-layout>
