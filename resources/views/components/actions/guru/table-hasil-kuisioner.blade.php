<div class="flex items-center justify-between gap-2">
    <x-inputs.select
        name="mataPelajaranId"
        :options="$this->tahunAkademikOptions()"
        wire:model.live="tahunAkademikId"
    />
    <button
        class="rounded-md bg-green-600 p-2 px-4 font-semibold text-white disabled:opacity-50"
        wire:click="export"
        wire:loading.attr="disabled"
        wire:target="export"
    >
        Export
    </button>
</div>
