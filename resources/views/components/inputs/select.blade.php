@props([
    'name' => '',
    'options' => [],
    'value' => '',
    'required' => false,
    'disabled' => false,
    'empty' => 'Tidak Ada Data',
])
<select
    class="w-full rounded disabled:opacity-50"
    name="{{ $name }}"
    {{ $required ? 'required' : '' }}
    {{ $disabled ? 'disabled' : '' }}
    {{ $attributes }}
>
    @forelse ($options as $option)
        <option value="{{ $option->value }}" {{ $option->value == $value ? 'selected' : '' }}>
            {{ $option->label }}
        </option>
    @empty
        <option value="">
            {{ $empty }}
        </option>
    @endforelse
</select>
