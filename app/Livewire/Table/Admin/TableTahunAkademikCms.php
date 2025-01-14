<?php

namespace App\Livewire\Table\Admin;

use App\Helpers\Column;
use App\Livewire\BaseTable;
use App\Models\Kelas;
use App\Models\KelasSiswa;
use App\Models\Siswa;
use App\Models\TahunAkademik;
use App\Services\TahunAkademikService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class TableTahunAkademikCms extends BaseTable
{
    use WithFileUploads;

    public $filePpdb = [];

    public function updatedFilePpdb($value, $key)
    {
        $this->validate([
            'filePpdb.*' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        $tahunAkademik = TahunAkademik::find($key);

        if (!$tahunAkademik) {
            return;
        }

        app(TahunAkademikService::class)->uploadPpdb($tahunAkademik, $this->filePpdb[$key]);

        session()->flash('success', 'File PPDB berhasil diupload');
    }

    public function deleteFilePpdb($key)
    {
        $tahunAkademik = TahunAkademik::find($key);

        if (!$tahunAkademik) {
            return;
        }

        app(TahunAkademikService::class)->deletePpdb($tahunAkademik);

        session()->flash('success', 'File PPDB berhasil dihapus');
    }

    public function query(): Builder
    {
        return TahunAkademik::query()
            ->orderBy('mulai', 'desc');
    }

    public function columns(): array
    {
        return [
            Column::make('name', 'Tahun Ajaran'),
            Column::make('mulai', 'Tanggal Mulai'),
            Column::make('selesai', 'Tanggal Selesai'),
            Column::make('file_ppdb', 'PPDB'),
            Column::make('', '')->component('columns.actions.admin.aksi-table-tahun-akademik-cms'),
        ];
    }
}
