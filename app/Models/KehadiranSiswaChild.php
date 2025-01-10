<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KehadiranSiswaChild extends Model
{
    protected $table = 'kehadiran_siswa_children';

    protected $fillable = [
        'kehadiran_siswa_id',
        'siswa_id',
        'status_kehadiran_id',
    ];

    public function kehadiranSiswa()
    {
        return $this->belongsTo(KehadiranSiswa::class);
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function statusKehadiran()
    {
        return $this->belongsTo(Option::class, 'status_kehadiran_id');
    }
}
