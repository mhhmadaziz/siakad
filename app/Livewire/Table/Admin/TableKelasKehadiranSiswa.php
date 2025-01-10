<?php

namespace App\Livewire\Table\Admin;

use App\Helpers\Column;
use App\Livewire\BaseTable;
use App\Models\Kelas;
use App\Traits\WithCurrentTahunAkademik;
use Illuminate\Database\Eloquent\Builder;

class TableKelasKehadiranSiswa extends BaseTable
{
    use WithCurrentTahunAkademik;

    public $actionView = '';

    public function query(): Builder
    {
        return Kelas::query()
            ->withCount(['siswas', 'mataPelajarans'])
            ->currentTahunAkademik()
            ->latest();
    }

    public function columns(): array
    {
        return [
            Column::make('fullName', 'Kelas'),
            Column::make('siswas_count', 'Jumlah Siswa'),
            Column::make('mata_pelajarans_count', 'Jumlah Mata Pelajaran'),
            Column::make('id', '')->component('columns.actions.admin.aksi-table-kelas-kehadiran-siswa'),
        ];
    }
}
