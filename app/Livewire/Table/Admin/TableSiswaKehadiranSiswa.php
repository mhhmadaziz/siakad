<?php

namespace App\Livewire\Table\Admin;

use App\Helpers\Column;
use App\Livewire\BaseTable;
use App\Models\KehadiranSiswa;
use App\Models\KehadiranSiswaChild;
use App\Models\Kelas;
use App\Models\KelasSiswa;
use App\Services\OptionService;
use Illuminate\Database\Eloquent\Builder;

class TableSiswaKehadiranSiswa extends BaseTable
{
    public $searchColumns = ['siswa.user.name'];

    public Kelas $kelas;
    public KehadiranSiswa $kehadiranSiswa;
    public $kehadiranSiswaChilds;


    public $statusKehadiranSiswa = [];
    public function updatedStatusKehadiranSiswa($value, $siswaId)
    {
        KehadiranSiswaChild::updateOrCreate([
            'kehadiran_siswa_id' => $this->kehadiranSiswa->id,
            'siswa_id' => $siswaId,
        ], [
            'status_kehadiran_id' => $value,
        ]);

        $this->dispatch('refresh-statistik');
    }


    public function query(): Builder
    {
        return KelasSiswa::query()
            ->with(['siswa', 'siswa.user'])
            ->where('kelas_id', $this->kelas->id);
    }

    public function getStatusKehadiranSiswa($siswaId)
    {
        return $this->kehadiranSiswaChilds[$siswaId] ?? app(OptionService::class)->getOptionValueByName('Tidak Hadir')->id;
    }

    public function mount(Kelas $kelas, KehadiranSiswa $kehadiranSiswa)
    {
        $this->kelas = $kelas;
        $this->perPage = $this->kelas->siswas->count();
        $this->kehadiranSiswa = $kehadiranSiswa;
        $this->kehadiranSiswaChilds = $this->kehadiranSiswa->kehadiranSiswaChildren->pluck('status_kehadiran_id', 'siswa_id');

        // check apakah jumlah dari status kehadiran siswa sudah sama dengan jumlah siswa di kelas
        if ($this->kehadiranSiswaChilds->count() !== $this->kelas->siswas->count()) {
            // isi status kehadiran siswa dengan default Tidak Hadir tetapi hanya untuk siswa yang belum ada status kehadirannya
            $this->kelas->siswas->each(function ($siswa) {
                if (!isset($this->kehadiranSiswaChilds[$siswa->id])) {
                    $this->kehadiranSiswaChilds[$siswa->id] = app(OptionService::class)->getOptionValueByName('Tidak Hadir')->id;
                }
            });

            $this->statusKehadiranSiswa = $this->kehadiranSiswaChilds;
        } else {
            $this->statusKehadiranSiswa = $this->kehadiranSiswaChilds;
        }
    }

    public function columns(): array
    {
        return [
            Column::make('siswa.user.name', 'Nama Siswa'),
            Column::make('siswa.nipd', 'NIPD'),
            Column::make('siswa.nisn', 'NISN'),
            Column::make('siswa.id', 'Status')->component('columns.status-kehadiran-siswa'),
        ];
    }
}
