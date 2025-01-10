@props([
    'name' => '',
    'value' => '',
    'placeholder' => '',
    'required' => false,
    'disabled' => false,
    'type' => 'text',
])

<input
    class="w-full rounded disabled:opacity-50"
    autocomplete="off"
    type="{{ $type }}"
    name="{{ $name }}"
    value="{{ old($name, $value) }}"
    placeholder="{{ $placeholder }}"
    {{ $required ? 'required' : '' }}
    {{ $disabled ? 'disabled' : '' }}
/>
