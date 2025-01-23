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
                <div class="grid grid-cols-2 gap-4">
                    <div class="col-span-2">
                        <input
                            type="file"
                            name="video"
                            id="video"
                            class="sr-only"
                            accept="video/*"
                            x-on:change="
                                videoFile = $event.target.files[0]
                                videoPreview = URL.createObjectURL(videoFile)
                            "
                        />
                        <label
                            for="video"
                            class="flex min-h-44 w-full cursor-pointer items-center justify-center rounded-md border border-zinc-300"
                        >
                            <span class="text-gray-700" x-show="!videoPreview">Pilih Video</span>

                            <video
                                class="w-full object-cover"
                                x-show="videoPreview"
                                x-bind:src="videoPreview"
                                x-cloak
                                controls
                            ></video>
                        </label>

                        <span class="text-xs">Max. 20MB</span>

                        @error('video')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
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
