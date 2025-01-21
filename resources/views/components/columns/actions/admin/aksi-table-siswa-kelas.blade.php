@props([
    'value',
])

<div class="flex items-center justify-end" wire:key="hapus-{{ $value }}">
    <button
        class="rounded-md bg-red-600 px-4 py-2 text-white disabled:opacity-50"
        wire:click="delete({{ $value }})"
        wire:loading.attr="disabled"
        wire:target="delete({{ $value }})"
    >
        Hapus dari kelas
    </button>
</div>
