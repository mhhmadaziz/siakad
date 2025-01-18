<?php

namespace App\Livewire\Table\Siswa;

use App\Helpers\Column;
use App\Livewire\BaseTable;
use App\Models\KelasSiswa;
use App\Models\User;
use App\Traits\WithTahunAkademik;
use Illuminate\Database\Eloquent\Builder;

class TableKelasJadwalMataPelajaran extends BaseTable
{

    public function query(): Builder
    {
        return KelasSiswa::query()
            ->where('siswa_id', auth()->user()->siswa->id)
            ->with(['kelas', 'kelas.tahunAkademik']);
    }

    public function columns(): array
    {
        return [
            Column::make('kelas.fullName', 'Nama Kelas'),
            Column::make('kelas.tahunAkademik.name', 'Tahun Ajaran'),
            Column::make('kelas.id', '')->component('columns.actions.siswa.aksi-table-kelas-jadwal-siswa')
        ];
    }
}
