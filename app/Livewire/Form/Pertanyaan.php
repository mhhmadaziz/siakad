<?php

namespace App\Livewire\Form;

use App\Models\Pertanyaan as ModelsPertanyaan;
use App\Services\OptionService;
use Illuminate\Support\Str;
use Livewire\Component;

class Pertanyaan extends Component
{
    public $tipePertanyaan = [];

    public ModelsPertanyaan $pertanyaan;

    public $editor = [];
    public $editorOpsi = [];

    public $pilihanGanda;
    public $pilihanGandaCheckbox;

    public function updatedEditor($value, $key)
    {
        $this->pertanyaan->update([
            $key => $value
        ]);
    }

    public function updatedEditorOpsi($value, $key)
    {

        $opsi = collect($this->pertanyaan->decodedOpsi)->map(function ($opsi) use ($value, $key) {
            if ($opsi['value'] == $key) {
                return [
                    'label' => $value,
                    'value' => $key
                ];
            }

            return $opsi;
        });

        $this->pertanyaan->update([
            'opsi' => json_encode($opsi)
        ]);
    }

    public function deleteOpsi($key)
    {
        $opsi = collect($this->pertanyaan->decodedOpsi)->filter(function ($opsi) use ($key) {
            return $opsi['value'] != $key;
        });

        $this->pertanyaan->update([
            'opsi' => json_encode($opsi)
        ]);


        $this->editorOpsi = $opsi->mapWithKeys(fn($opsi) => [$opsi['value'] => $opsi['label']]);
    }

    public function incrementOpsi()
    {
        $opsi = $this->pertanyaan->decodedOpsi;
        $opsi[] = [
            'label' => 'Opsi Baru',
            'value' => Str::uuid()
        ];

        $this->pertanyaan->update([
            'opsi' => json_encode($opsi)
        ]);

        $this->editorOpsi = $this->pertanyaan->keyValueOpsi;
    }


    public function mount(ModelsPertanyaan $pertanyaan)
    {
        $this->pertanyaan = $pertanyaan;
        // map fillable pertanyaan dan isi dengan data dari database
        $this->editor = $this->pertanyaan->getAttributes();
        // map editor opsi menjadi array dengan key value
        $this->editorOpsi = $this->pertanyaan->keyValueOpsi;

        $this->tipePertanyaan = app(OptionService::class)->getSelectOptionsByCategoryKey('tipe_pertanyaan');
        $this->pilihanGanda = app(OptionService::class)->getOptionValueByName('Pilihan Ganda')->id;
        $this->pilihanGandaCheckbox = app(OptionService::class)->getOptionValueByName('Pilihan Ganda (checkbox)')->id;
    }

    public function render()
    {
        return view('livewire.form.pertanyaan');
    }
}
