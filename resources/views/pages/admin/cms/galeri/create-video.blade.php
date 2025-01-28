<x-app-layout>
    <section class="mx-auto min-h-full w-full max-w-screen-xl space-y-4 px-2 pt-4 text-black md:px-16">
        <div class="space-y-4 rounded border border-zinc-300 p-2">
            <h1 class="text-xl font-semibold">Tambah Video</h1>

            <form
                action="{{ route('admin.cms.galeri.video-store') }}"
                method="post"
                enctype="multipart/form-data"
                x-data="{
                    videoPreview: '',
                    videoUrl: null,
                }"
            >
                @csrf
                <div class="mb-4 grid md:grid-cols-2">
                    <label for="url">URL Video</label>
                    <input
                        class="w-full rounded disabled:opacity-50"
                        autocomplete="off"
                        type="text"
                        name="url"
                        placeholder="https://youtu.be/xxxxxxxxxx"
                        value="{{ old('url') }}"
                    />
                </div>
                <div class="col-span-2 flex justify-end">
                    <button type="submit" class="mt-4 rounded-md bg-zinc-700 px-4 py-2 text-white hover:bg-zinc-600">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </section>
</x-app-layout>
