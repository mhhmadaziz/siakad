<?php

namespace App\Services;

use App\Enums\JenisKelaminEnum;
use App\Models\Siswa;
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

                case 'ttl':
                    $result['tempat_lahir_tanggal_lahir'] = $value;
                    break;
                default:
                    $result[$key] = $value;
                    break;
            }
        }

        $result['jenis_kelamin'] = JenisKelaminEnum::from($siswa->user->jenisKelamin->name)->label();

        $result['agama'] = $siswa->agama->name;

        $result['status_keluarga'] = $siswa->statusKeluarga->name;

        // remove unnecessary keys
        unset(
            $result['id'],
            $result['user_id'],
            $result['created_at'],
            $result['updated_at']
        );

        // reordering keys
        $result = [
            'nama_lengkap' => $result['nama_lengkap'],
            'nomor_induk_siswa_nasional' => $result['nisn'],
            'tempat_lahir_tanggal_lahir' => $result['tempat_lahir_tanggal_lahir'],
            'jenis_kelamin' => $result['jenis_kelamin'],
            'status_dalam_keluarga' => $result['status_keluarga'],
            'anak_ke' => $result['anak_ke'],
            'agama' => $result['agama'],
            'alamat' => $result['alamat'],
            'nomor_telepon' => $result['telepon'],
            'asal_sekolah' => $result['asal_sekolah'],
            'tanggal_diterima' => $result['tgl_masuk'],
            'diterima_dikelas' => $result['diterima_kelas'],
            'kelas_saat_ini' => '-',
            'status' => $result['status'],
        ];

        return $result;
    }

    public function getDataOrangTuaSiswa(Siswa $siswa)
    {
        $result = [
            'nama_ayah' => $siswa['nama_ayah'],
            'nama_ibu' => $siswa['nama_ibu'],
            'alamat_orang_tua' => $siswa['alamat_orang_tua'],
            'pekerjaan_ayah' => $siswa['pekerjaan_ayah'],
            'pekerjaan_ibu' => $siswa['pekerjaan_ibu'],
            'nomor_telepon_ayah' => $siswa['nomor_telepon_ayah'],
            'nomor_telepon_ibu' => $siswa['nomor_telepon_ibu'],
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
                case 'status_dalam_keluarga':
                    $form[count($form) - 1]->type = 'select';
                    $form[count($form) - 1]->options = (new OptionService())->getSelectOptionsByCategoryKey('status_keluarga');
                    break;
                case 'agama':
                    $form[count($form) - 1]->type = 'select';
                    $form[count($form) - 1]->options = (new OptionService())->getSelectOptionsByCategoryKey('agama');
                    break;
                case 'alamat':
                    $form[count($form) - 1]->type = 'textarea';
                    break;
                case 'nomor_telepon':
                    $form[count($form) - 1]->type = 'tel';
                    break;

                case 'tanggal_diterima':
                    $form[count($form) - 1]->type = 'date';
                    $form[count($form) - 1]->value = Carbon::parse($value)->format('Y-m-d');
                    break;
                case 'status':
                    $form[count($form) - 1]->type = 'select';
                    $form[count($form) - 1]->options = [
                        (object) ['value' => 'Aktif', 'label' => 'Aktif'],
                        (object) ['value' => 'Tidak Aktif', 'label' => 'Tidak Aktif'],
                    ];

                    break;
            }
        }

        return $form;
    }

    public function getFormEditOrangTuaSiswa(Siswa $siswa)
    {
        $data = $this->getDataOrangTuaSiswa($siswa);

        foreach ($data as $key => $value) {
            // make array of object form
            $form[] = (object) [
                'label' => ucwords(str_replace('_', ' ', $key)),
                'name' => $key,
                'value' => $value,
                'type' => 'text',
                'required' => false,
                'disabled' => false,
            ];

            switch ($key) {
                case 'alamat_orang_tua':
                    $form[count($form) - 1]->type = 'textarea';
                    break;
                case 'nomor_telepon_ayah':
                    $form[count($form) - 1]->type = 'tel';
                    break;
                case 'nomor_telepon_ibu':
                    $form[count($form) - 1]->type = 'tel';
                    break;
            }
        }

        $form = [
            (object) [
                'label' => 'DATA ORANG TUA',
                'name' => 'DATA ORANG TUA',
                'value' => 'orang_tua',
                'type' => 'header',
                'required' => false,
                'disabled' => false,
            ],

            ...$form
        ];

        return $form;
    }


    public function updateSiswa(Siswa $siswa, $data)
    {
        return DB::transaction(function () use ($siswa, $data) {
            $siswa->update([
                'nisn' => $data['nomor_induk_siswa_nasional'],
                'status_keluarga_id' => $data['status_dalam_keluarga'],
                'ttl' => $data['tempat_lahir_tanggal_lahir'],
                'anak_ke' => $data['anak_ke'],
                'agama_id' => $data['agama'],
                'alamat' => $data['alamat'],
                'asal_sekolah' => $data['asal_sekolah'],
                'tgl_masuk' => $data['tanggal_diterima'],
                'diterima_kelas' => $data['diterima_dikelas'],
                'status' => $data['status'],

                'nama_ayah' => $data['nama_ayah'],
                'nama_ibu' => $data['nama_ibu'],
                'alamat_orang_tua' => $data['alamat_orang_tua'],
                'pekerjaan_ayah' => $data['pekerjaan_ayah'],
                'pekerjaan_ibu' => $data['pekerjaan_ibu'],
                'nomor_telepon_ayah' => $data['nomor_telepon_ayah'],
                'nomor_telepon_ibu' => $data['nomor_telepon_ibu'],
            ]);

            $this->userService->updateUser($siswa->user, [
                'name' => $data['nama_lengkap'],
                'telepon' => $data['nomor_telepon'],
            ]);
            return $siswa;
        });
    }
}
