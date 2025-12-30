<?php

namespace App\Actions\Fortify;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Illuminate\Http\Request;

class CustomLoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        $user = $request->user();

        if ($user->hasRole('admin')) {
            return redirect()->intended('/admin-dashboard');
        } elseif ($user->hasRole('doctor')) {
            return redirect()->intended('/doctor-dashboard');
        } else {
            return redirect()->intended('/patient-dashboard');
        }
    }
}
