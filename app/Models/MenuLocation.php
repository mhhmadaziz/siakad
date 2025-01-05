<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuLocation extends Model
{
    protected $table = 'menu_locations';
    protected $fillable = ['name'];

    public function menus()
    {
        return $this->hasMany(Menu::class);
    }
}
