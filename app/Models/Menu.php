<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'label',
        'route',
        'icon',
        'role',
        'parent_id',
        'menu_status_id',
        'menu_location_id',
    ];

    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id');
    }

    public function status()
    {
        return $this->belongsTo(MenuStatus::class, 'menu_status_id');
    }

    public function location()
    {
        return $this->belongsTo(MenuLocation::class, 'menu_location_id');
    }
}
