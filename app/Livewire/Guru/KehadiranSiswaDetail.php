<?php

namespace App\Livewire\Guru;

use App\Models\KehadiranSiswa;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;

class KehadiranSiswaDetail extends Component
{
    public Kelas $kelas;
    public MataPelajaran $mataPelajaran;

    #[Url()]
    public $kehadiranSiswaId;
    public $kehadiranSiswa;

    public function updatedKehadiranSiswaId($value)
    {
        $this->kehadiranSiswa = KehadiranSiswa::find($value);
    }

    public function getKehadiranSiswaProperty()
    {
        return KehadiranSiswa::query()
            ->with('jadwalMataPelajaran')
            ->whereHas('jadwalMataPelajaran', function ($query) {
                $query->where('mata_pelajaran_id', $this->mataPelajaran->id);
            })
            ->latest();
    }

    public function pertemuan()
    {
        return $this->getKehadiranSiswaProperty()
            ->get()
            ->pluck('fullTime', 'id')
            ->map(function ($item, $key) {
                return (object) [
                    'value' => $key,
                    'label' => $item,
                ];
            });
    }

    #[On('refresh-statistik')]
    public function getStatistik()
    {
        return $this->kehadiranSiswa->statistik;
    }

    public function mount(Kelas $kelas, MataPelajaran $mataPelajaran)
    {
        $this->kelas = $kelas;
        $this->mataPelajaran = $mataPelajaran;

        if ($this->kehadiranSiswaId) {
            $this->kehadiranSiswa = KehadiranSiswa::find($this->kehadiranSiswaId);
        } else {
            $this->kehadiranSiswa = $this->getKehadiranSiswaProperty()->first();
        }
    }

    public function render()
    {
        return view('livewire.guru.kehadiran-siswa-detail');
    }
}
