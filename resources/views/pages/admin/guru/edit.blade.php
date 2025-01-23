<x-app-layout>
    <section class="mx-auto min-h-full w-full max-w-screen-xl space-y-4 px-2 pt-4 text-black md:px-16">
        <div class="space-y-2 rounded border border-zinc-300 p-2">
            <h1 class="font-semibold">EDIT DATA GURU</h1>

            <form
                class="grid w-full divide-y divide-zinc-300 rounded-md border border-zinc-300 md:grid-cols-2"
                action="{{ route('admin.guru.update', $guru->id) }}"
                method="POST"
            >
                @csrf
                @method('PUT')

                <div class="w-full md:col-span-2">
                    <livewire:profile-photo-upload :user="$guru->user" />
                </div>

                @foreach ($forms as $item)
                    @if ($item->type === 'header')
                        <div class="md:col-span-2">
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
                    <button class="rounded bg-green-600 px-4 py-2 font-semibold text-white" type="submit">
                        SIMPAN
                    </button>
                </div>
            </form>
        </div>
    </section>
</x-app-layout>
