<?php

namespace App\Livewire\Cms;

use App\Service\CmsService;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class StrukturOrganisasi extends Component
{

    use WithFileUploads;

    #[Validate('required|image|mimes:jpeg,png,jpg|max:2048')]
    public $uploadedStrukturOrganisasi;

    public $gambarStrukturOrganisasi;

    public $strukturOrganisasi;

    public function updatedUploadedStrukturOrganisasi()
    {
        try {
            $fileName = $this->uploadedStrukturOrganisasi->hashName();

            app(CmsService::class)->upsertCms('gambar-struktur-organisasi', $fileName);

            Storage::disk('public')->putFileAs('struktur-organisasi', $this->uploadedStrukturOrganisasi, $fileName);

            $this->uploadedStrukturOrganisasi = null;

            $this->gambarStrukturOrganisasi = $fileName;
            session()->flash('success', 'Gambar berhasil diunggah');
        } catch (\Throwable $th) {
            session()->flash('error', 'Terjadi kesalahan saat mengunggah gambar ' . $th->getMessage());
        }
    }

    public function deleteImageStrukturOrganisasi()
    {
        try {
            $fileName = $this->gambarStrukturOrganisasi;

            app(CmsService::class)->upsertCms('gambar-struktur-organisasi', null);

            Storage::disk('public')->delete('struktur-organisasi/' . $fileName);

            $this->gambarStrukturOrganisasi = null;
            session()->flash('success', 'Gambar berhasil dihapus');
        } catch (\Throwable $th) {
            session()->flash('error', 'Terjadi kesalahan saat menghapus gambar ' . $th->getMessage());
        }
    }

    public function saveStrukturOrganisasi()
    {
        app(CmsService::class)->upsertCms('struktur-organisasi', $this->strukturOrganisasi);
        session()->flash('success', 'Struktur Organisasi berhasil disimpan');
    }


    public function mount()
    {
        $this->gambarStrukturOrganisasi = app(CmsService::class)->getCms('gambar-struktur-organisasi');
        $this->strukturOrganisasi = app(CmsService::class)->getCms('struktur-organisasi') ?? '';
    }


    public function render()
    {
        return view('livewire.cms.struktur-organisasi');
    }
}
