<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $table = 'guru';

    protected $with = ['user'];

    protected $fillable = [
        'user_id',
        'nuptk',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
