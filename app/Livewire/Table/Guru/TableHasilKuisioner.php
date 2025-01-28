<?php

namespace App\Livewire\Table\Guru;

use App\Exports\HasilKuisionerExport;
use App\Helpers\Column;
use App\Livewire\BaseTable;
use App\Models\JawabanSiswa;
use App\Models\TahunAkademik;
use App\Services\TahunAkademikService;
use Illuminate\Database\Eloquent\Builder;

class TableHasilKuisioner extends BaseTable
{
    public $tahunAkademikId;
    public TahunAkademik $tahunAkademik;

    public function updatedTahunAkademikId($value)
    {
        $this->tahunAkademik = TahunAkademik::find($value);
    }

    public $actionView = 'components.actions.guru.table-hasil-kuisioner';
    public $searchColumns = ['siswa.user.name'];

    public function tahunAkademikOptions()
    {
        return TahunAkademik::pluck('name', 'id')->map(function ($item, $key) {
            return (object) [
                'value' => $key,
                'label' => $item,
            ];
        });
    }

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

    public function mount()
    {
        $this->tahunAkademik = app(TahunAkademikService::class)->getCurrentTahunAkademik();
        $this->tahunAkademikId = $this->tahunAkademik->id;
    }

    public function columns(): array
    {
        return [
            Column::make('siswa.user.name', 'Nama Siswa'),
            Column::make('siswa.kelas', 'Kelas')->component('columns.kelas-siswa-hasil-kuisioner'),
            Column::make('createdAtFormated', 'Waktu Pengisian'),
            Column::make('id', '')->component('columns.actions.guru.aksi-table-hasil-kuisioner'),
        ];
    }
}
