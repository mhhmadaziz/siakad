<?php

namespace App\Livewire\Table\Admin;

use App\Helpers\Column;
use App\Livewire\BaseTable;
use App\Models\JadwalMataPelajaran;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class TableJadwalMataPelajaran extends BaseTable
{
    public $actionView = 'components.actions.admin.table-guru-action';

    public $searchColumns = ['hari'];

    public function query(): Builder
    {
        return JadwalMataPelajaran::query()->with([
            'mataPelajaran.kelas',
            'mataPelajaran.guru.user',
        ]);
    }

    public function columns(): array
    {
        return [
            Column::make('mataPelajaran.kelas.shortName', 'Kelas'),
            Column::make('hari', 'Hari'),
            Column::make('jam', 'Jam'),
            Column::make('mataPelajaran.name', 'Mata Pelajaran'),
            Column::make('mataPelajaran.guru.user.name', 'Guru'),
            Column::make('id', ' ')->component('columns.actions.admin.aksi-table-guru'),
        ];
    }
}
