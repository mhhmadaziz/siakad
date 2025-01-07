<?php

namespace App\Livewire\Table\Admin;

use App\Helpers\Column;
use App\Livewire\BaseTable;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class TableMataPelajaranKelas extends BaseTable
{

    public $actionView = 'components.actions.admin.table-mata-pelajaran-kelas-action';

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
        ];
    }
}
