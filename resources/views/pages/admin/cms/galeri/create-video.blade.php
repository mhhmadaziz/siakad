<x-app-layout>
    <section class="mx-auto min-h-full w-full max-w-screen-xl space-y-4 px-16 pt-4 text-black">
        <div class="space-y-4 rounded border border-zinc-300 p-2">
            <h1 class="text-xl font-semibold">Tambah Video</h1>

            <form action="" method="post">
                @csrf
                <div class="grid grid-cols-2 gap-4">
                    <div class="col-span-2">
                        <input type="file" name="foto" id="foto" class="sr-only" />
                        <label
                            for="foto"
                            class="flex h-44 w-full cursor-pointer items-center justify-center rounded-md border border-zinc-300"
                        >
                            <span class="text-gray-700">Pilih Video</span>
                        </label>
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
