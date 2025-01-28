<?php

namespace App\Livewire\Table\Admin;

use App\Exports\KehadiranSiswaExport;
use App\Helpers\Column;
use App\Livewire\BaseTable;
use App\Models\KehadiranSiswa;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Url;

class TableMataPelajaranKehadiranSiswa extends BaseTable
{
    public $actionView = 'components.actions.admin.table-mata-pelajaran-kehadiran-siswa';

    public $searchColumns = ['name', 'guru.user.name'];

    #[Url()]
    public $tanggal;

    public function export()
    {
        $filename = 'kehadiran-siswa-' . $this->kelas->fullName . '-' . $this->tanggal . '.xlsx';
        $filename = str_replace('/', '-', $filename);
        return (new KehadiranSiswaExport)
            ->forKelas($this->kelas)
            ->forTanggal($this->tanggal)
            ->download($filename);
    }

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
        if (!$this->tanggal) {
            $this->tanggal = now()->format('Y-m-d');
        }
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
