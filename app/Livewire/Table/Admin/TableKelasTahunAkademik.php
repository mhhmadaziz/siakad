<?php

namespace App\Livewire\Table\Admin;

use App\Helpers\Column;
use App\Livewire\BaseTable;
use App\Models\Kelas;
use App\Models\TahunAkademik;
use App\Models\User;
use App\Traits\WithTahunAkademik;
use Illuminate\Database\Eloquent\Builder;

class TableKelasTahunAkademik extends BaseTable
{
    public $actionView = 'components.actions.admin.table-kelas-tahun-akademik-action';

    public TahunAkademik $tahunAkademik;

    public function query(): Builder
    {
        $this->perPage = 1000;
        return Kelas::query()
            ->with(['tahunAkademik'])
            ->withCount(['siswas', 'mataPelajarans'])
            ->whereHas('tahunAkademik', function ($query) {
                $query->where('id', $this->tahunAkademik->id);
            })
            ->orderBy('tingkat_kelas_id')
            ->orderBy('name')
            ->latest();
    }

    public function mount(TahunAkademik $tahunAkademik)
    {
        $this->tahunAkademik = $tahunAkademik;
    }

    public function columns(): array
    {
        return [
            Column::make('fullName', 'Kelas'),
            Column::make('waliKelas.user.name', 'Wali Kelas'),
            Column::make('siswas_count', 'Jumlah Siswa'),
            Column::make('siswaLakiLaki', 'Laki Laki'),
            Column::make('siswaPerempuan', 'Perempuan'),
            Column::make('mata_pelajarans_count', 'Jumlah Mata Pelajaran'),
            Column::make('jadwalMataPelajaransCount', 'Jumlah Jadwal'),
            Column::make('id', ' ')->component('columns.actions.admin.aksi-table-kelas-tahun-akademik')
        ];
    }
}
