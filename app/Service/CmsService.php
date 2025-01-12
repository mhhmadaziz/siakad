<?php

namespace App\Service;

use App\Models\Cms;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class CmsService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function getCms($key)
    {
        return Cache::rememberForever('cms_' . $key, function () use ($key) {
            return Cms::where('key', $key)->first()->value ?? null;
        });
    }

    public function upsertCms($key, $value)
    {
        return DB::transaction(function () use ($key, $value) {
            Cms::upsert([
                'key' => $key,
                'value' => $value,
            ], ['key'], ['value']);

            Cache::forget('cms_' . $key);
        });
    }
}
