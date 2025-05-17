<?php

namespace App\Imports;

use App\Models\KelasSiswa;
use App\Models\TahunAkademik;
use App\Models\User;
use App\Services\OptionService;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SiswaImport implements ToModel, WithHeadingRow
{
    use Importable;

    public function __construct(
        protected TahunAkademik $tahunAkademik
    ) {}

    public function model(array $row)
    {

        try {
            $kelasFullName = $row['rombel_saat_ini'];
            // ambil kata pertama sebelum - dan biarkan kata apapun setelah - yang pertama kali muncul
            $tingkatKelasName = explode('-', $kelasFullName)[0];
            // hapus kata yang mengandung tingkatKelasName dari kelasFullName
            $kelasName = str_replace($tingkatKelasName, '', $kelasFullName);
            // hapus karakter pertama dari kelasName
            $kelasName = substr($kelasName, 1);

            if (!$kelasName) {
                return null;
            }

            $tingkatKelasId = app(OptionService::class)->getOptionValueByName($tingkatKelasName)?->id;

            if (!$tingkatKelasId) {
                return null;
            }

            $kelas = $this->tahunAkademik->kelas()->firstOrCreate([
                'name' => $kelasName,
                'tingkat_kelas_id' => $tingkatKelasId,
            ]);

            $user = User::firstOrCreate([
                'name' => $row['nama'],
                'jenis_kelamin_id' => app(OptionService::class)->getOptionValueByName($row['jk'])->id,
                'telepon' => $row['hp'] ?? '',
            ]);

            $user->siswa()->firstOrCreate([
                'nisn' => $row['nisn'],
                'nipd' => $row['nipd'],
                'tempat_lahir' => $row['tempat_lahir'],
                'tanggal_lahir' => $row['tanggal_lahir'],
                'agama_id' => app(OptionService::class)->getOptionValueByName($row['agama'])->id ?? app(OptionService::class)->getOptionValueByName('Islam')->id,
                'alamat' => $row['alamat'],
                'rt' => $row['rt'],
                'rw' => $row['rw'],
                'dusun' => $row['dusun'],
                'kelurahan' => $row['kelurahan'],
                'kecamatan' => $row['kecamatan'],
                'nama_ayah' => $row['nama_ayah'],
                'nama_ibu' => $row['nama_ibu'],
            ]);

            $user->assignRole('siswa');

            KelasSiswa::firstOrCreate([
                'kelas_id' => $kelas->id,
                'siswa_id' => $user->siswa->id,
            ]);

            return $user;
        } catch (\Throwable $th) {

            return null;
        }
    }
}
