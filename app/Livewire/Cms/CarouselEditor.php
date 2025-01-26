<?php

namespace App\Livewire\Cms;

use App\Service\CmsService;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class CarouselEditor extends Component
{

    use WithFileUploads;

    public $carousels;

    #[Validate('required|image|mimes:jpeg,png,jpg')]
    public $newImage;

    public function updatedNewImage()
    {
        try {
            $fileName = $this->newImage->hashName();
            $this->carousels[] = $fileName;

            app(CmsService::class)->upsertCms('carousel', json_encode(
                array_values($this->carousels)
            ));

            Storage::disk('public')->putFileAs('carousel', $this->newImage, $fileName);

            $this->newImage = null;
            session()->flash('success', 'Gambar berhasil diunggah');
        } catch (\Throwable $th) {
            dump($th->getMessage());
            session()->flash('error', 'Terjadi kesalahan saat mengunggah gambar ' . $th->getMessage());
        }
    }

    public function deleteImage($name)
    {
        try {
            $fileName = $name;

            $newArrayCarousel = array_filter($this->carousels, function ($item) use ($fileName) {
                return $item != $fileName;
            });

            app(CmsService::class)->upsertCms(
                'carousel',
                json_encode(array_values($newArrayCarousel))
            );

            $this->carousels = $newArrayCarousel;

            Storage::disk('public')->delete('carousel/' . $fileName);
            session()->flash('success', 'Gambar berhasil dihapus');
        } catch (\Throwable $th) {
            session()->flash('error', 'Terjadi kesalahan saat menghapus gambar ' . $th->getMessage());
        }
    }

    public function mount()
    {
        $this->carousels = json_decode(app(CmsService::class)->getCms('carousel')) ?? [];
    }

    public function render()
    {
        return view('livewire.cms.carousel-editor');
    }
}
