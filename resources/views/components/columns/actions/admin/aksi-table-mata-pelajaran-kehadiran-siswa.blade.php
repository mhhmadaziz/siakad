@props([
    'value',
])

<div class="flex justify-end">
    <a href="{{ route('admin.kehadiran-siswa.mata-pelajaran.show', [$value->kelas->id, $value->id]) }}">
        <button class="rounded-md bg-primary px-2 py-1 text-sm text-white">Lihat</button>
    </a>
</div>
