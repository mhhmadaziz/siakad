<?php

namespace App\Livewire\Table\Admin;

use App\Helpers\Column;
use App\Livewire\BaseTable;
use App\Models\Kelas;
use App\Traits\WithCurrentTahunAkademik;
use Illuminate\Database\Eloquent\Builder;

class TableKelas extends BaseTable
{
    use WithCurrentTahunAkademik;

    public $actionView = 'components.actions.admin.table-kelas-action';

    public function query(): Builder
    {
        return Kelas::query()
            ->with(['tahunAkademik'])
            ->withCount(['siswas'])
            ->currentTahunAkademik()
            ->orderBy('tingkat_kelas_id')
            ->orderBy('name')
            ->latest();
    }

    public function columns(): array
    {
        return [
            Column::make('fullName', 'Kelas'),
            Column::make('siswas_count', 'Jumlah Siswa'),
            Column::make('siswaLakiLaki', 'Laki Laki'),
            Column::make('siswaPerempuan', 'Perempuan'),
            Column::make('id', '')->component('columns.actions.admin.aksi-table-kelas'),
        ];
    }
}
