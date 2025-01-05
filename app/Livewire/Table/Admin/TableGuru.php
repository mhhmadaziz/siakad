<?php

namespace App\Livewire\Table\Admin;

use App\Helpers\Column;
use App\Livewire\BaseTable;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class TableGuru extends BaseTable
{

    public $actionView = 'components.actions.admin.table-guru-action';

    public $route = 'admin.guru';

    public function query(): Builder
    {
        return User::query()->with([
            'guru',
            'jenisKelamin',
        ])->role('guru');
    }

    public function columns(): array
    {
        return [
            Column::make('name', 'Nama'),
            Column::make('guru.nuptk', 'NUPTK'),
            Column::make('jenisKelamin.name', 'Jenis Kelamin'),
            Column::make('telepon', 'Telepon'),
            Column::make('id', ' ')->component('columns.actions.admin.aksi-detail'),
        ];
    }
}
