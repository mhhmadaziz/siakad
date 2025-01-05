<x-app-layout>
    <section class="mx-auto min-h-full w-full max-w-screen-xl space-y-4 px-16 pt-4 text-black">
        <div class="space-y-2 rounded border border-zinc-300 p-2">
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.siswa.show', $siswa->id) }}">
                    <i class="fa-solid fa-angle-left"></i>
                </a>
                <h1 class="font-semibold">EDIT DATA SISWA</h1>
            </div>

            <div class="">
                <h1>
                    @if (session('status'))
                        <div class="rounded bg-green-500 p-2 text-white">
                            {{ session('status') }}
                        </div>
                    @endif
                </h1>

                <h1>
                    @if (session('error'))
                        <div class="rounded bg-red-500 p-2 text-white">
                            {{ session('error') }}
                        </div>
                    @endif
                </h1>
            </div>

            <form
                class="grid grid-cols-2 divide-y divide-zinc-300 rounded-md border border-zinc-300"
                action="{{ route('admin.siswa.update', $siswa->id) }}"
                method="POST"
            >
                @csrf
                @method('PUT')

                <div class="p-2">
                    <div class="mx-auto h-56 max-w-44 bg-zinc-400"></div>
                </div>
                <div class="flex items-center p-2">
                    <div class="flex w-full items-center justify-center">
                        <label
                            for="file-upload"
                            class="flex w-full cursor-pointer items-center divide-x divide-zinc-500 rounded border border-zinc-500"
                        >
                            <span class="flex-1 p-2">Tidak ada file yang dipilih</span>
                            <div class="bg-zinc-100 p-2 px-4">
                                <span class="text-gray-700">Pilih Foto</span>
                            </div>
                        </label>
                        <input id="file-upload" type="file" class="sr-only" />
                    </div>
                </div>

                @foreach ($forms as $item)
                    @if ($item->type === 'header')
                        <div class="col-span-2">
                            <div class="p-2">
                                <h2 id="{{ $item->value }}" class="font-semibold">{{ $item->label }}</h2>
                            </div>
                        </div>

                        @continue
                    @endif

                    <div class="flex items-center p-2">
                        <label for="{{ $item->name }}">
                            {{ $item->label }}
                        </label>
                    </div>
                    <div class="flex flex-col justify-center p-2">
                        @if ($item->type === 'select')
                            <select
                                class="w-full rounded disabled:opacity-50"
                                name="{{ $item->name }}"
                                value="{{ old($item->name, $item->value) }}"
                                {{ $item->required ? 'required' : '' }}
                                {{ $item->disabled ? 'disabled' : '' }}
                            >
                                @foreach ($item->options as $option)
                                    <option
                                        value="{{ $option->value }}"
                                        {{ $option->label == $item->value ? 'selected' : '' }}
                                    >
                                        {{ $option->label }}
                                    </option>
                                @endforeach
                            </select>
                        @elseif ($item->type === 'textarea')
                            <textarea
                                class="w-full rounded disabled:opacity-50"
                                name="{{ $item->name }}"
                                {{ $item->required ? 'required' : '' }}
                                {{ $item->disabled ? 'disabled' : '' }}
                            >
{{ old($item->name, $item->value) }} </textarea
                            >
                        @else
                            <input
                                class="w-full rounded disabled:opacity-50"
                                autocomplete="off"
                                type="{{ $item->type }}"
                                name="{{ $item->name }}"
                                value="{{ old($item->name, $item->value) }}"
                                {{ $item->required ? 'required' : '' }}
                                {{ $item->disabled ? 'disabled' : '' }}
                            />
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
                    <a href="{{ route('admin.siswa.show', $siswa->id) }}">
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
