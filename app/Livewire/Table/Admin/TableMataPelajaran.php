<?php

namespace App\Livewire\Table\Admin;

use App\Helpers\Column;
use App\Livewire\BaseTable;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\User;
use App\Traits\WithTahunAkademik;
use Illuminate\Database\Eloquent\Builder;

class TableMataPelajaran extends BaseTable
{
    use WithTahunAkademik;

    public $actionView = 'components.actions.admin.table-mata-pelajaran-action';

    public $searchColumns = ['name', 'guru.user.name'];


    public function query(): Builder
    {
        return MataPelajaran::query()
            ->with(['kelas', 'guru.user'])
            ->whereHas('kelas', function ($query) {
                $query->where('tahun_akademik_id', $this->currentTahunAkademik->id);
            })
            ->latest();
    }

    public function columns(): array
    {
        return [
            Column::make('name', 'Mata Pelajaran'),
            Column::make('kelas.fullName', 'Kelas'),
            Column::make('guru.user.name', 'Guru'),
            Column::make('id', '')->component('columns.actions.admin.aksi-table-mata-pelajaran'),
        ];
    }
}
