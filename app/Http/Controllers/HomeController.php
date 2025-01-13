<?php

namespace App\Http\Controllers;

use App\Models\Cms;
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
        return view('pages.home.video');
    }

    public function kalender()
    {
        return view('pages.home.kalender');
    }

    public function ppdb()
    {
        return view('pages.home.ppdb');
    }
}
