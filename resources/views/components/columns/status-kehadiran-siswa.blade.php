@props([
    'value',
])
{{--
    <div>
    <x-inputs.select
    name="{{ 'statusKehadiranSiswa' . $value }}"
    :options="$optionService->getSelectOptionsByCategoryKey('status_kehadiran')"
    wire:model.live="statusKehadiranSiswa.{{ $value }}"
    :value="$this->getStatusKehadiranSiswa($value)"
    />
    @dump($optionService->getSelectOptionsByCategoryKey('status_kehadiran'))
    </div>
--}}

<div class="flex flex-row gap-4 space-x-2">
    @foreach ($optionService->getSelectOptionsByCategoryKey('status_kehadiran') as $option)
        <label class="inline-flex items-center">
            <input
                type="radio"
                name="{{ 'statusKehadiranSiswa' . $value }}"
                value="{{ $option->value }}"
                wire:model.live="statusKehadiranSiswa.{{ $value }}"
                class="form-radio h-4 w-4 text-indigo-600"
                {{ $this->getStatusKehadiranSiswa($value) == $option->value ? 'checked' : '' }}
            />
            <span class="ml-2 text-sm">{{ $option->label }}</span>
        </label>
    @endforeach
</div>
