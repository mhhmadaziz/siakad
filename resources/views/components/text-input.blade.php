@props(['disabled' => false])

<input
    @disabled($disabled)
    {{ $attributes->merge(['class' => 'border-0 border-b-primary border-b-2 focus:border-0 focus:border-b-2 p-0 focus:ring-0']) }}
/>
