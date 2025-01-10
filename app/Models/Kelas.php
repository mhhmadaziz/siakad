<?php

namespace App\Models;

use App\Services\TahunAkademikService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';

    protected $fillable = [
        'name',
        'tingkat_kelas_id',
        'tahun_akademik_id',
    ];

    public function tahunAkademik()
    {
        return $this->belongsTo(TahunAkademik::class);
    }

    public function mataPelajarans()
    {
        return $this->hasMany(MataPelajaran::class);
    }

    public function tingkatKelas()
    {
        return $this->belongsTo(Option::class, 'tingkat_kelas_id');
    }

    public function siswas()
    {
        return $this->belongsToMany(Siswa::class, 'kelas_siswa', 'kelas_id', 'siswa_id');
    }

    public function kelasSiswa()
    {
        return $this->hasMany(KelasSiswa::class);
    }


    public function scopeCurrentTahunAkademik(Builder $query): void
    {
        $query->where('tahun_akademik_id', app(TahunAkademikService::class)->getCurrentTahunAkademik()->id);
    }


    public function getFullNameAttribute()
    {
        return $this->tingkatKelas->name . '-' . $this->name;
    }

    public function getSiswaPerempuanAttribute()
    {
        return $this->siswas()->whereHas('user.jenisKelamin', function ($q) {
            $q->where('name', 'P');
        })->count();
    }

    public function getSiswaLakiLakiAttribute()
    {
        return $this->siswas()->whereHas('user.jenisKelamin', function ($q) {
            $q->where('name', 'L');
        })->count();
    }

    public function getJadwalMataPelajaranAttribute()
    {
        return $this->mataPelajarans()->with('jadwalMataPelajarans')->get();
    }


    public function getJadwalMataPelajaransCountAttribute()
    {
        return $this->mataPelajarans()->with('jadwalMataPelajarans')
            ->get()
            ->map(function ($mataPelajaran) {
                return $mataPelajaran->jadwalMataPelajarans->count();
            })
            ->sum();
    }
}
