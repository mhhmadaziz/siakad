<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalMataPelajaran extends Model
{
    protected $table = 'jadwal_mata_pelajaran';


    protected $fillable = [
        'mata_pelajaran_id',
        'hari',
        'jam_mulai',
        'jam_selesai',
    ];

    public function mataPelajaran()
    {
        return $this->belongsTo(MataPelajaran::class);
    }

    public function getJamAttribute()
    {
        return $this->jam_mulai . ' - ' . $this->jam_selesai;
    }
}
