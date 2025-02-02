<x-app-layout>
    <section class="mx-auto min-h-full w-full max-w-screen-xl space-y-4 px-2 pt-4 text-black md:px-16">
        <div class="space-y-2 rounded border border-zinc-300 p-2">
            <div class="flex items-center gap-2">
                <h1 class="font-semibold">EDIT KELAS</h1>
            </div>

            <form
                action="{{ route('admin.kelas.update', $kelas->id) }}"
                method="post"
                class="grid divide-y divide-zinc-300 rounded-md border border-zinc-300 md:grid-cols-2"
            >
                @csrf
                @method('PUT')

                <div class="flex items-center p-2">
                    <label for="">Nama Kelas</label>
                </div>
                <div class="flex flex-col justify-center p-2">
                    <x-inputs.text name="name" placeholder="A" :value="$kelas->name" />

                    @if ($errors->has('name'))
                        <span class="text-red-500">
                            {{ $errors->first('name') }}
                        </span>
                    @endif
                </div>

                <div class="flex items-center p-2">
                    <label for="">Wali Kelas</label>
                </div>
                <div class="flex flex-col justify-center p-2">
                    <x-inputs.select
                        name="wali_kelas_id"
                        :options="$waliKelas"
                        :value="$kelas->waliKelas?->user?->name"
                    />

                    @if ($errors->has('wali_kelas_id'))
                        <span class="text-red-500">
                            {{ $errors->first('wali_kelas_id') }}
                        </span>
                    @endif
                </div>

                <div></div>
                <div class="flex justify-end gap-2 p-2">
                    <button class="rounded bg-green-600 px-4 py-2 font-semibold text-white" type="submit">
                        SIMPAN
                    </button>
                </div>
            </form>
        </div>
    </section>
</x-app-layout>
