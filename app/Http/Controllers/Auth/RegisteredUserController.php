<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{

    public function __construct(
        protected UserService $userService
    ) {}


    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'identifier' => ['required', 'string', 'max:16'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $identifier = $this->userService->searchIdentifier($request->identifier);

        if (!$identifier) {
            return back()->withErrors([
                'identifier' => 'Data tidak ditemukan.',
            ])->withInput();
        }

        try {
            DB::transaction(function () use ($identifier, $request) {
                $identifier->user()->update([
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);

                $user = User::find($identifier->user_id);

                event(new Registered($user));

                Auth::login($user);
            });

            return redirect(route('dashboard', absolute: false));
        } catch (\Throwable $th) {
            return back()->withErrors([
                'identifier' => 'Data tidak ditemukan. ' . $th->getMessage(),
            ])->withInput();
        }


        /*$user = User::create([*/
        /*    'name' => $request->name,*/
        /*    'email' => $request->email,*/
        /*    'password' => Hash::make($request->password),*/
        /*]);*/
        /**/
        /*event(new Registered($user));*/
        /**/
        /*Auth::login($user);*/
        /**/
        /*return redirect(route('dashboard', absolute: false));*/
    }
}
