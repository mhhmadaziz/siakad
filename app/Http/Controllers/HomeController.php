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

        return view('pages.home.welcome', compact('profileText'));
    }

    public function galeri()
    {
        return view('pages.home.galeri');
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
