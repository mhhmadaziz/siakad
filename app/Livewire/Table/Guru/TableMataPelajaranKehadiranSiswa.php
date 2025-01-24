<?php

namespace App\Livewire\Table\Guru;

use App\Exports\KehadiranSiswaExport;
use App\Helpers\Column;
use App\Livewire\BaseTable;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Url;

class TableMataPelajaranKehadiranSiswa extends BaseTable
{

    public $actionView = 'components.actions.guru.table-mata-pelajaran-kehadiran-siswa';

    #[Url()]
    public $tanggal;

    #[Url()]
    public $kelas;

    public function export()
    {
        $kelas = Kelas::findOrfail($this->kelas);
        $filename = 'kehadiran-siswa-' . $kelas->fullName . '-' . $this->tanggal . '.xlsx';
        $filename = str_replace('/', '-', $filename);
        return (new KehadiranSiswaExport)
            ->forKelas($kelas)
            ->forTanggal($this->tanggal)
            ->download($filename);
    }

    public function kelases()
    {
        return Kelas::query()
            ->whereHas('mataPelajarans', function ($query) {
                $query->whereHas('guru', function ($query) {
                    $query->where('user_id', auth()->id());
                });
            })
            ->get()
            ->map(function ($kelas) {
                return
                    (object) [
                        'value' => $kelas->id,
                        'label' => $kelas->fullName,
                    ];
            });
    }

    public function query(): Builder
    {
        return MataPelajaran::query()
            ->with(['guru.user'])
            ->whereHas('guru', function ($query) {
                $query->where('user_id', auth()->id());
            });
    }

    public function mount()
    {
        if (!$this->tanggal) {
            $this->tanggal = now()->format('Y-m-d');
        }

        if (!$this->kelas) {
            $this->kelas = $this->kelases()->first()->value;
        }
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
