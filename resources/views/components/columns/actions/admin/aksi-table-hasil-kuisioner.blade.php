@props([
    'value',
])
<div class="flex justify-center">
    <a href="{{ route('admin.form.hasil.siswa', [$this->tahunAkademik->id, $value]) }}">
        <button class="rounded-md bg-primary px-2 py-1 text-sm text-white">Detail</button>
    </a>
</div>
