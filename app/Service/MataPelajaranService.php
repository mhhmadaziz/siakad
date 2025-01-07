<?php

namespace App\Service;

use App\Models\MataPelajaran;
use Illuminate\Support\Facades\DB;

class MataPelajaranService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }


    public function create(array $data)
    {
        return DB::transaction(function () use ($data) {
            $mataPelajaran = MataPelajaran::create($data);
            return $mataPelajaran;
        });
    }
}
