<?php

namespace App\Traits;

use App\Services\TahunAkademikService;

trait WithTahunAkademik
{
    public $currentTahunAkademik;
    public $tahunAkademikId;


    public function bootWithTahunAkademik()
    {
        $currentTahunAkademik = app(TahunAkademikService::class)->getCurrentTahunAkademik();

        $this->currentTahunAkademik = $currentTahunAkademik;
        $this->tahunAkademikId = $currentTahunAkademik->id;
    }
}
