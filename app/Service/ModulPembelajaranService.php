<?php

namespace App\Service;

use App\Models\MataPelajaran;
use App\Models\ModulPembelajaran;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ModulPembelajaranService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function getFormCreate()
    {

        $mataPelajarans = MataPelajaran::query()
            ->get()
            ->pluck('name', 'id')->map(function ($item, $key) {
                return (object) [
                    'label' => $item,
                    'value' => $key,
                ];
            });


        $forms = [
            (object) [
                'label' => 'Nama Modul',
                'name' => 'name',
                'type' => 'text',
                'required' => true,
                'disabled' => false,
            ],
            (object) [
                'label' => 'File',
                'name' => 'file',
                'type' => 'file',
                'required' => true,
                'disabled' => false,
                'accept' => '.pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.zip,.rar',
            ],
            (object) [
                'label' => 'Mata Pelajaran',
                'name' => 'mata_pelajaran_id',
                'type' => 'select',
                'required' => true,
                'disabled' => false,
                'options' => $mataPelajarans,
            ],
        ];

        return $forms;
    }

    public function create($data, $file)
    {
        return DB::transaction(function () use ($data, $file) {

            // simpan file
            $fileName = $file->hashName();
            Storage::disk('public')->putFileAs('modul-pembelajaran', $file, $fileName);

            $modulPembelajaran = ModulPembelajaran::create(
                [
                    'name' => $data['name'],
                    'file' => $fileName,
                    'mata_pelajaran_id' => $data['mata_pelajaran_id'],
                ]
            );
            return $modulPembelajaran;
        });
    }
}
