<?php

namespace App\Livewire\Table\Admin;

use App\Exports\HasilKuisionerExport;
use App\Helpers\Column;
use App\Livewire\BaseTable;
use App\Models\JawabanSiswa;
use App\Models\TahunAkademik;
use Illuminate\Database\Eloquent\Builder;

class TableHasilKuisioner extends BaseTable
{
    public TahunAkademik $tahunAkademik;
    public $actionView = 'components.actions.admin.table-hasil-kuisioner';
    /*public $searchColumns = ['user.name'];*/

    public function export()
    {
        $namaFile = 'hasil-kuisioner-' . $this->tahunAkademik->name . '.xlsx';
        $namaFile = str_replace('/', '-', $namaFile);

        return (new HasilKuisionerExport)->forTahunAkademik($this->tahunAkademik)
            ->download($namaFile);
    }

    public function query(): Builder
    {
        return JawabanSiswa::query()
            ->where('tahun_akademik_id', $this->tahunAkademik->id)
            ->with(['siswa.user']);
    }

    public function mount(TahunAkademik $tahunAkademik)
    {
        $this->tahunAkademik = $tahunAkademik;
    }

    public function columns(): array
    {
        return [
            Column::make('siswa.user.name', 'Nama Siswa'),
            Column::make('siswa.kelas', 'Kelas')->component('columns.kelas-siswa-hasil-kuisioner'),
            Column::make('createdAtFormated', 'Waktu Pengisian'),
            Column::make('id', '')->component('columns.actions.admin.aksi-table-hasil-kuisioner'),
        ];
    }
}
