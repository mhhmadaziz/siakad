<?php

namespace App\Livewire\Table\Admin;

use App\Helpers\Column;
use App\Livewire\BaseTable;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class TableModulPembelajaran extends BaseTable
{

    public $actionView = 'components.actions.admin.table-guru-action';

    public function query(): Builder
    {
        return MataPelajaran::query()->with([
            'kelas',
        ]);
    }

    public function columns(): array
    {
        return [
            Column::make('kelas.shortName', 'Kelas'),
            Column::make('name', 'Mata Pelajaran'),
            Column::make('modul', 'Nama File'),
            Column::make('id', ' ')->component('columns.actions.admin.aksi-table-guru'),
        ];
    }
}
