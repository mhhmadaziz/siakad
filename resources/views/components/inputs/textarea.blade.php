@props(['name' => '', 'value' => '', 'required' => false, 'disabled' => false])
<textarea
    class="w-full rounded disabled:opacity-50"
    name="{{ $name }}"
    {{ $required ? 'required' : '' }}
    {{ $disabled ? 'disabled' : '' }}
>
{{ old($name, $value) }} </textarea
>
