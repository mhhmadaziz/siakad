<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('pages.home.welcome');
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
