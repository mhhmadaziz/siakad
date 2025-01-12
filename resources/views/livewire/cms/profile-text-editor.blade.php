<div class="space-y-2">
    <h1 class="text-lg">Deskripsi Sekolah</h1>
    <x-alert />

    <form wire:submit="save">
        <livewire:quill-text-editor wire:model="text" theme="snow" />
        <div class="mt-2 flex justify-end">
            <button type="submit" class="rounded bg-primary px-4 py-2 text-white">Simpan</button>
        </div>
    </form>
</div>
