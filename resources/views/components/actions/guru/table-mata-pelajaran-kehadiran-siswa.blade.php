<div class="flex justify-end gap-2">
    <input type="date" class="rounded-md border border-zinc-300 p-2 px-4 text-black" wire:model="tanggal" />

    <x-inputs.select
        :options="$this->kelases()"
        wire:model.live="kelas"
        empty="Anda tidak mengajar kelas manapun"
        class="rounded-md border border-zinc-300 p-2 px-4 text-black"
    />

    <button class="rounded-md bg-green-600 p-2 px-4 text-white" wire:click="export">Unduh</button>
</div>
