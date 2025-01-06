<?php

namespace App\Livewire\Table\Admin;

use App\Helpers\Column;
use App\Livewire\BaseTable;
use App\Models\Kelas;
use App\Models\User;
use App\Traits\WithCurrentTahunAkademik;
use Illuminate\Database\Eloquent\Builder;

class TableKelas extends BaseTable
{

    use WithCurrentTahunAkademik;

    public $actionView = 'components.actions.admin.table-guru-action';

    public function query(): Builder
    {
        return Kelas::query()
            ->with(['tahunAkademik'])
            ->whereHas('tahunAkademik', function ($query) {
                $query->where('id', $this->currentTahunAkademik->id);
            });
    }

    public function columns(): array
    {
        return [
            Column::make('name', 'Kelas'),
            Column::make('id', ' ')->component('columns.actions.admin.aksi-table-guru'),
        ];
    }
}
