<?php

namespace App\Traits;

use App\Services\TahunAkademikService;

trait WithCurrentTahunAkademik
{
    public $currentTahunAkdemik;

    public function bootWithCurrentTahunAkademik()
    {
        $this->currentTahunAkademik = app(TahunAkademikService::class)->getCurrentTahunAkademik();
    }
}
