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
    public $actionView = 'components.actions.admin.table-kelas-tahun-akademik-action';

    public TahunAkademik $tahunAkademik;

    public function query(): Builder
    {
        return Kelas::query()
            ->with(['tahunAkademik'])
            ->whereHas('tahunAkademik', function ($query) {
                $query->where('id', $this->tahunAkademik->id);
            });
    }

    public function mount(TahunAkademik $tahunAkademik)
    {
        $this->tahunAkademik = $tahunAkademik;
    }

    public function columns(): array
    {
        return [
            Column::make('name', 'Kelas'),
            Column::make('id', ' ')->component('columns.actions.admin.aksi-table-kelas-tahun-akademik')
        ];
    }
}
