@props([
    'value',
])

@php
    $kelas = $value->map(function ($item) {
        return $item->tahun_akademik_id == $this->tahunAkademik->id ? $item : null;
    });
@endphp

<div>
    <ul>
        @forelse ($kelas as $item)
            <li>
                {{ $item?->fullName }}
            </li>
        @empty
            -
        @endforelse
    </ul>
</div>
