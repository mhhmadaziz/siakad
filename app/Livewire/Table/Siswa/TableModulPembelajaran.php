<?php

namespace App\Livewire\Table\Siswa;

use App\Helpers\Column;
use App\Livewire\BaseTable;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\ModulPembelajaran;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class TableModulPembelajaran extends BaseTable
{
    public function query(): Builder
    {
        return ModulPembelajaran::query()
            ->with(['mataPelajaran', 'mataPelajaran.kelas']);
    }

    public function columns(): array
    {
        return [
            Column::make('name', 'Nama Modul'),
            Column::make('mataPelajaran.kelas.fullName', 'Kelas'),
            Column::make('mataPelajaran.name', 'Mata Pelajaran'),
            Column::make('id', '')->component('columns.actions.siswa.aksi-table-modul-pembelajaran'),
        ];
    }
}
