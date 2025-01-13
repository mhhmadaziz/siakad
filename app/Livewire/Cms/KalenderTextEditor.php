<?php

namespace App\Livewire\Cms;

use App\Service\CmsService;
use Livewire\Component;

class KalenderTextEditor extends Component
{

    public $text = '';


    public function save()
    {
        $this->validate([
            'text' => 'required',
        ]);

        app(CmsService::class)->upsertCms('kalender_text', $this->text);

        session()->flash('success', 'Data Berhasil Disimpan.');
    }

    public function mount()
    {
        $this->text = app(CmsService::class)->getCms('kalender_text') ?? '';
    }



    public function render()
    {
        return view('livewire.cms.kalender-text-editor');
    }
}
