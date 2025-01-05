<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __invoke()
    {
        // check user role
        switch (Auth::user()->firstRole) {
            case 'admin':
                return redirect()->route('admin.dashboard');
                break;
            default:
                return abort(404);
                break;
        }
    }
}
