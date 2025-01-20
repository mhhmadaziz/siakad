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
    public function getFormCreate(bool $isGuru = false)
    {
        $mataPelajarans = MataPelajaran::query()
            ->whereHas('kelas', function ($q) {
                $q->currentTahunAkademik();
            })
            ->when($isGuru, function ($q) {
                $q->where('guru_id', auth()->user()->guru->id);
            })
            ->get()
            ->map(function ($item) {
                return (object) [
                    'label' => $item->kelas?->fullName . ' - ' . $item->name,
                    'value' => $item->id,
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

    public function delete(ModulPembelajaran $modulPembelajaran)
    {
        return DB::transaction(function () use ($modulPembelajaran) {
            Storage::disk('public')->delete('modul-pembelajaran/' . $modulPembelajaran->file);
            $modulPembelajaran->delete();
        });
    }
}
