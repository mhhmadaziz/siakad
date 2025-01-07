<?php

namespace App\Livewire\Modal;

use App\Models\JadwalMataPelajaran;
use App\Models\Kelas;
use App\Models\Option;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class TambahJadwalMataPelajaran extends ModalComponent
{

    public Kelas $kelas;
    public $hari;

    // forms
    public $mataPelajaranId;
    public $jamMulai;
    public $jamSelesai;

    public function submit()
    {
        $this->validate([
            'mataPelajaranId' => 'required',
            'jamMulai' => 'required',
            'jamSelesai' => 'required',
        ]);

        $hariId = Option::where('name', $this->hari)->first()->id;

        JadwalMataPelajaran::create([
            'mata_pelajaran_id' => $this->mataPelajaranId,
            'jam_mulai' => $this->jamMulai,
            'jam_selesai' => $this->jamSelesai,
            'hari_id' => $hariId,
        ]);

        $this->closeModal();

        $this->dispatch('refresh');
    }

    public function mataPelajarans()
    {
        return $this->kelas->mataPelajarans->pluck('name', 'id')->map(
            function ($item, $key) {
                return (object) [
                    'value' => $key,
                    'label' => $item,
                ];
            }
        );
    }

    public function mount(Kelas $kelas, $hari)
    {
        $this->kelas = $kelas;
        $this->hari = $hari;
        $this->mataPelajaranId = $this->kelas->mataPelajarans->first()?->id;
    }


    public function render()
    {
        return view('livewire.modal.tambah-jadwal-mata-pelajaran');
    }
}
