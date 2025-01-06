<?php

namespace App\Models;

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
}
