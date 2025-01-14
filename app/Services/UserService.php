<?php

namespace App\Services;

use App\Models\Guru;
use App\Models\Siswa;
use Illuminate\Support\Facades\DB;

class UserService
{
    public function __construct()
    {
        //
    }

    public function updateUser($user, $data)
    {
        return DB::transaction(function () use ($user, $data) {
            $user->update($data);
            return $user;
        });
    }

    public function searchIdentifier($identifier)
    {
        $foundIdentifier = Guru::where('nuptk', $identifier)->first();

        if ($foundIdentifier) {
            return $foundIdentifier;
        }

        $foundIdentifier =  Siswa::query()
            ->where('nisn', $identifier)
            ->orWhere('nipd', $identifier)
            ->first();

        if ($foundIdentifier) {
            return $foundIdentifier;
        }

        return null;
    }
}
