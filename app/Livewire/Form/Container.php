<?php

namespace App\Livewire\Form;

use App\Models\Pertanyaan;
use App\Models\TahunAkademik;
use App\Services\OptionService;
use App\Services\TahunAkademikService;
use Livewire\Component;

class Container extends Component
{
    public $pertanyaans = [];
    public $tahunAkademiks = [];
    public $selectedTahunAkademik = null;

    public function updatedSelectedTahunAkademik($value)
    {
        $this->pertanyaans = Pertanyaan::selectedTahunAkademik($value)->get();
    }

    public function tambahPertanyaan()
    {
        Pertanyaan::create([
            'pertanyaan' => 'Pertanyaan Baru',
            'required' => 0,
            'tipe_pertanyaan_id' => app(OptionService::class)->getOptionValueByName('Isian Singkat')->id,
            'opsi' => null,
            'tahun_akademik_id' => $this->selectedTahunAkademik,
        ]);

        $this->pertanyaans = Pertanyaan::selectedTahunAkademik($this->selectedTahunAkademik)->get();
    }

    public function hapusPertanyaan($id)
    {
        Pertanyaan::find($id)->delete();
        $this->pertanyaans = Pertanyaan::selectedTahunAkademik($this->selectedTahunAkademik)->get();;
    }

    public function mount()
    {
        $this->tahunAkademiks = TahunAkademik::pluck('name', 'id')->map(fn($value, $key) => (object) ['value' => $key, 'label' => $value]);
        $this->selectedTahunAkademik = app(TahunAkademikService::class)->getCurrentTahunAkademik()->id;
        $this->pertanyaans = Pertanyaan::currentTahunAkademik()->get();
    }

    public function render()
    {
        return view('livewire.form.container');
    }
}
