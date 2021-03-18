<?php

namespace App\Http\Controllers;

use App\Mail\AskNewTeamMail;
use App\Mail\askPlayerMail;
use App\Mail\BecomeManagerMail;
use App\Mail\ContactMail;
use App\Models\Club;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Log\Logger;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{

    public function store(Request $request)
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

        $superAdmin = User::where('role', 'super-admin')->get()->pluck('email');
        // $admins = User::where('role', 'admin')->get()->pluck('email');

        Mail::to($superAdmin)
            ->send(new ContactMail($contactCreate));

        return redirect('/')->with('success', 'Ton message a bien été envoyée');
    }

    public function askNewTeam(Request $request)
    {
        $this->validate($request, [
            'region' => 'bail|string|exists:App\Models\Region',
            'departement' => 'bail|string|exists:App\Models\Departments',
            'nomClub' => 'bail|string|alpha',
        ]);

        $contactCreate = [
            'region' => $request->get('region'),
            'departement' => $request->get('departement'),
            'nomClub' => $request->get('nomClub'),
        ];

        $superAdmin = User::where('role', 'super-admin')->get()->pluck('email');
        // $admins = User::where('role', 'admin')->get()->pluck('email');

        Mail::to($superAdmin)
            ->send(new AskNewTeamMail($contactCreate));

        return redirect('/')->with('success', 'Ta demande a bien été envoyée');
    }

    public function askPlayer(Request $request, Club $club)
    {
        // dd($request);
        $contactCreate = [
            'clubName' => $request->get('clubName'),
            'clubId' => $request->get('clubId'),
        ];

        $superAdmin = User::where('role', 'super-admin')->get()->pluck('email');

        Mail::to($superAdmin)
            ->send(new askPlayerMail($contactCreate));

        return redirect('clubs/' .$request->get('clubId') )->with('success', 'La demande a bien été envoyée');
    }

    public function becomeManager(Request $request)
    {
        // dd($request);

        $contactCreate = [];

        $superAdmin = User::where('role', 'super-admin')->get()->pluck('email');

        Mail::to($superAdmin)
            ->send(new BecomeManagerMail($contactCreate));

        return redirect('/user/profile' )->with('success', 'La demande a bien été envoyée');
    }
}
