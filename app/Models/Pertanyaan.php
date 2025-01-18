<?php

namespace App\Models;

use App\Services\TahunAkademikService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class Pertanyaan extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'pertanyaan',
        'required',
        'tipe_pertanyaan_id',
        'tahun_akademik_id',
        'opsi',
    ];

    protected static function boot()
    {
        parent::boot();

        static::created(function (Pertanyaan $pertanyaan) {
            Cache::forget('pertanyaans_current');
        });

        static::updated(function (Pertanyaan $pertanyaan) {
            Cache::forget('pertanyaans_current');
        });
    }

    public function tahunAkadmeik()
    {
        return $this->belongsTo(TahunAkademik::class);
    }

    public function tipePertanyaan()
    {
        return $this->belongsTo(Option::class, 'tipe_pertanyaan_id');
    }


    public function scopeCurrentTahunAkademik(Builder $query): void
    {
        $query->where('tahun_akademik_id', app(TahunAkademikService::class)->getCurrentTahunAkademik()->id);
    }

    public function scopeSelectedTahunAkademik(Builder $query, int $tahunAkademikId): void
    {
        $query->where('tahun_akademik_id', $tahunAkademikId);
    }

    public function getDecodedOpsiAttribute()
    {
        return json_decode($this->opsi, true) ?? [];
    }

    public function getKeyValueOpsiAttribute()
    {
        return collect($this->decodedOpsi)->mapWithKeys(fn($opsi) => [$opsi['value'] => $opsi['label']]);
    }

    public function getShowOpsiAttribute()
    {
        return $this->tipePertanyaan->name == 'Pilihan Ganda' || $this->tipePertanyaan->name == 'Pilihan Ganda (checkbox)';
    }

    public function getTipeOpsiAttribute()
    {
        return $this->tipePertanyaan->name == 'Pilihan Ganda' ? 'radio' : 'checkbox';
    }

    public function getTipeInputAttribute()
    {
        return match ($this->tipePertanyaan->name) {
            'Pilihan Ganda' => 'radio',
            'Pilihan Ganda (checkbox)' => 'checkbox',
            'Isian Singkat' => 'text',
            'Esai' => 'textarea',
            'Angka' => 'number',
            default => 'text',
        };
    }
}
