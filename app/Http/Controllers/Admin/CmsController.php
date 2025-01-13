<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Service\CmsService;
use Illuminate\Http\Request;

class CmsController extends Controller
{
    public function __construct(
        protected CmsService $cmsService
    ) {}

    public function index()
    {
        return view('pages.admin.cms.index');
    }

    public function home()
    {
        return view('pages.admin.cms.home.index');
    }

    public function galeri()
    {

        $fotos = json_decode($this->cmsService->getCms('galeri_foto'), true) ?? [];

        return view('pages.admin.cms.galeri.index', compact('fotos'));
    }

    public function galeriFotoCreate()
    {
        return view('pages.admin.cms.galeri.create-foto');
    }

    public function galeriVideoCreate()
    {
        return view('pages.admin.cms.galeri.create-video');
    }

    public function galeriFotoStore(Request $request)
    {
        $validated = $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'judul' => 'required|string',
            'tanggal' => 'required|date',
        ]);

        try {
            $this->cmsService->storeFoto($validated);

            return redirect()->route('admin.cms.galeri.index')->with('success', 'Foto berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    public function galeriFotoDelete($name)
    {
        try {
            $this->cmsService->deleteFoto($name);
            return redirect()->route('admin.cms.galeri.index')->with('success', 'Foto berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
