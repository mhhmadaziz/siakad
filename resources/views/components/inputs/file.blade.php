@props([
    'label' => 'Pilih File',
    'name' => 'file',
    'required' => false,
    'accept' => 'image/*',
    'multiple' => false,
])
<div class="flex w-full items-center justify-center" x-data>
    <label
        for="{{ $name }}"
        class="flex w-full cursor-pointer items-center divide-x divide-zinc-500 rounded border border-zinc-500"
    >
        <span class="flex-1 p-2" x-ref="label">Tidak ada file yang dipilih</span>
        <div class="bg-zinc-100 p-2 px-4">
            <span class="text-gray-700">
                {{ $label }}
            </span>
        </div>
    </label>
    <input
        id="{{ $name }}"
        type="file"
        class="sr-only"
        name="{{ $name }}"
        x-on:change="
            const label = $refs.label
            const files = $el.files
            if (files.length === 1) {
                label.innerText = files[0].name
            } else {
                label.innerText = files.length + ' file dipilih'
            }
        "
        {{ $required ? 'required' : '' }}
        {{ $accept ? 'accept=' . $accept : '' }}
        {{ $multiple ? 'multiple' : '' }}
        {{ $attributes }}
    />
</div>
