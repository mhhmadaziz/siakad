@props([
    'value',
])

<div class="flex justify-end gap-1">
    @if ($value->file_ppdb)
        <a href="{{ route('admin.cms.ppdb.show', $value->id) }}">
            <button class="rounded bg-primary px-2 py-1 text-sm text-white">Lihat</button>
        </a>

        <label
            for="{{ 'file-upload-' . $value->id }}"
            class="cursor-pointer rounded bg-amber-600 px-2 py-1 text-sm text-white"
        >
            <input
                type="file"
                class="sr-only"
                id="{{ 'file-upload-' . $value->id }}"
                wire:model.live="filePpdb.{{ $value->id }}"
                accept=".pdf"
            />
            Edit
        </label>

        <button
            class="rounded bg-red-600 px-2 py-1 text-sm text-white"
            wire:confirm="Apakah Anda yakin ingin menghapus file ini?"
            wire:click="deleteFilePpdb({{ $value->id }})"
        >
            Hapus
        </button>
    @else
        <a href="">
            <input
                type="file"
                class="sr-only"
                id="{{ 'file-upload-' . $value->id }}"
                wire:model.live="filePpdb.{{ $value->id }}"
                accept=".pdf"
            />
            <label
                for="{{ 'file-upload-' . $value->id }}"
                class="cursor-pointer rounded bg-amber-600 px-2 py-1 text-sm text-white"
            >
                Upload
            </label>
        </a>
    @endif
</div>
