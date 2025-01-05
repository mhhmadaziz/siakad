<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $fillable = ['option_category_id', 'name'];

    public function category()
    {
        return $this->belongsTo(OptionCategory::class, 'option_category_id');
    }
}
