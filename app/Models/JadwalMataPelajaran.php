<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalMataPelajaran extends Model
{
    protected $table = 'jadwal_mata_pelajaran';


    protected $fillable = [
        'mata_pelajaran_id',
        'jam_mulai',
        'jam_selesai',
        'hari_id',
    ];

    public function mataPelajaran()
    {
        return $this->belongsTo(MataPelajaran::class);
    }

    public function hari()
    {
        return $this->belongsTo(Option::class, 'hari_id');
    }

    public function kehadiranSiswas()
    {
        return $this->hasMany(KehadiranSiswa::class);
    }

    protected function formatTime($time)
    {
        return date('H:i', strtotime($time));
    }

    public function getJamAttribute()
    {

        return $this->formatTime($this->jam_mulai) . ' - ' . $this->formatTime($this->jam_selesai);
    }
}
