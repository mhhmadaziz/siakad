<?php

namespace App\Services;

use App\Models\Option;
use App\Models\OptionCategory;
use Illuminate\Support\Facades\Cache;

class OptionService
{
    public function getOptionsByCategoryKey(string $categoryKey): array
    {
        return Cache::rememberForever("options.{$categoryKey}", function () use ($categoryKey) {
            return Option::whereHas('category', fn($query) => $query->where('key', $categoryKey))
                ->get()
                ->mapWithKeys(fn($option) => [$option->id => $option->name])
                ->toArray();
        });
    }

    public function getSelectOptionsByCategoryKey(string $categoryKey)
    {
        // convert array to object with value and label
        return collect($this->getOptionsByCategoryKey($categoryKey))
            ->map(fn($value, $key) => (object) ['value' => $key, 'label' => $value])
            ->values();
    }

    public function getOptionCategoryKey(string $key)
    {
        return Cache::rememberForever("option_categories.{$key}", function () use ($key) {
            return OptionCategory::where('key', $key)->first();
        });
    }
}
