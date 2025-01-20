<x-app-layout>
    <section class="mx-auto min-h-full w-full max-w-screen-xl space-y-4 px-16 pt-4 text-black">
        <div class="space-y-2 rounded border border-zinc-300 p-2">
            <h1 class="font-semibold">TAMBAH MODUL PEMBELAJARAN</h1>

            <form
                action="{{ route('guru.modul-pembelajaran.store') }}"
                method="post"
                enctype="multipart/form-data"
                class="grid grid-cols-2 divide-y divide-zinc-300 rounded-md border border-zinc-300"
            >
                @csrf

                @foreach ($forms as $item)
                    <div class="flex items-center p-2">
                        <label for="{{ $item->name }}">
                            {{ $item->label }}
                        </label>
                    </div>
                    <div class="flex flex-col justify-center p-2">
                        @if ($item->type === 'select')
                            <x-inputs.select
                                name="{{ $item->name }}"
                                :options="$item->options"
                                :required="$item->required"
                            />
                        @elseif ($item->type === 'file')
                            <x-inputs.file
                                name="{{ $item->name }}"
                                :required="$item->required"
                                :accept="$item->accept"
                            />
                        @else
                            <x-inputs.text name="{{ $item->name }}" :required="$item->required" :type="$item->type" />
                        @endif
                        @if ($errors->has($item->name))
                            <span class="text-red-500">
                                {{ $errors->first($item->name) }}
                            </span>
                        @endif
                    </div>
                @endforeach

                <div></div>
                <div class="flex justify-end gap-2 p-2">
                    <a href="">
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
