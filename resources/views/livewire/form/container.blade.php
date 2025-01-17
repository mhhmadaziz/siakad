<div class="mt-8 space-y-4">
    @forelse ($pertanyaans as $item)
        <livewire:form.pertanyaan wire:key="{{ 'pertanyaan' . $item->id }}" :pertanyaan="$item" />
    @empty
        <div class="text-center text-gray-400">
            <p>Belum ada pertanyaan</p>
        </div>
    @endforelse

    <button
        class="flex w-full items-center justify-center rounded-md border border-zinc-300 py-4"
        wire:click="tambahPertanyaan"
        wire:loading.attr="disabled"
    >
        <div wire:loading>
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-8 w-8 animate-spin text-zinc-400"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
            >
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
        </div>

        <svg
            xmlns="http://www.w3.org/2000/svg"
            class="h-8 w-8 text-zinc-400"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
            wire:loading.remove
        >
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
        </svg>
    </button>
</div>
