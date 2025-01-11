<?php

namespace App\Livewire;

use Livewire\Component;

class PdfViewer extends Component
{

    public $src;

    public function mount($src)
    {
        $this->src = $src;
    }

    public function render()
    {
        return view('livewire.pdf-viewer');
    }
}
