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

    public function hapus(JadwalMataPelajaran $jadwalMataPelajaran)
    {
        $jadwalMataPelajaran->delete();
        $this->dispatch('refresh');
    }

    #[On('refresh')]
    public function jadwalMataPelajarans()
    {

        $hari = app(OptionService::class)->getOptionsByCategoryKey('hari');

        $result = collect($hari)->mapWithKeys(function ($value, $key) {
            return [
                $value => JadwalMataPelajaran::query()
                    ->whereHas('mataPelajaran', function ($query) {
                        $query->where('kelas_id', $this->kelas->id);
                    })
                    ->where('hari_id', $key)
                    ->orderBy('jam_mulai')
                    ->get()
            ];
        });

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
