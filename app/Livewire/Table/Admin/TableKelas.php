<?php

namespace App\Livewire\Table\Admin;

use App\Helpers\Column;
use App\Livewire\BaseTable;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class TableKelas extends BaseTable
{

    public $actionView = 'components.actions.admin.table-guru-action';

    public function query(): Builder
    {
        return Kelas::query();
    }

    public function columns(): array
    {
        return [
            Column::make('kelas', 'Kelas'),
            Column::make('nomor', 'Nomor Kelas'),
            Column::make('name', 'Nama Kelas'),
            Column::make('id', ' ')->component('columns.actions.admin.aksi-table-guru'),
        ];
    }
}
