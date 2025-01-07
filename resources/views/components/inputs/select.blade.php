@props([
    'name' => '',
    'options' => [],
    'value' => '',
    'required' => false,
    'disabled' => false,
])
<select
    class="w-full rounded disabled:opacity-50"
    name="{{ $name }}"
    value="{{ old($name, $value) }}"
    {{ $required ? 'required' : '' }}
    {{ $disabled ? 'disabled' : '' }}
>
    @foreach ($options as $option)
        <option value="{{ $option->value }}" {{ $option->label == $value ? 'selected' : '' }}>
            {{ $option->label }}
        </option>
    @endforeach
</select>
