<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuStatus extends Model
{
    protected $table = 'menu_statuses';
    protected $fillable = ['name'];

    public function menus()
    {
        return $this->hasMany(Menu::class);
    }
}
