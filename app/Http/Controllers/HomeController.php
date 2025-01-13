<?php

namespace App\Http\Controllers;

use App\Models\Cms;
use App\Models\TahunAkademik;
use App\Service\CmsService;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function __construct(
        protected CmsService $cmsService
    ) {}

    public function index()
    {
        $profileText = $this->cmsService->getCms('profile_text');

        $carousels = json_decode($this->cmsService->getCms('carousel') ?? '[]', true);

        $gambarStrukturOrganisasi = $this->cmsService->getCms('gambar-struktur-organisasi');

        $strukturOrganisasi = $this->cmsService->getCms('struktur-organisasi') ?? '';

        return view('pages.home.welcome', compact('profileText', 'carousels', 'gambarStrukturOrganisasi', 'strukturOrganisasi'));
    }

    public function galeri()
    {

        $fotos = json_decode($this->cmsService->getCms('galeri_foto'), true) ?? [];

        return view('pages.home.galeri', compact('fotos'));
    }

    public function video()
    {
        $videos = json_decode($this->cmsService->getCms('galeri_video'), true) ?? [];
        return view('pages.home.video', compact('videos'));
    }

    public function kalender()
    {
        $kalenderText = $this->cmsService->getCms('kalender_text') ?? '';
        $kalender = $this->cmsService->getCms('gambar-kalender') ?? '';

        return view('pages.home.kalender', compact('kalenderText', 'kalender'));
    }

    public function ppdb()
    {

        $tahunAkademiks = TahunAkademik::query()
            ->orderBy('mulai', 'desc')
            ->get()
            ->pluck('name', 'id');

        return view('pages.home.ppdb', compact('tahunAkademiks'));
    }
}
