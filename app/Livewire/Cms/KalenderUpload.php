<?php

namespace App\Livewire\Cms;

use App\Service\CmsService;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class KalenderUpload extends Component
{

    use WithFileUploads;

    public $kalender;

    #[Validate('required|image|mimes:jpeg,png,jpg|max:2048')]
    public $newImage;

    public function updatedNewImage()
    {
        try {
            $fileName = $this->newImage->hashName();
            $this->kalender = $fileName;

            app(CmsService::class)->upsertCms('gambar-kalender', $fileName);

            Storage::disk('public')->putFileAs('kalender', $this->newImage, $fileName);

            $this->newImage = null;
            session()->flash('success', 'Gambar berhasil diunggah');
        } catch (\Throwable $th) {

            session()->flash('error', 'Terjadi kesalahan saat mengunggah gambar ' . $th->getMessage());
        }
    }

    public function deleteImage()
    {
        try {

            app(CmsService::class)->upsertCms(
                'gambar-kalender',
                ''
            );

            Storage::disk('public')->delete('kalender/' . $this->kalender);

            $this->kalender = '';

            session()->flash('success', 'Gambar berhasil dihapus');
        } catch (\Throwable $th) {
            session()->flash('error', 'Terjadi kesalahan saat menghapus gambar ' . $th->getMessage());
        }
    }



    public function mount()
    {
        $this->kalender = app(CmsService::class)->getCms('gambar-kalender') ?? '';
    }



    public function render()
    {
        return view('livewire.cms.kalender-upload');
    }
}
