<?php

namespace App\Livewire\Modal;

use App\Models\JadwalMataPelajaran;
use LivewireUI\Modal\ModalComponent;

class EditJadwalMataPelajaran extends ModalComponent
{
    public JadwalMataPelajaran $jadwalMataPelajaran;

    public $jamMulai;
    public $jamSelesai;

    public function submit()
    {
        $this->validate([
            'jamMulai' => 'required',
            'jamSelesai' => 'required',
        ]);

        $this->jadwalMataPelajaran->update([
            'jam_mulai' => $this->jamMulai,
            'jam_selesai' => $this->jamSelesai,
        ]);


        $this->closeModal();


        $this->reset();
        $this->dispatch('refresh');
    }

    public function mount($id)
    {
        $this->jadwalMataPelajaran = JadwalMataPelajaran::find($id);
        $this->jamMulai = $this->jadwalMataPelajaran->jam_mulai;
        $this->jamSelesai = $this->jadwalMataPelajaran->jam_selesai;
    }

    public function render()
    {
        return view('livewire.modal.edit-jadwal-mata-pelajaran');
    }
}
