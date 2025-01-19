<?php

namespace App\Models;

use App\Services\TahunAkademikService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class JawabanSiswa extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'siswa_id',
        'tahun_akademik_id',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function tahunAkademik()
    {
        return $this->belongsTo(TahunAkademik::class);
    }

    public function jawabans()
    {
        return $this->hasMany(Jawaban::class);
    }

    public function scopeCurrentTahunAkademik($query)
    {
        $query->where('tahun_akademik_id', app(TahunAkademikService::class)->getCurrentTahunAkademik()->id);
    }

    public function getCreatedAtFormatedAttribute()
    {
        $cacheKey = 'jawaban_siswa_created_at_formated_' . $this->id . '_' . $this->created_at;

        return Cache::rememberForever($cacheKey, function () {
            return $this->created_at->locale('id')->isoFormat('D MMMM Y HH:mm');
        });
    }
}
