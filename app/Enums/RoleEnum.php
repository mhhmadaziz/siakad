<?php

namespace App\Enums;

enum RoleEnum: string
{
    case ADMIN = 'admin';
    case GURU = 'guru';
    case SISWA = 'siswa';

    public function label(): string
    {
        return match ($this) {
            static::ADMIN => 'Admin',
            static::GURU => 'Guru',
            static::SISWA => 'Siswa',
        };
    }
}
