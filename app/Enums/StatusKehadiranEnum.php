<?php

namespace App\Enums;

enum StatusKehadiranEnum: string
{
    case HADIR = 'Hadir';
    case TERLAMBAT = 'Terlambat';
    case TIDAK_HADIR = 'Tidak Hadir';
    case IZIN = 'Izin';

    public static function getLabels(): array
    {
        return [
            self::HADIR => 'Hadir',
            self::TERLAMBAT => 'Terlambat',
            self::TIDAK_HADIR => 'Tidak Hadir',
            self::IZIN => 'Izin',
        ];
    }

    // ambil singkatan dari status kehadiran
    public function label(): string
    {
        return match ($this) {
            static::HADIR => ' ',
            static::TERLAMBAT => 'T',
            static::TIDAK_HADIR => 'A',
            static::IZIN => 'I',
            default => 'A',
        };
    }
}
