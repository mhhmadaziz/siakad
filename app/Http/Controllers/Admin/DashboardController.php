<?php

namespace App\Http\Controllers\Admin;

use App\Enums\RoleEnum;
use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\KelasSiswa;
use App\Models\Siswa;
use App\Models\TahunAkademik;
use App\Services\OptionService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function __construct(
        protected OptionService $optionService
    ) {}



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

        // amnil jumlah siswa kelas 10 di setiap tahun akademik jika kosong maka isi dengan 0
        $siswaKelas10 = KelasSiswa::query()
            ->whereHas('kelas', function ($query) {
                $query->where('tingkat_kelas_id', $this->optionService->getOptionValueByName('X')->id);
            })
            ->get()
            ->groupBy('kelas.tahun_akademik_id')
            ->map(function ($item, $key) {
                return [
                    'label' => $item?->first()?->kelas?->tahunAkademik->name,
                    'count' => $item->count(),
                ];
            });

        $siswaKelas10 = $statistikTahunAkademik->map(function ($item, $key) use ($siswaKelas10) {
            return [
                'label' => $item,
                'count' => $siswaKelas10->get($key, ['count' => 0])['count'],
            ];
        });

        return view('pages.admin.dashboard.index', compact('countCard', 'statistikSiswa', 'statistikGuru', 'statistikTahunAkademik', 'siswaKelas10'));
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
                    'percentage' => round($item->count() / $model::count() * 100, 2),
                ];
            });
    }
}
