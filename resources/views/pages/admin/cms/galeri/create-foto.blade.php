<x-app-layout>
    <section class="mx-auto min-h-full w-full max-w-screen-xl space-y-4 px-16 pt-4 text-black">
        <div class="space-y-4 rounded border border-zinc-300 p-2">
            <h1 class="text-xl font-semibold">Tambah Foto</h1>

            <form action="{{ route('admin.cms.galeri.foto-store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-2 gap-4">
                    <div class="flex flex-col gap-2">
                        <label for="judul">Judul</label>
                        <input
                            type="text"
                            name="judul"
                            id="judul"
                            class="rounded-md border border-zinc-300 p-2"
                            value="{{ old('judul') }}"
                        />

                        @error('judul')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex flex-col gap-2">
                        <label for="tanggal">Tanggal</label>
                        <input
                            type="date"
                            name="tanggal"
                            id="tanggal"
                            class="rounded-md border border-zinc-300 p-2"
                            value="{{ old('tanggal') }}"
                        />

                        @error('tanggal')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div
                        class="col-span-2"
                        x-data="{
                            previewEl: null,
                            previewImage() {
                                const file = document.getElementById('foto').files[0]
                                this.previewEl = document.getElementById('preview')
                                const reader = new FileReader()

                                reader.onloadend = () => {
                                    this.previewEl.src = reader.result
                                }

                                if (file) {
                                    reader.readAsDataURL(file)
                                }
                            },
                        }"
                    >
                        <input
                            type="file"
                            name="foto"
                            id="foto"
                            class="sr-only"
                            accept="image/png, image/jpeg, image/jpg"
                            x-on:change="previewImage"
                        />
                        <label
                            for="foto"
                            class="flex min-h-44 w-full cursor-pointer items-center justify-center rounded-md border border-zinc-300"
                        >
                            <span class="text-gray-700" x-show="!previewEl">Pilih Foto</span>
                            <div class="h-64" x-show="previewEl" x-cloak>
                                <img id="preview" alt="logo" class="h-full w-full object-cover" />
                            </div>
                        </label>

                        @error('foto')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-span-2 flex justify-end">
                    <button type="submit" class="mt-4 rounded-md bg-black px-4 py-2 text-white hover:bg-zinc-900">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </section>
</x-app-layout>
