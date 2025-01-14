<?php

namespace App\Http\Controllers;

use App\Enums\RoleEnum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __invoke()
    {
        // check user role
        switch (Auth::user()->firstRole) {
            case RoleEnum::ADMIN->value:
                return redirect()->route('admin.dashboard');
                break;
            case RoleEnum::GURU->value:
                return redirect()->route('guru.dashboard');
                break;
            case RoleEnum::SISWA->value:
                return redirect()->route('siswa.dashboard');
                break;

            default:
                return abort(404);
                break;
        }
    }
}
