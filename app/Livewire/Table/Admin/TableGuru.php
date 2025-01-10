<?php

namespace App\Livewire\Table\Admin;

use App\Enums\RoleEnum;
use App\Helpers\Column;
use App\Livewire\BaseTable;
use App\Models\Guru;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class TableGuru extends BaseTable
{
    public $actionView = 'components.actions.admin.table-guru-action';

    public $searchColumns = ['user.name'];

    public function query(): Builder
    {
        return Guru::query()
            ->with('user.jenisKelamin')
            ->whereHas('user', function ($query) {
                $query->role(RoleEnum::GURU->value);
            })
            ->latest();
    }

    public function columns(): array
    {
        return [
            Column::make('user.name', 'Nama'),
            Column::make('nuptk', 'NUPTK'),
            Column::make('user.jenisKelamin.name', 'Jenis Kelamin'),
            Column::make('user.telepon', 'Telepon'),
            Column::make('id', '')->component('columns.actions.admin.aksi-table-guru'),
        ];
    }
}
