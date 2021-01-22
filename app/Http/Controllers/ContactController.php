<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Log\Logger;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{

    public function __invoke(Request $request)
    {

        $this->validate($request, [
            'prenom' => ['required', 'string', 'max:255'],
            'nom' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'message' => ['required', 'string', 'min:10', 'max:1000'],
        ]);

        $contactCreate = [
            'prenom' => $request->get('prenom'),
            'nom' => $request->get('nom'),
            'email' => $request->get('email'),
            'message' => $request->get('message'),
        ];

        $admins = User::where('role_id', '1')->get();

        foreach ($admins as $admin) {
        }

        Mail::to('systaim@gmail.com')
            ->send(new ContactMail($contactCreate));

        return redirect('/')->with('success', 'Votre message a bien été envoyée');
    }
}
