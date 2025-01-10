<?php

namespace App\Services;

use App\Models\JadwalMataPelajaran;
use App\Models\KehadiranSiswa;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\MockObject\ReturnValueNotConfiguredException;

class KehadiranSiswaService
{
    /**
     * Create a new class instance.
     */

    public function __construct()
    {
        //
    }

    public function getFormCreate($mataPelajaran)
    {
        $forms = [
            (object) [
                'type' => 'select',
                'name' => 'jadwal_mata_pelajaran_id',
                'label' => 'Jadwal Mata Pelajaran',
                'value' => '',
                'required' => true,
                'options' => $mataPelajaran->jadwalMataPelajarans()
                    ->orderBy('hari_id')
                    ->get()
                    ->map(
                        function ($item) {
                            return (object) [
                                'value' => $item->id,
                                'label' => $item->hari->name . ', ' . $item->jam,
                            ];
                        }
                    ),
            ],

            (object) [
                'type' => 'date',
                'name' => 'tanggal',
                'label' => 'Tanggal',
                'value' => '',
                'required' => true,
            ],
        ];

        return $forms;
    }

    public function create($validated)
    {
        return DB::transaction(function () use ($validated) {
            $kehadiranSiswa = KehadiranSiswa::create($validated);

            return $kehadiranSiswa;
        });
    }

    public function validateHari($validated)
    {
        $jadwalMataPelajaran = $validated['jadwal_mata_pelajaran_id'];
        $tanggal = $validated['tanggal'];

        $hari = JadwalMataPelajaran::find($jadwalMataPelajaran)->hari->name;
        $hariTanggal = Carbon::parse($tanggal)->locale('id')->isoFormat('dddd');

        if ($hari != $hariTanggal) {
            throw new \Exception('Hari pada tanggal yang di inputkan tidak sesuai dengan jadwal mata pelajaran, Silahkan pilih tangggal dengan hari yang sesuai dengan jadwal mata pelajaran');
        }
    }
}
