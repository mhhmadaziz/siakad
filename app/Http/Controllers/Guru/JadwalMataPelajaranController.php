<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JadwalMataPelajaranController extends Controller
{

    public function index()
    {

        return view('pages.guru.jadwal-mata-pelajaran.index');
    }
}
