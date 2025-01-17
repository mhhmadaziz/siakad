<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pertanyaan extends Model
{

    use SoftDeletes;

    protected $fillable = [
        'pertanyaan',
        'required',
        'tipe_pertanyaan_id',
        'opsi',
    ];

    public function tipePertanyaan()
    {
        return $this->belongsTo(Option::class, 'tipe_pertanyaan_id');
    }

    public function getDecodedOpsiAttribute()
    {
        return json_decode($this->opsi, true) ?? [];
    }

    public function getKeyValueOpsiAttribute()
    {
        return collect($this->decodedOpsi)->mapWithKeys(fn($opsi) => [$opsi['value'] => $opsi['label']]);
    }

    public function getShowOpsiAttribute()
    {
        return $this->tipePertanyaan->name == 'Pilihan Ganda' || $this->tipePertanyaan->name == 'Pilihan Ganda (checkbox)';
    }

    public function getTipeOpsiAttribute()
    {
        return $this->tipePertanyaan->name == 'Pilihan Ganda' ? 'radio' : 'checkbox';
    }
}
