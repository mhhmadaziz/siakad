<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TahunAkademik;
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
        $videos = json_decode($this->cmsService->getCms('galeri_video'), true) ?? [];

        return view('pages.admin.cms.galeri.index', compact('fotos', 'videos'));
    }

    public function kalender()
    {
        return view('pages.admin.cms.kalender.index');
    }

    public function ppdb()
    {
        return view('pages.admin.cms.ppdb.index');
    }

    public function ppdbShow(TahunAkademik $tahunAkademik)
    {
        return view('pages.admin.cms.ppdb.show', compact('tahunAkademik'));
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
            'foto' => 'required|image|mimes:jpeg,png,jpg',
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

    public function galeriVideoStore(Request $request)
    {
        $validated = $request->validate([
            'video' => 'required|file|mimes:mp4,mov,avi,3gp,wmv,flv',
        ]);

        try {
            $this->cmsService->storeVideo($validated);

            return redirect()->route('admin.cms.galeri.index')->with('success', 'Video berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    public function galeriVideoDelete($name)
    {
        try {
            $this->cmsService->deleteVideo($name);
            return redirect()->route('admin.cms.galeri.index')->with('success', 'Video berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
