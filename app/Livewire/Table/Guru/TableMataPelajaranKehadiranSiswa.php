<?php

namespace App\Livewire\Table\Guru;

use App\Helpers\Column;
use App\Livewire\BaseTable;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use Illuminate\Database\Eloquent\Builder;

class TableMataPelajaranKehadiranSiswa extends BaseTable
{

    public function query(): Builder
    {
        return MataPelajaran::query()
            ->with(['guru.user'])
            ->whereHas('guru', function ($query) {
                $query->where('user_id', auth()->id());
            });
    }

    public function columns(): array
    {
        return [
            Column::make('name', 'Mata Pelajaran'),
            Column::make('kelas.fullName', 'Kelas'),
            Column::make('kelas.tahunAkademik.name', 'Tahun Ajaran'),
            Column::make('id', '')->component('columns.actions.guru.aksi-table-mata-pelajaran-kehadiran-siswa'),
        ];
    }
}
