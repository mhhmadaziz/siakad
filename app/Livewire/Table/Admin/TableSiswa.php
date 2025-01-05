<?php

namespace App\Livewire\Table\Admin;

use App\Helpers\Column;
use App\Livewire\BaseTable;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class TableSiswa extends BaseTable
{

    public $actionView = 'components.actions.admin.table-guru-action';

    public $route = 'admin.siswa';

    public function query(): Builder
    {
        return User::query()->with([
            'siswa',
            'jenisKelamin',
        ])->role('siswa');
    }

    public function columns(): array
    {
        return [
            Column::make('name', 'Nama'),
            Column::make('siswa.nisn', 'NISN'),
            Column::make('jenisKelamin.name', 'Jenis Kelamin'),
            Column::make('telepon', 'Telepon'),
            Column::make('id', ' ')->component('columns.actions.admin.aksi-detail'),
        ];
    }
}
