@props([
    'value',
])
<div class="flex justify-center">
    <a href="{{ route('siswa.jadwal-mata-pelajaran.show', $value) }}">
        <button class="rounded-md bg-primary px-2 py-1 text-sm text-white">Lihat</button>
    </a>
</div>
