<x-app-layout>
    <section class="mx-auto min-h-full w-full max-w-screen-xl space-y-4 px-16 pt-4 text-black">
        <div class="space-y-2 rounded border border-zinc-300 p-2">
            <div class="flex items-center gap-2">
                <h1 class="font-semibold">TAMBAH KELAS</h1>
            </div>

            <form
                action="{{ route('admin.tahun-akademik.kelas.store', $tahunAkademik->id) }}"
                method="post"
                class="grid grid-cols-2 divide-y divide-zinc-300 rounded-md border border-zinc-300"
            >
                @csrf

                <div class="flex items-center p-2">
                    <label for="">Tingkat Kelas</label>
                </div>
                <div class="flex flex-col justify-center p-2">
                    <x-inputs.select name="tingkat_kelas_id" :options="$tingkatKelas" />

                    @if ($errors->has('tingkat_kelas_id'))
                        <span class="text-red-500">
                            {{ $errors->first('tingkat_kelas_id') }}
                        </span>
                    @endif
                </div>

                <div class="flex items-center p-2">
                    <label for="">Nama Kelas</label>
                </div>
                <div class="flex flex-col justify-center p-2">
                    <x-inputs.text name="name" placeholder="A" />

                    @if ($errors->has('name'))
                        <span class="text-red-500">
                            {{ $errors->first('name') }}
                        </span>
                    @endif
                </div>

                <div></div>
                <div class="flex justify-end gap-2 p-2">
                    <a href="{{ route('admin.kelas.index') }}">
                        <button class="rounded bg-primary px-4 py-2 font-semibold text-white" type="button">
                            BATAL
                        </button>
                    </a>
                    <button class="rounded bg-green-600 px-4 py-2 font-semibold text-white" type="submit">
                        SIMPAN
                    </button>
                </div>
            </form>
        </div>
    </section>
</x-app-layout>
