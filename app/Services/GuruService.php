<?php

namespace App\Services;

use App\Enums\JenisKelaminEnum;
use App\Enums\RoleEnum;
use App\Models\Guru;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class GuruService
{
    protected OptionService $optionService;
    public function __construct()
    {
        $this->optionService = app(OptionService::class);
    }

    public function getJumlahGuru()
    {
        return Cache::remember('guru.jumlah', now()->addHours(1), function () {
            return (object) [
                'total' => Guru::count(),
                'lakiLaki' => Guru::whereHas('user.jenisKelamin', function ($q) {
                    $q->where('name', JenisKelaminEnum::LAKILAKI->value);
                })->count(),
                'perempuan' => Guru::whereHas('user.jenisKelamin', function ($q) {
                    $q->where('name', JenisKelaminEnum::PEREMPUAN->value);
                })->count(),
            ];
        });
    }

    public function getFormCreate()
    {
        $forms = [
            (object) [
                'label' => 'Nama Lengkap',
                'name' => 'name',
                'type' => 'text',
                'required' => true,
                'disabled' => false,
            ],
            (object) [
                'label' => 'NUPTK',
                'name' => 'nuptk',
                'type' => 'text',
                'required' => true,
                'disabled' => false,
            ],
            (object) [
                'label' => 'Email',
                'name' => 'email',
                'type' => 'email',
                'required' => true,
                'disabled' => false,
            ],
            (object) [
                'label' => 'Telepon',
                'name' => 'telepon',
                'type' => 'text',
                'required' => true,
                'disabled' => false,
            ],
            (object) [
                'label' => 'Jenis Kelamin',
                'name' => 'jenis_kelamin',
                'type' => 'select',
                'required' => true,
                'disabled' => false,
                'options' => $this->optionService->getSelectOptionsByCategoryKey('jenis_kelamin'),
            ],
            (object) [
                'label' => 'Password',
                'name' => 'password',
                'type' => 'password',
                'required' => true,
                'disabled' => false,
            ],
        ];

        return $forms;
    }

    public function create(array $data)
    {
        return DB::transaction(function () use ($data) {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'telepon' => $data['telepon'],
                'jenis_kelamin_id' => $data['jenis_kelamin'],
            ]);
            $guru = $user->guru()->create([
                'nuptk' => $data['nuptk'],
            ]);

            $user->assignRole(RoleEnum::GURU->value);

            Cache::forget('guru.jumlah');
            return $guru;
        });
    }

    public function getDataDiriGuru(Guru $guru)
    {
        $guru->load('user');

        $result = null;

        foreach ($guru->toArray() as $key => $value) {
            switch ($key) {
                case 'user':
                    $result['name'] = $value['name'];
                    $result['email'] = $value['email'];
                    $result['telepon'] = $value['telepon'];
                    $result['jenis_kelamin'] = $value['jenis_kelamin_id'];
                    break;
                default:
                    $result[$key] = $value;
                    break;
            }
        }

        $result['jenis_kelamin'] = $guru->user->jenisKelamin->name;

        // remove unnecessary keys
        unset(
            $result['id'],
            $result['user_id'],
            $result['created_at'],
            $result['updated_at']
        );

        // reordering keys
        $result = [
            'nama_lengkap' => $result['name'],
            'NUPTK' => $result['nuptk'],
            'email' => $result['email'],
            'nomor_telepon' => $result['telepon'],
            'jenis_kelamin' => $result['jenis_kelamin'],
        ];


        return $result;
    }

    public function getFormEdit(Guru $guru, array $disabled = [])
    {
        $forms = [
            (object) [
                'label' => 'Nama Lengkap',
                'name' => 'name',
                'type' => 'text',
                'required' => true,
                'disabled' => false,
                'value' => $guru->user->name,
            ],
            (object) [
                'label' => 'NUPTK',
                'name' => 'nuptk',
                'type' => 'text',
                'required' => true,
                'disabled' => false,
                'value' => $guru->nuptk,
            ],
            (object) [
                'label' => 'Email',
                'name' => 'email',
                'type' => 'email',
                'required' => true,
                'disabled' => false,
                'value' => $guru->user->email,
            ],
            (object) [
                'label' => 'Telepon',
                'name' => 'telepon',
                'type' => 'text',
                'required' => true,
                'disabled' => false,
                'value' => $guru->user->telepon,
            ],
            (object) [
                'label' => 'Jenis Kelamin',
                'name' => 'jenis_kelamin',
                'type' => 'select',
                'required' => true,
                'disabled' => false,
                'options' => $this->optionService->getSelectOptionsByCategoryKey('jenis_kelamin'),
                'value' => $guru->user->jenisKelamin->name,
            ],
        ];

        foreach ($forms as $key => $value) {
            if (in_array($value->name, $disabled)) {
                $forms[$key]->disabled = true;
            }
        }

        return $forms;
    }

    public function update(array $data, Guru $guru)
    {
        return DB::transaction(function () use ($data, $guru) {
            $guru->user->update([
                'name' => $data['name'],
                'email' => $data['email'] ?? $guru->user->email,
                'telepon' => $data['telepon'],
                'jenis_kelamin_id' => $data['jenis_kelamin'],
            ]);

            $guru->update([
                'nuptk' => $data['nuptk'],
            ]);

            Cache::forget('guru.jumlah');
            return $guru;
        });
    }

    public function delete(Guru $guru)
    {
        return DB::transaction(function () use ($guru) {
            $guru->user->delete();

            Cache::forget('guru.jumlah');
            return $guru;
        });
    }
}
