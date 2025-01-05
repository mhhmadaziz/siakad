<?php

namespace App\Livewire\Table\Admin;

use App\Helpers\Column;
use App\Livewire\BaseTable;
use App\Models\Kelas;
use App\Models\TahunAkademik;
use App\Models\User;
use App\Traits\WithTahunAkademik;
use Illuminate\Database\Eloquent\Builder;

class TableKelasTahunAkademik extends BaseTable
{
    public $actionView = 'components.actions.admin.table-guru-action';

    public TahunAkademik $tahunAkademik;

    public function query(): Builder
    {
        return Kelas::query()
            ->with(['tahunAkademik'])
            ->whereHas('tahunAkademik', function ($query) {
                $query->where('id', $this->tahunAkademik->id);
            });
    }

    public function columns(): array
    {
        return [
            Column::make('kelas', 'Kelas'),
            Column::make('nomor', 'Nomor Kelas'),
            Column::make('name', 'Nama Kelas'),
            Column::make('id', ' ')->component('columns.actions.admin.aksi-table-kelas-tahun-akademik')
        ];
    }
}
