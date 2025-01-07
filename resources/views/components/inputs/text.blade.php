@props([
    'name' => '',
    'value' => '',
    'placeholder' => '',
    'required' => false,
    'disabled' => false,
])

<input
    class="w-full rounded disabled:opacity-50"
    autocomplete="off"
    type="text"
    name="{{ $name }}"
    value="{{ old($name, $value) }}"
    placeholder="{{ $placeholder }}"
    {{ $required ? 'required' : '' }}
    {{ $disabled ? 'disabled' : '' }}
/>
