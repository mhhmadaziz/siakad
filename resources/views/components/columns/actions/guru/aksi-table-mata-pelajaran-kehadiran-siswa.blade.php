@props([
    'value',
])

<div class="flex justify-end gap-2">
    <a href="{{ route('guru.kehadiran-siswa.show', $value) }}">
        <button class="rounded-md bg-primary px-2 py-1 text-sm text-white">Lihat</button>
    </a>
</div>
