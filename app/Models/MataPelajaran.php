<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MataPelajaran extends Model
{
    protected $table = 'mata_pelajaran';

    protected $fillable = [
        'name',
        'kelas_id',
        'guru_id',
        'modul'
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }

    public function jadwalMataPelajarans()
    {
        return $this->hasMany(JadwalMataPelajaran::class);
    }
}
