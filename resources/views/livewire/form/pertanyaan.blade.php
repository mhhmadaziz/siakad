<div>
    <section class="w-full space-y-4 rounded-md border border-zinc-300 p-4">
        <div class="flex items-end gap-4">
            <div class="flex-[2] space-y-2">
                <label for="" class="">Pertanyaan</label>
                <x-inputs.text wire:model.blur="editor.pertanyaan" />
            </div>

            <div class="flex-1">
                <x-inputs.select
                    :options="$tipePertanyaan"
                    name="tipe_pertanyaan_id"
                    wire:model.live="editor.tipe_pertanyaan_id"
                />
            </div>
        </div>

        @if ($pertanyaan->showOpsi)
            <div class="w-full space-y-2" x-data x-ref="opsi">
                <span>Opsi</span>
                @foreach ($editorOpsi as $key => $item)
                    <div class="" :key="$key">
                        <div class="flex items-center gap-2">
                            <input
                                type="{{ $pertanyaan->tipeOpsi }}"
                                id=""
                                name=""
                                disabled
                                class="cursor-not-allowed disabled:opacity-50"
                            />
                            <input
                                type="text"
                                class="rounded border border-zinc-300 p-2 disabled:opacity-50"
                                wire:model.blur="editorOpsi.{{ $key }}"
                            />

                            <button class="" wire:click="deleteOpsi('{{ $key }}')" wire:key="{{ $key }}">
                                <i
                                    class="fas fa-trash text-sm text-red-400"
                                    wire:loading.remove
                                    wire:target="deleteOpsi('{{ $key }}')"
                                ></i>
                                <i
                                    class="fas fa-spinner animate-spin text-sm text-red-400"
                                    wire:loading
                                    wire:target="deleteOpsi('{{ $key }}')"
                                ></i>
                            </button>
                        </div>
                    </div>
                @endforeach

                <button
                    class="ml-6 rounded border border-zinc-300 p-2 disabled:opacity-50"
                    wire:click="incrementOpsi"
                    wire:loading.attr="disabled"
                >
                    <i class="fas fa-plus text-sm text-zinc-400" wire:loading.class="animate-spin"></i>
                    Tambah opsi
                </button>
            </div>
        @endif

        <div class="flex justify-between">
            <div class="flex items-center gap-2">
                <input
                    type="checkbox"
                    id="required"
                    name="required"
                    wire:model.live="editor.required"
                    {{ $editor['required'] ? 'checked' : '' }}
                />
                <label for="required">Tidak boleh kosong</label>
            </div>

            <div class="">
                <button wire:click="$parent.hapusPertanyaan({{ $pertanyaan->id }})">
                    <i class="fas fa-trash text-2xl text-red-400"></i>
                </button>
            </div>
        </div>
    </section>
</div>
