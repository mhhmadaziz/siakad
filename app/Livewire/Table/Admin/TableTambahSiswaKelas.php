<?php

namespace App\Livewire\Table\Admin;

use App\Helpers\Column;
use App\Livewire\BaseTable;
use App\Models\Kelas;
use App\Models\KelasSiswa;
use App\Models\Siswa;
use App\Services\KelasService;
use Illuminate\Database\Eloquent\Builder;

class TableTambahSiswaKelas extends BaseTable
{

    protected KelasService $kelasService;

    public Kelas $kelas;

    public $actionView = 'components.actions.admin.table-tambah-siswa-kelas-action';

    public $searchColumns = ['user.name'];

    public $numbering = false;

    public $checkbox = true;

    public $perPage = 1000;

    public $selected = [];

    public $selectedAll = false;

    public function updatedSelectedAll($value)
    {
        if ($value) {
            $this->selected = $this->data()->pluck('id')->map(fn($id) => (string) $id)->toArray();
        } else {
            $this->selected = [];
        }
    }

    public function tambahSiswaKelas()
    {
        try {
            $this->kelasService->tambahSiswaKelas($this->kelas, $this->selected);

            // redirect to kelas detail
            session()->flash('success', 'Berhasil Menambahkan Siswa ke Kelas');
            return redirect()->route('admin.kelas.show', $this->kelas->id);
        } catch (\Throwable $th) {

            // flash message
            session()->flash('error', 'Gagal menambahkan siswa ke kelas ' . $th->getMessage());
            // redirect to kelas detail
            return redirect()->route('admin.kelas.show', $this->kelas->id);
        }
    }

    public function query(): Builder
    {
        return Siswa::query()
            ->with(['user'])
            ->whereDoesntHave('kelasSiswa', function ($query) {
                $query->where('kelas_id', $this->kelas->id);
            });
    }

    public function boot(KelasService $kelasService)
    {
        $this->kelasService = $kelasService;
    }

    public function mount(Kelas $kelas)
    {
        $this->kelas = $kelas;
    }

    public function columns(): array
    {
        return [
            Column::make('user.name', 'Nama Siswa'),
            Column::make('nisn', 'NISN'),
        ];
    }
}
