<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SiswaExportTemplate implements FromArray, WithHeadings, ShouldAutoSize, WithStyles
{
    public function array(): array
    {
        // return data dummy untuk template
        return [
            [
                'Joko',
                '1234567890',
                'L', // Jenis kelamin (L/P)
                '1234567890123456',
                'X-IPS-1', // Format: [Tingkat]-[Nama Kelas], e.g. "X-IPA 1"
                'Lampung',
                '2000-01-01', // Format: YYYY-MM-DD
                'Islam',
                'Jl. Raya No. 1',
                '1',
                '1',
                'DUSUN 1',
                'Desa 1',
                'Kecamatan 1',
                '081234567890',
                'Joko Santoso',
                'Jiki Santoso',
            ],
        ];
    }

    public function headings(): array
    {
        return [
            'Nama',
            'NIPD',
            'jk', // Jenis kelamin (L/P)
            'NISN',
            'Rombel Saat Ini', // Format: [Tingkat]-[Nama Kelas], e.g. "X-IPA 1"
            'Tempat Lahir',
            'Tanggal Lahir', // Format: YYYY-MM-DD
            'Agama',
            'Alamat',
            'RW',
            'RT',
            'Dusun',
            'Kelurahan',
            'Kecamatan',
            'HP',
            'Nama Ayah',
            'Nama Ibu',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}

