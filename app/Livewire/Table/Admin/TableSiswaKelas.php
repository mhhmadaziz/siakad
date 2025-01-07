<?php

namespace App\Livewire\Table\Admin;

use App\Helpers\Column;
use App\Livewire\BaseTable;
use App\Models\Kelas;
use App\Models\KelasSiswa;
use App\Models\Siswa;
use Illuminate\Database\Eloquent\Builder;

class TableSiswaKelas extends BaseTable
{
    public Kelas $kelas;

    public $actionView = 'components.actions.admin.table-siswa-kelas-action';

    public function query(): Builder
    {
        $this->perPage = 1000;
        return KelasSiswa::query()
            ->with('siswa')
            ->where('kelas_id', $this->kelas->id);
    }

    public function mount(Kelas $kelas)
    {
        $this->kelas = $kelas;
    }

    public function columns(): array
    {
        return [
            Column::make('siswa.user.name', 'Nama Siswa'),
            Column::make('siswa.nisn', 'NISN'),
            Column::make('siswa.user.jenisKelamin.name', 'Jenis Kelamin'),
        ];
    }
}
