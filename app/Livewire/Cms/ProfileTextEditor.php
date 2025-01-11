<?php

namespace App\Livewire\Cms;

use App\Models\Cms;
use App\Service\CmsService;
use Livewire\Component;

class ProfileTextEditor extends Component
{

    public $text = '';

    public function save()
    {
        $this->validate([
            'text' => 'required',
        ]);

        app(CmsService::class)->upsertCms('profile_text', $this->text);

        session()->flash('success', 'Data Berhasil Disimpan.');
    }

    public function mount()
    {
        $profileText = Cms::where('key', 'profile_text')->first();
        if ($profileText) {
            $this->text = $profileText->value;
        }
    }



    public function render()
    {
        return view('livewire.cms.profile-text-editor');
    }
}
