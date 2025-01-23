@props([
    'value',
])
<div class="flex justify-end gap-2">
    <a href="{{ route('admin.kelas.show', $value) }}">
        <button class="rounded-md bg-primary px-2 py-1 text-sm text-white">Lihat</button>
    </a>

    <a href="{{ route('admin.kelas.edit', $value) }}">
        <button class="rounded-md bg-amber-600 px-2 py-1 text-sm text-white">Edit</button>
    </a>

    <form
        action="{{ route('admin.kelas.destroy', $value) }}"
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
