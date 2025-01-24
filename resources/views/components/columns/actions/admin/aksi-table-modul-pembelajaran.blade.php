@props([
    'value',
])

<div class="flex justify-end gap-2">
    <a href="{{ route('admin.modul-pembelajaran.show', $value) }}">
        <button class="rounded-md bg-primary px-2 py-1 text-sm text-white">Lihat</button>
    </a>

    <form
        action="{{ route('admin.modul-pembelajaran.destroy', $value) }}"
        method="post"
        x-data
        @submit="
            confirm('Apakah Anda yakin?') || event.preventDefault()
        "
    >
        @csrf
        @method('DELETE')

        <button class="rounded-md bg-red-700 px-2 py-1 text-sm text-white">Hapus</button>
    </form>
</div>
