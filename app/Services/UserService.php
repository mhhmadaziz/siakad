<?php

namespace App\Services;

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
}
