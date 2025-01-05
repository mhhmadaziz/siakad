<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OptionCategory extends Model
{
    protected $fillable = ['name', 'key'];

    public function options()
    {
        return $this->hasMany(Option::class);
    }
}
