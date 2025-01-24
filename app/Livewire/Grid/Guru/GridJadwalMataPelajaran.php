<?php

namespace App\Livewire\Grid\Guru;

use App\Models\JadwalMataPelajaran;
use App\Models\Kelas;
use App\Services\OptionService;
use Livewire\Attributes\On;
use Livewire\Component;

class GridJadwalMataPelajaran extends Component
{
    public function jadwalMataPelajarans()
    {
        $hari = app(OptionService::class)->getOptionsByCategoryKey('hari');

        $result = collect($hari)->mapWithKeys(function ($value, $key) {
            return [
                $value => JadwalMataPelajaran::query()
                    ->whereHas('mataPelajaran', function ($query) {
                        $query->where('guru_id', auth()->user()->guru->id);;
                        $query->whereHas('kelas', function ($query) {
                            $query->currentTahunAkademik();
                        });
                    })
                    ->where('hari_id', $key)
                    ->orderBy('jam_mulai')
                    ->get()
            ];
        });

        return $result;
    }

    public function render()
    {
        return view('livewire.grid.guru.grid-jadwal-mata-pelajaran');
    }
}
