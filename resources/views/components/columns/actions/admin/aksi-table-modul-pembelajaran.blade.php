@props([
    'value',
])

<div class="flex justify-end">
    <a href="{{ route('admin.modul-pembelajaran.show', $value) }}">
        <button class="rounded-md bg-primary px-2 py-1 text-sm text-white">Lihat</button>
    </a>
</div>
