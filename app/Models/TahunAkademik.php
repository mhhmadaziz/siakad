<?php

namespace App\Models;

use App\Services\TahunAkademikService;
use Illuminate\Database\Eloquent\Model;

class TahunAkademik extends Model
{
    protected $table = 'tahun_akademik';

    protected $fillable = [
        'name',
        'mulai',
        'selesai',
    ];

    public function kelas()
    {
        return $this->hasMany(Kelas::class);
    }
}
