<?php

namespace App\Services;

use App\Enums\JenisKelaminEnum;
use App\Enums\RoleEnum;
use App\Models\Siswa;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class SiswaService
{
    public function __construct(protected UserService $userService)
    {
        //
    }

    public function getJumlahSiswa()
    {
        return Cache::remember('siswa.jumlah', now()->addHours(1), function () {
            return (object) [
                'total' => Siswa::count(),
                'lakiLaki' => Siswa::whereHas('user.jenisKelamin', function ($q) {
                    $q->where('name', JenisKelaminEnum::LAKILAKI->value);
                })->count(),
                'perempuan' => Siswa::whereHas('user.jenisKelamin', function ($q) {
                    $q->where('name', JenisKelaminEnum::PEREMPUAN->value);
                })->count(),
            ];
        });
    }

    public function getDataDiriSiswa(Siswa $siswa)
    {
        $siswa->load('user');

        $result = null;

        foreach ($siswa->toArray() as $key => $value) {
            switch ($key) {
                case 'user':
                    $result['nama_lengkap'] = $value['name'];
                    $result['telepon'] = $value['telepon'];
                    break;
                default:
                    $result[$key] = $value;
                    break;
            }
        }

        $result['jenis_kelamin'] = JenisKelaminEnum::from($siswa->user->jenisKelamin->name)->label();

        $result['agama'] = $siswa->agama->name;


        // remove unnecessary keys
        unset(
            $result['id'],
            $result['user_id'],
            $result['created_at'],
            $result['updated_at']
        );

        // reordering keys
        $result = [
            'nama_lengkap' => $result['nama_lengkap'] ?? '-',
            'NISN' => $result['nisn'] ?? '-',
            'NIPD' => $result['nipd'] ?? '-',
            'jenis_kelamin' => $result['jenis_kelamin'] ?? '-',
            'tempat_lahir' => $result['tempat_lahir'] ?? '-',
            'tanggal_lahir' => $result['tanggal_lahir'] ?? '-',
            'agama' => $result['agama'] ?? '-',
            'alamat' => $result['alamat'] ?? '-',
            'RT' => $result['rt'] ?? '-',
            'RW' => $result['rw'] ?? '-',
            'dusun' => $result['dusun'],
            'kelurahan' => $result['kelurahan'] ?? '-',
            'kecamatan' => $result['kecamatan'] ?? '-',
            'telepon' => $result['telepon'] ?? '-',
            'nama_ayah' => $result['nama_ayah'] ?? '-',
            'nama_ibu' => $result['nama_ibu'] ?? '-',
        ];

        return $result;
    }

    public function getFormEditDataDiriSiswa(Siswa $siswa)
    {

        $data = $this->getDataDiriSiswa($siswa);

        foreach ($data as $key => $value) {
            // make array of object form
            $form[] = (object) [
                'label' => ucwords(str_replace('_', ' ', $key)),
                'name' => $key,
                'value' => $value,
                'type' => 'text',
                'required' => true,
                'disabled' => false,
            ];

            switch ($key) {
                case 'jenis_kelamin':
                    $form[count($form) - 1]->type = 'select';
                    $form[count($form) - 1]->options = (new OptionService())->getSelectOptionsByCategoryKey('jenis_kelamin');
                    break;

                case 'agama':
                    $form[count($form) - 1]->type = 'select';
                    $form[count($form) - 1]->options = (new OptionService())->getSelectOptionsByCategoryKey('agama');
                    break;

                case 'alamat':
                    $form[count($form) - 1]->type = 'textarea';
                    break;
            }
        }

        return $form;
    }

    public function updateSiswa(Siswa $siswa, $data)
    {
        return DB::transaction(function () use ($siswa, $data) {
            $siswa->update([
                'nisn' => $data['NISN'],
                'nipd' => $data['NIPD'],
                'jenis_kelamin_id' => $data['jenis_kelamin'],
                'tempat_lahir' => $data['tempat_lahir'],
                'tanggal_lahir' => Carbon::parse($data['tanggal_lahir']),
                'agama_id' => $data['agama'],
                'alamat' => $data['alamat'],
                'rt' => $data['RT'],
                'rw' => $data['RW'],
                'dusun' => $data['dusun'],
                'kelurahan' => $data['kelurahan'],
                'kecamatan' => $data['kecamatan'],
                'nama_ayah' => $data['nama_ayah'],
                'nama_ibu' => $data['nama_ibu'],
            ]);

            $this->userService->updateUser($siswa->user, [
                'name' => $data['nama_lengkap'],
                'telepon' => $data['telepon'],
            ]);
            return $siswa;
        });
    }

    public function inputkeys()
    {
        $keys = (new User())->getFillable();
        $keys = [
            ...$keys,
            ...(new Siswa())->getFillable()
        ];


        unset(
            $keys[array_search('user_id', $keys)],
            $keys[array_search('photo', $keys)],
        );

        return $keys;
    }

    public function getFormCreate()
    {

        $keys = $this->inputkeys();

        $form = [];

        foreach ($keys as $key) {
            // make array of object form
            $form[] = (object) [
                'label' => ucwords(str_replace('_', ' ', $key)),
                'name' => $key,
                'type' => 'text',
                'required' => true,
                'disabled' => false,
            ];

            switch ($key) {

                case 'name':
                    $form[count($form) - 1]->label = 'Nama';
                    break;
                case 'jenis_kelamin_id':
                    $form[count($form) - 1]->label = 'Jenis Kelamin';
                    $form[count($form) - 1]->type = 'select';
                    $form[count($form) - 1]->options = (new OptionService())->getSelectOptionsByCategoryKey('jenis_kelamin');
                    break;
                case 'agama_id':
                    $form[count($form) - 1]->label = 'Agama';
                    $form[count($form) - 1]->type = 'select';
                    $form[count($form) - 1]->options = (new OptionService())->getSelectOptionsByCategoryKey('agama');
                    break;
                case 'password':
                    $form[count($form) - 1]->type = 'password';
                    break;
                case 'alamat':
                    $form[count($form) - 1]->type = 'textarea';
                    break;
                case 'tanggal_lahir':
                    $form[count($form) - 1]->type = 'date';
                    break;
                case 'telepon':
                    $form[count($form) - 1]->type = 'number';
                    break;
            }
        }
        return $form;
    }

    public function create(array $data)
    {
        return DB::transaction(function () use ($data) {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'telepon' => $data['telepon'],
                'password' => bcrypt($data['password']),
                'jenis_kelamin_id' => $data['jenis_kelamin_id'],
            ]);

            $user->siswa()->create([
                'nisn' => $data['nisn'],
                'nipd' => $data['nipd'],
                'tempat_lahir' => $data['tempat_lahir'],
                'tanggal_lahir' => Carbon::parse($data['tanggal_lahir']),
                'agama_id' => $data['agama_id'],
                'alamat' => $data['alamat'],
                'rt' => $data['rt'],
                'rw' => $data['rw'],
                'dusun' => $data['dusun'],
                'kelurahan' => $data['kelurahan'],
                'kecamatan' => $data['kecamatan'],
                'nama_ayah' => $data['nama_ayah'],
                'nama_ibu' => $data['nama_ibu'],
            ]);

            $user->assignRole(RoleEnum::SISWA->value);

            return $user;
        });
    }
}
