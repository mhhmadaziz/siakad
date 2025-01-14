<?php

namespace App\Http\Controllers\Admin;

use App\Enums\RoleEnum;
use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\TahunAkademik;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index()
    {
        $countCard = [];

        $countCard['Siswa'] = (object) [
            'count' => Siswa::count(),
            'icon' => 'fas fa-user-graduate',
        ];
        $countCard['Guru'] = (object) [
            'count' => Guru::count(),
            'icon' => 'fas fa-chalkboard-teacher',
        ];
        $countCard['Kelas'] = (object) [
            'count' => Kelas::query()
                ->currentTahunAkademik()
                ->count(),
            'icon' => 'fas fa-school',
        ];

        $statistikSiswa = $this->getStatistik(new Siswa, RoleEnum::SISWA->value);
        $statistikGuru = $this->getStatistik(new Guru, RoleEnum::GURU->value);

        $statistikTahunAkademik = TahunAkademik::pluck('name', 'id');


        return view('pages.admin.dashboard.index', compact('countCard', 'statistikSiswa', 'statistikGuru', 'statistikTahunAkademik'));
    }

    protected function getStatistik(Model $model, $role)
    {
        return $model::query()
            ->with('user.jenisKelamin')
            ->whereHas('user', function ($query) use ($role) {
                $query->role($role);
            })
            ->get()
            ->groupBy('user.jenis_kelamin_id')
            ->map(function ($item, $key) use ($model) {
                return [
                    'name' => $item->first()->user->jenisKelamin->name,
                    'label' => match ($item->first()->user->jenisKelamin->name) {
                        'L' => 'Laki-laki',
                        'P' => 'Perempuan',
                    },
                    'count' => $item->count(),
                    'percentage' => $item->count() / $model::count() * 100,
                ];
            });
    }
}
