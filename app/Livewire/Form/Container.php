<?php

namespace App\Livewire\Form;

use App\Models\Pertanyaan;
use App\Services\OptionService;
use Livewire\Component;

class Container extends Component
{
    public $pertanyaans = [];

    public function tambahPertanyaan()
    {
        Pertanyaan::create([
            'pertanyaan' => 'Pertanyaan Baru',
            'required' => 0,
            'tipe_pertanyaan_id' => app(OptionService::class)->getOptionValueByName('Isian Singkat')->id,
            'opsi' => null,
        ]);

        $this->pertanyaans = Pertanyaan::all();
    }

    public function hapusPertanyaan($id)
    {
        Pertanyaan::find($id)->delete();

        $this->pertanyaans = Pertanyaan::all();
    }

    public function mount()
    {
        $this->pertanyaans = Pertanyaan::all();
    }

    public function render()
    {
        return view('livewire.form.container');
    }
}
