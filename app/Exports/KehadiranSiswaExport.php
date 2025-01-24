<?php

namespace App\Exports;

use App\Enums\StatusKehadiranEnum;
use App\Models\JadwalMataPelajaran;
use App\Models\KehadiranSiswa;
use App\Models\KehadiranSiswaChild;
use App\Models\Kelas;
use App\Models\KelasSiswa;
use App\Services\OptionService;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class KehadiranSiswaExport implements FromQuery, WithHeadings, ShouldAutoSize, WithMapping, WithCustomStartCell, WithEvents, WithDrawings
{
    use Exportable;

    protected $kelas;
    protected $tanggal;
    protected $jadwalMataPelajarans;
    protected $jadwalMataPelajaranCount;
    protected $siswaLCount;
    protected $siswaPCount;
    protected $siswaCount;

    protected $copHeading = [
        'PEMERINTAH PROVINSI LAMPUNG',
        'DINAS PENDIDIKAN DAN KEBUDAYAAN',
        'SMA NEGERI 1 JATI AGUNG LAMPUNG SELATAN',
        'Alamat : Jl. Raya Margomulyo Gg. SMAN Kec. Jatiagung Lampung Selatan 35365, NPSN: 10814901, NSS: 301120108149, email: sman_jatiagung@yahoo.co.id'
    ];

    public function startCell(): string
    {
        return 'A9';
    }

    public function drawings()
    {

        $logoLamsel = new Drawing();
        $logoLamsel->setName('Logo Lamsel');
        $logoLamsel->setDescription('Logo Lamsel');
        $logoLamsel->setPath(public_path('image/logo_lamsel.png'));
        $logoLamsel->setCoordinates('B1');

        $logoSekolah = new Drawing();
        $logoSekolah->setName('Logo Sekolah');
        $logoSekolah->setDescription('Logo Sekolah');
        $logoSekolah->setPath(public_path('image/logo_sekolah.png'));
        $logoSekolah->setCoordinates($this->getColumnName($this->jadwalMataPelajaranCount + 3) . '1');

        return [$logoLamsel, $logoSekolah];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->mergeCells('A8:A9');
                $event->sheet->setCellValue('A8', 'No');
                $event->sheet->mergeCells('B8:B9');
                $event->sheet->setCellValue('B8', 'NISN');
                $event->sheet->mergeCells('C8:C9');
                $event->sheet->setCellValue('C8', 'NAMA');
                $event->sheet->mergeCells('D8:D9');
                $event->sheet->setCellValue('D8', 'L/P');
                $event->sheet->mergeCells('E8:' . $this->getColumnName($this->jadwalMataPelajaranCount + 4) . '8');

                $event->sheet->getStyle('A8:' . $this->getColumnName($this->jadwalMataPelajaranCount + 4) . '9')->applyFromArray([
                    'font' => [
                        'bold' => true,
                    ],
                    'alignment' => [
                        'horizontal' => 'center',
                        'vertical' => 'center',
                    ],
                ]);

                $event->sheet->setCellValue('E8', 'Jam Ke');

                // set border for all active cells
                $event->sheet->getStyle('A8:' . $this->getColumnName($this->jadwalMataPelajaranCount + 4) . $this->siswaCount + 9)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                    ],

                ]);


                // kelas
                $event->sheet->mergeCells('A7:B7');
                $event->sheet->setCellValue('A7', 'Kelas : ' . $this->kelas->fullName);

                // hari
                $event->sheet->mergeCells('D7:' . $this->getColumnName($this->jadwalMataPelajaranCount + 4) . '7');
                $event->sheet->setCellValue('D7', 'Hari/Tanggal : ' . Carbon::parse($this->tanggal)->locale('id')->isoFormat('dddd, D MMMM Y'));


                // start cop surat
                foreach ($this->copHeading as $key => $copHeading) {
                    $index = $key + 1;
                    $event->sheet->mergeCells('A' . $index . ':' . $this->getColumnName($this->jadwalMataPelajaranCount + 4) . $index);
                    $event->sheet->setCellValue('A' . $index, $copHeading);
                }

                $event->sheet->getStyle('A1:' . $this->getColumnName($this->jadwalMataPelajaranCount + 4) . '4')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 16,],
                    'alignment' => ['horizontal' => 'center',],
                ]);

                $event->sheet->getStyle('A1')->applyFromArray(['font' => ['size' => 18],]);

                $event->sheet->getStyle('A2')->applyFromArray(['font' => ['size' => 14],]);

                $event->sheet->getStyle('A4:' . $this->getColumnName($this->jadwalMataPelajaranCount + 4) . '4')->applyFromArray([
                    'font' => ['size' => 8, 'bold' => false],
                    'borders' => [
                        'bottom' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
                        ],
                    ],
                ]);
                // end cop surat


                // start JURNAL KELAS
                $event->sheet->mergeCells('A' . ($this->siswaCount + 12) . ':' . $this->getColumnName($this->jadwalMataPelajaranCount + 4) . ($this->siswaCount + 12));
                $event->sheet->setCellValue('A' . ($this->siswaCount + 12), 'Keterangan : ');

                $event->sheet->mergeCells('A' . ($this->siswaCount + 14) . ':C' . ($this->siswaCount + 14));
                $event->sheet->setCellValue('A' . ($this->siswaCount + 14), 'Laki - laki');
                $event->sheet->setCellValue('E' . ($this->siswaCount + 14), $this->siswaLCount);

                $event->sheet->mergeCells('A' . ($this->siswaCount + 15) . ':C' . ($this->siswaCount + 15));
                $event->sheet->setCellValue('A' . ($this->siswaCount + 15), 'Perempuan');
                $event->sheet->setCellValue('E' . ($this->siswaCount + 15), $this->siswaPCount);

                $event->sheet->mergeCells('A' . ($this->siswaCount + 16) . ':C' . ($this->siswaCount + 16));
                $event->sheet->setCellValue('A' . ($this->siswaCount + 16), 'Jumlah');
                $event->sheet->setCellValue('E' . ($this->siswaCount + 16), $this->siswaCount);

                for ($i = 0; $i  < 3; $i++) {
                    $event->sheet->setCellValue('D' . ($this->siswaCount + 14 + $i), ':');
                    // merge f and g
                    $event->sheet->mergeCells('F' . ($this->siswaCount + 14 + $i) . ':G' . ($this->siswaCount + 14 + $i));
                    $event->sheet->setCellValue('F' . ($this->siswaCount + 14 + $i), 'Siswa');
                    if ($i == 1) {
                        $event->sheet->getStyle('D' . ($this->siswaCount + 14 + $i) . ':G' . ($this->siswaCount + 14 + $i))->applyFromArray([
                            'borders' => [
                                'bottom' => [
                                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                                ],
                            ],
                        ]);
                        $event->sheet->setCellValue('H' . ($this->siswaCount + 14 + $i), '+');
                    }
                }

                $event->sheet->mergeCells('A' . ($this->siswaCount + 14 + 4) . ':C' . ($this->siswaCount + 14 + 4));
                $event->sheet->setCellValue('A' . ($this->siswaCount + 14 + 4), 'JURNAL KELAS');

                // make with header JAM KE, MATA PELAJARAN, PARAF GURU
                $event->sheet->mergeCells('A' . ($this->siswaCount + 14 + 5) . ':A' . ($this->siswaCount + 14 + 6));
                $event->sheet->setCellValue('A' . ($this->siswaCount + 14 + 5), "JAM\r\nKE");

                $event->sheet->mergeCells('B' . ($this->siswaCount + 14 + 5) . ':C' . ($this->siswaCount + 14 + 6));
                $event->sheet->setCellValue('B' . ($this->siswaCount + 14 + 5), 'MATA PELAJARAN');

                $event->sheet->mergeCells('D' . ($this->siswaCount + 14 + 5) . ':F' . ($this->siswaCount + 14 + 6));
                $event->sheet->setCellValue('D' . ($this->siswaCount + 14 + 5), 'PARAF GURU');

                $event->sheet->getStyle('A' . ($this->siswaCount + 14 + 5) . ':F' . ($this->siswaCount + 14 + 6 + $this->jadwalMataPelajaranCount))->applyFromArray([
                    'alignment' => [
                        'horizontal' => 'center',
                        'vertical' => 'center',
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                    ],
                ]);


                for ($i = 0; $i < $this->jadwalMataPelajaranCount; $i++) {
                    $event->sheet->setCellValue('A' . ($this->siswaCount + 14 + 7 + $i), $i + 1);
                    $event->sheet->mergeCells('B' . ($this->siswaCount + 14 + 7 + $i) . ':C' . ($this->siswaCount + 14 + 7 + $i));
                    $event->sheet->setCellValue('B' . ($this->siswaCount + 14 + 7 + $i), $this->jadwalMataPelajarans[$i]->mataPelajaran->name);
                    $event->sheet->mergeCells('D' . ($this->siswaCount + 14 + 7 + $i) . ':F' . ($this->siswaCount + 14 + 7 + $i));
                }
                // end JURNAL KELAS

                // start paraf petugas rekap
                $event->sheet->mergeCells('H' . ($this->siswaCount + 14 + 5) . ':' . $this->getColumnName($this->jadwalMataPelajaranCount + 4) . ($this->siswaCount + 14 + 5));
                $event->sheet->setCellValue('H' . ($this->siswaCount + 14 + 5), "Jatigung, " . Carbon::parse($this->tanggal)->locale('id')->isoFormat('D MMMM Y'));

                $event->sheet->mergeCells('H' . ($this->siswaCount + 14 + 6) . ':' . $this->getColumnName($this->jadwalMataPelajaranCount + 4) . ($this->siswaCount + 14 + 6));
                $event->sheet->setCellValue('H' . ($this->siswaCount + 14 + 6), "Petugas Rekap");

                $event->sheet->mergeCells('H' . ($this->siswaCount + 14 + 11) . ':' . $this->getColumnName($this->jadwalMataPelajaranCount + 4) . ($this->siswaCount + 14 + 11));

                $event->sheet->getStyle('H' . ($this->siswaCount + 14 + 5) . ':' . $this->getColumnName($this->jadwalMataPelajaranCount + 4) . ($this->siswaCount + 14 + 6))->applyFromArray([
                    'alignment' => [
                        'horizontal' => 'center',
                        'vertical' => 'center',
                    ],
                ]);

                $event->sheet->getStyle('H' . ($this->siswaCount + 14 + 11) . ':' . $this->getColumnName($this->jadwalMataPelajaranCount + 4) . ($this->siswaCount + 14 + 11))->applyFromArray([
                    'borders' => [
                        'bottom' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                    ],
                ]);
            },

        ];
    }

    public function getColumnName($number)
    {
        $abc = range('A', 'Z');
        $result = '';
        while ($number > 0) {
            $result = $abc[$number % 26 - 1] . $result;
            $number = floor($number / 26);
        }
        return $result;
    }

    public function forKelas(Kelas $kelas)
    {
        $this->kelas = $kelas;
        $this->siswaLCount = $kelas->siswas->where('user.jenis_kelamin_id', app(OptionService::class)->getOptionValueByName('L')->id)->count();
        $this->siswaCount = $kelas->siswas->count();
        $this->siswaPCount = $this->siswaCount - $this->siswaLCount;
        return $this;
    }

    public function forTanggal($tanggal)
    {
        $this->tanggal = $tanggal;
        $this->jadwalMataPelajarans = JadwalMataPelajaran::query()
            ->whereHas('mataPelajaran', function ($query) {
                $query->where('kelas_id', $this->kelas->id);
            })
            ->whereHas('hari', function ($query) {
                $query->where('name', Carbon::parse($this->tanggal)->locale('id')->isoFormat('dddd'));
            })
            ->orderBy('jam_mulai')
            ->get();
        $this->jadwalMataPelajaranCount = $this->jadwalMataPelajarans->count();
        return $this;
    }

    public function headings(): array
    {

        return [
            'No',
            'NISN',
            'NAMA',
            'L/P',
            ...range(1, $this->jadwalMataPelajaranCount),
        ];
    }

    public function query()
    {
        return KelasSiswa::query()
            ->where('kelas_id', $this->kelas->id)
            ->with('siswa.user');
    }

    public function map($row): array
    {
        $kehadiranSiswaChildren = $this->jadwalMataPelajarans->map(function ($jadwalMataPelajaran) use ($row) {
            $kehadiranSiswa = KehadiranSiswa::query()
                ->where('tanggal', $this->tanggal)
                ->where('jadwal_mata_pelajaran_id', $jadwalMataPelajaran->id)
                ->first();

            if ($kehadiranSiswa) {
                $kehadiranSiswaChild = KehadiranSiswaChild::query()
                    ->where('kehadiran_siswa_id', $kehadiranSiswa->id)
                    ->where('siswa_id', $row->siswa->id)
                    ->first();

                if ($kehadiranSiswaChild) {
                    return StatusKehadiranEnum::from($kehadiranSiswaChild->statusKehadiran->name)->label();
                }

                return StatusKehadiranEnum::from('Tidak Hadir')->label();
            }

            return StatusKehadiranEnum::from('Tidak Hadir')->label();
        });


        static $no = 1;
        return [
            $no++,
            $row->siswa->nisn . ' / ' . $row->siswa->nipd,
            $row->siswa->user->name,
            $row->siswa->user->jenisKelamin->name,
            ...$kehadiranSiswaChildren,
        ];
    }
}
