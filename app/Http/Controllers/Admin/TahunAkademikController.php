<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TahunAkademik;
use App\Services\TahunAkademikService;
use Illuminate\Http\Request;

class TahunAkademikController extends Controller
{

    public function __construct(protected TahunAkademikService $tahunAkademikService) {}


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tahunAkademik = $this->tahunAkademikService->getAllTahunAkademik();

        return view('pages.admin.tahun-akademik.index', compact('tahunAkademik'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('pages.admin.tahun-akademik.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(TahunAkademik $tahunAkademik)
    {
        return view('pages.admin.tahun-akademik.show', compact('tahunAkademik'));
    }

    public function kelas(TahunAkademik $tahunAkademik)
    {
        return view('pages.admin.tahun-akademik.kelas.index', compact('tahunAkademik'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
