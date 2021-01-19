<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        // dd($request);
        return $request->wantsJson()
            ? response()->json(['two_factor' => false])
            : redirect()->intended(session('before-login-url')); // This is the line you want to modify so the application behaves the way you want.
    }
}
