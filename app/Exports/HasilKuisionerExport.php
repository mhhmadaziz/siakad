<?php

namespace App\Exports;

use App\Models\JawabanSiswa;
use App\Models\TahunAkademik;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class HasilKuisionerExport implements FromQuery, WithMapping, WithHeadings, ShouldAutoSize
{
    use Exportable;

    protected $tahunAkademik;
    protected $pertanyaans;

    public function forTahunAkademik(TahunAkademik $tahunAkademik)
    {
        $this->tahunAkademik = $tahunAkademik;
        $this->pertanyaans = $tahunAkademik->pertanyaans;
        return $this;
    }

    public function map($row): array
    {
        return [
            $row->siswa->user->name,
            $row->siswa->nisn,
            $row->siswa->nipd,
            $row->siswa->kelas->map(function ($kelas) {
                return $kelas->tahun_akademik_id == $this->tahunAkademik->id ? $kelas->fullName : '';
            })->implode(', '),
            $row->createdAtFormated,
            ...$row->jawabans->map(function ($jawaban) {
                if ($jawaban->pertanyaan->tipeInput == 'checkbox') {
                    $isiJawaban = '';
                    foreach ($jawaban->decodedJawaban as $item) {
                        $isiJawaban .= $item . ', ';
                    }
                    return $isiJawaban;
                }
                return $jawaban->jawaban;
            })->toArray(),
        ];
    }

    public function headings(): array
    {

        $pertanyaans = $this->pertanyaans;

        return [
            'Nama Siswa',
            'NISN',
            'NIPD',
            'Kelas',
            'Waktu Pengisian',
            ...$pertanyaans->map(function ($pertanyaan) {
                return $pertanyaan->pertanyaan;
            })->toArray(),
        ];
    }

    public function query()
    {
        return JawabanSiswa::query()
            ->where('tahun_akademik_id', $this->tahunAkademik->id);
    }
}
