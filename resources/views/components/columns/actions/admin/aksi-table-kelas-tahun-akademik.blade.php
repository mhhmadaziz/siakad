@props([
    'value',
])
<div class="flex justify-end gap-2">
    <a href="{{ route('admin.kelas.show', $value) }}">
        <button class="rounded-md bg-primary px-2 py-1 text-sm text-white">DETAIL</button>
    </a>

    <a href="{{ route('admin.tahun-akademik.kelas.jadwal', [$this->tahunAkademik->id, $value]) }}">
        <button class="rounded-md bg-primary px-2 py-1 text-sm text-white">PENJADWALAN</button>
    </a>
</div>
