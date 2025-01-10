<x-app-layout>
    <section class="mx-auto min-h-full w-full max-w-screen-xl space-y-4 px-16 pt-4 text-black">
        <div class="rounded border border-zinc-300 p-2">
            <h1 class="mb-2 font-semibold">TAMBAH SISWA</h1>

            <form
                action="{{ route('admin.siswa.store') }}"
                method="post"
                class="grid grid-cols-2 divide-y divide-zinc-300 rounded-md border border-zinc-300"
            >
                @csrf

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
                            <x-inputs.select
                                name="{{ $item->name }}"
                                :options="$item->options"
                                :required="$item->required"
                                :disabled="$item->disabled"
                            />
                        @elseif ($item->type === 'textarea')
                            <x-inputs.textarea
                                name="{{ $item->name }}"
                                :required="$item->required"
                                :disabled="$item->disabled"
                            />
                        @elseif ($item->type === 'password')
                            <x-inputs.password
                                name="{{ $item->name }}"
                                :required="$item->required"
                                :disabled="$item->disabled"
                            />
                        @else
                            <x-inputs.text
                                name="{{ $item->name }}"
                                :type="$item->type"
                                :required="$item->required"
                                :disabled="$item->disabled"
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
                    <a href="{{ route('admin.guru.index') }}">
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
