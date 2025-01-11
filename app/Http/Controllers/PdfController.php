<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PdfController extends Controller
{

    public function download($path)
    {
        if (!Storage::disk('public')->exists($path)) {
            abort(404);
        }

        try {
            // get query string for file name
            $fileName = request()->query('name');
            if ($fileName) {
                return Storage::disk('public')->download($path, $fileName);
            }

            return Storage::disk('public')->download($path);
        } catch (\Throwable $th) {

            return redirect()->back()->with('error', 'terjadi kesalahan saat mengunduh file ' . $th);
        }
    }
}
