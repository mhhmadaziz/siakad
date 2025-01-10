<x-app-layout>
    <section class="mx-auto min-h-full w-full max-w-screen-xl space-y-4 px-16 pt-4 text-black">
        <div class="space-y-2 rounded border border-zinc-300 p-2">
            <h1 class="font-semibold">TAMBAH TAHUN AJARAN</h1>

            <form
                action="{{ route('admin.tahun-akademik.store') }}"
                method="post"
                class="grid grid-cols-2 divide-y divide-zinc-300 rounded-md border border-zinc-300"
            >
                @csrf

                <div class="flex items-center p-2">
                    <label for="">Nama Tahun Ajaran</label>
                </div>
                <div class="flex flex-col justify-center p-2">
                    <x-inputs.text name="name" placeholder="2020/2021" />

                    @if ($errors->has('name'))
                        <span class="text-red-500">
                            {{ $errors->first('name') }}
                        </span>
                    @endif
                </div>

                <div class="flex items-center p-2">
                    <label for="">Tanggal Mulai</label>
                </div>
                <div class="flex flex-col justify-center p-2">
                    <input type="date" name="mulai" value="{{ old('mulai') }}" />
                    @if ($errors->has('mulai'))
                        <span class="text-red-500">
                            {{ $errors->first('selesai') }}
                        </span>
                    @endif
                </div>

                <div class="flex items-center p-2">
                    <label for="">Tanggal Selesai</label>
                </div>
                <div class="flex flex-col justify-center p-2">
                    <input type="date" name="selesai" value="{{ old('selesai') }}" />
                    @if ($errors->has('selesai'))
                        <span class="text-red-500">
                            {{ $errors->first('selesai') }}
                        </span>
                    @endif
                </div>

                <div></div>
                <div class="flex justify-end gap-2 p-2">
                    <a href="{{ route('admin.tahun-akademik.index') }}">
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
