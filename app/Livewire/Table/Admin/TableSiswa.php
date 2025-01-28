<?php

namespace App\Livewire\Table\Admin;

use App\Enums\RoleEnum;
use App\Helpers\Column;
use App\Livewire\BaseTable;
use App\Models\Siswa;
use App\Models\TahunAkademik;
use App\Models\User;
use App\Services\TahunAkademikService;
use Illuminate\Database\Eloquent\Builder;

class TableSiswa extends BaseTable
{
    public TahunAkademik $tahunAkademik;

    public $actionView = 'components.actions.admin.table-siswa-action';

    public $route = 'admin.siswa';

    public $searchColumns = ['user.name', 'nisn', 'user.jenisKelamin.name', 'user.telepon'];

    public function query(): Builder
    {
        return Siswa::query()
            ->with('user.jenisKelamin')
            ->whereHas('user', function ($query) {
                $query->role(RoleEnum::SISWA->value);
            })
            ->latest();
    }

    public function mount()
    {
        $this->tahunAkademik = app(TahunAkademikService::class)->getCurrentTahunAkademik();
    }

    public function columns(): array
    {
        return [
            Column::make('user.name', 'Nama'),
            Column::make('nisn', 'NISN'),
            Column::make('user.jenisKelamin.name', 'Jenis Kelamin'),
            Column::make('kelas', 'Kelas')->component('columns.kelas-siswa-hasil-kuisioner'),
            Column::make('user.telepon', 'Telepon'),
            Column::make('id', ' ')->component('columns.actions.admin.aksi-detail'),
        ];
    }
}
