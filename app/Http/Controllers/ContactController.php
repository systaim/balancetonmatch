<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Framework\MockObject\Stub\ReturnReference;
use Symfony\Component\Console\Input\Input;

class ContactController extends Controller
{
    public function __invoke(Request $request, Input $input)
    {

        Validator::make($input, [
            'prenom' => ['required', 'string', 'max:255'],
            'nom' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);

        return back();
    }
}
