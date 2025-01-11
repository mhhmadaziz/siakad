<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModulPembelajaran extends Model
{

    protected $fillable = [
        'name',
        'file',
        'mata_pelajaran_id',
    ];

    public function mataPelajaran()
    {
        return $this->belongsTo(MataPelajaran::class);
    }
}
