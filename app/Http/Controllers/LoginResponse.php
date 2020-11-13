<?php

namespace App\Http\Response;

use Illuminate\Http\Request;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        return $request->wantsJson()
            ? response()->json(['two_factor' => false])
            : redirect()->intended(config('fortify.match')); // This is the line you want to modify so the application behaves the way you want.
    }
}
