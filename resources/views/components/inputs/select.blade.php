@props([
    'name' => '',
    'options' => [],
    'value' => '',
    'required' => false,
    'disabled' => false,
    'empty' => 'Tidak Ada Data',
])
<select
    name="{{ $name }}"
    value="{{ old($name, $value) }}"
    {{ $required ? 'required' : '' }}
    {{ $disabled ? 'disabled' : '' }}
    {{ $attributes->merge(['class' => 'rounded-md border border-zinc-300 p-2 px-4 pr-8 text-black disabled:opacity-50']) }}
>
    @forelse ($options as $option)
        <option value="{{ $option->value }}" {{ $option->label == $value ? 'selected' : '' }}>
            {{ $option->label }}
        </option>
    @empty
        <option value="">
            {{ $empty }}
        </option>
    @endforelse
</select>
