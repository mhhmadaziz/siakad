<div>
    <div class="my-2 flex items-center justify-between">
        <input type="text" placeholder="Cari" class="rounded border-zinc-300" wire:model.live.debounce.500ms="search" />

        @includeWhen($actionView !== '', $actionView)
    </div>
    <div class="relative rounded-md border border-zinc-300" x-data="{
        selectAll: false,
    }">
        <table class="w-full">
            <thead>
                <tr class="border-b border-zinc-300 text-left">
                    @if ($this->checkbox)
                        <th class="w-10 p-2">
                            <input
                                type="checkbox"
                                wire:model.live="selectedAll"
                                x-model="selectAll"
                                wire:loading.attr="disabled"
                            />
                        </th>
                    @endif

                    @if ($this->numbering)
                        <th class="w-10 p-2">No</th>
                    @endif

                    @foreach ($this->columns() as $column)
                        <th class="p-2">{{ $column->label }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @forelse ($this->data() as $row)
                    <tr class="border-b border-zinc-300">
                        @if ($this->checkbox)
                            <td class="p-2">
                                <input
                                    type="checkbox"
                                    wire:model.live="selected"
                                    value="{{ $row['id'] }}"
                                    x-bind:id="'checkbox-' + {{ $row['id'] }}"
                                    x-bind:checked="selectAll"
                                    wire:loading.attr="disabled"
                                />
                            </td>
                        @endif

                        @if ($this->numbering)
                            <td class="p-2">
                                {{ $loop->iteration }}
                            </td>
                        @endif

                        @foreach ($this->columns() as $column)
                            <td class="p-2">
                                @php
                                    if (Str::contains($column->key, '.')) {
                                        $keys = explode('.', $column->key);

                                        $value = $row;

                                        foreach ($keys as $key) {
                                            $value = $value[$key];
                                            if (is_null($value)) {
                                                break;
                                            }
                                        }
                                    } elseif ($column->key === '') {
                                        $value = $row;
                                    } else {
                                        $value = $row[$column->key];
                                    }
                                @endphp

                                <x-dynamic-component :component="$column->component" :value="$value ?? '-'" />
                            </td>
                        @endforeach
                    </tr>
                @empty
                    <tr class="border-b border-zinc-300">
                        <td class="p-2 text-center" colspan="{{ count($this->columns()) }}">Tidak ada data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!--loading overlay-->
        <div
            wire:loading.flex
            wire:target="gotoPage, nextPage, previousPage, search"
            class="absolute top-0 flex h-full w-full items-center justify-center bg-white/20 backdrop-blur-sm"
        >
            <span class="text-2xl font-semibold">Loading...</span>
        </div>

        <div class="p-2">
            {{
                $this->data()->links(
                    data: [
                        'scrollTo' => false,
                    ],
                )
            }}
        </div>
    </div>
</div>
