<?php

namespace App\Livewire\Grid\Admin;

use App\Models\JadwalMataPelajaran;
use App\Models\Kelas;
use App\Services\OptionService;
use Livewire\Attributes\On;
use Livewire\Component;

class GridJadwalMataPelajaran extends Component
{
    public Kelas $kelas;

    #[On('refresh')]
    public function jadwalMataPelajarans()
    {

        $result = JadwalMataPelajaran::query()
            ->whereHas('mataPelajaran', function ($q) {
                $q->where('kelas_id', $this->kelas->id);
            })
            ->orderBy('hari_id')
            ->orderBy('jam_mulai')
            ->get()
            ->groupBy(fn($jadwal) => $jadwal->hari->name);

        return $result;
    }

    public function mount(Kelas $kelas)
    {
        $this->kelas = $kelas;
    }

    public function render()
    {
        return view('livewire.grid.admin.grid-jadwal-mata-pelajaran');
    }
}
