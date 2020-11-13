<?php

namespace App\Http\Responses;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        // dd($request);
        return $request->wantsJson()
            ? response()->json(['two_factor' => false])
            : redirect()->intended(); // This is the line you want to modify so the application behaves the way you want.
    }
}
