<?php

namespace App\Service;

use App\Models\Cms;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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

    public function storeFoto($validated)
    {

        return DB::transaction(function () use ($validated) {

            $foto = $validated['foto'];
            $judul = $validated['judul'];
            $tanggal = $validated['tanggal'];

            $oldFoto = json_decode($this->getCms('galeri_foto'), true) ?? [];

            // store with json format foto file, judul, and tanggal
            $fileName = $foto->hashName();
            $oldFoto[] = [
                'foto' => $fileName,
                'judul' => $judul,
                'tanggal' => $tanggal,
            ];

            $this->upsertCms('galeri_foto', json_encode($oldFoto));
            Storage::disk('public')->putFileAs('galeri/foto', $foto, $fileName);

            return $fileName;
        });
    }

    public function storeVideo($validated)
    {
        return DB::transaction(function () use ($validated) {

            $video = $validated['video'];

            $oldVideo = json_decode($this->getCms('galeri_video'), true) ?? [];

            // store with json format video file, judul, and tanggal
            $fileName = $video->hashName();
            $oldVideo[] = [
                'video' => $fileName,
            ];

            $this->upsertCms('galeri_video', json_encode($oldVideo));
            Storage::disk('public')->putFileAs('galeri/video', $video, $fileName);

            return $fileName;
        });
    }

    public function deleteFoto($fileName)
    {
        return DB::transaction(function () use ($fileName) {

            $oldFoto = json_decode($this->getCms('galeri_foto'), true) ?? [];

            $newArrayFoto = array_filter($oldFoto, function ($item) use ($fileName) {
                return $item['foto'] != $fileName;
            });

            $this->upsertCms('galeri_foto', json_encode(array_values($newArrayFoto)));

            Storage::disk('public')->delete('galeri/foto/' . $fileName);

            return $fileName;
        });
    }
}
