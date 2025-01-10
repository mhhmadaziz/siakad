<?php

namespace App\Livewire\Table\Admin;

use App\Helpers\Column;
use App\Livewire\BaseTable;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use Illuminate\Database\Eloquent\Builder;

class TableMataPelajaranKehadiranSiswa extends BaseTable
{
    public $actionView = '';

    public Kelas $kelas;

    public function query(): Builder
    {
        return MataPelajaran::query()
            ->where('kelas_id', $this->kelas->id);
    }

    public function mount(Kelas $kelas)
    {
        $this->kelas = $kelas;
        $this->perPage = $this->kelas->mataPelajarans->count();
    }

    public function columns(): array
    {
        return [
            Column::make('name', 'Mata Pelajaran'),
            Column::make('guru.user.name', 'Nama Pengajar'),
            Column::make('', '')->component('columns.actions.admin.aksi-table-mata-pelajaran-kehadiran-siswa'),
        ];
    }
}
