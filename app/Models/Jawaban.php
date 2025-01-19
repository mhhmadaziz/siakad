<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jawaban extends Model
{

    protected $fillable = [
        'jawaban_siswa_id',
        'pertanyaan_id',
        'jawaban',
    ];


    public function getDecodedJawabanAttribute()
    {
        return json_decode($this->jawaban, true) ?? [];
    }

    public function jawabanSiswa()
    {
        return $this->belongsTo(JawabanSiswa::class);
    }

    public function pertanyaan()
    {
        return $this->belongsTo(Pertanyaan::class);
    }
}
