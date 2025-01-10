@props([
    'value',
])

<div>
    <x-inputs.select
        name="{{ 'statusKehadiranSiswa' . $value }}"
        :options="$optionService->getSelectOptionsByCategoryKey('status_kehadiran')"
        wire:model.live="statusKehadiranSiswa.{{ $value }}"
        :value="$this->getStatusKehadiranSiswa($value)"
    />
</div>
