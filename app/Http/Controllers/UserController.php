<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Mail\Mailable;
use Illuminate\Notifications\Notifiable;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{

    use Notifiable;

    public function index()
    {
        $users = User::all();
        $role = Auth::user()->role;

        if($role == "super-admin" || $role == "admin"){
            return view('admin.users', compact('users'));
        } else{
            return redirect('/')->with('danger', "Vous n'êtes pas autorisé à entrer ici");

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $role = Auth::user()->role;

        if($role == "super-admin" || $role == "admin"){
            return view('admin.user', compact('user'));
        } else{
            return redirect('/')->with('danger', "Vous n'êtes pas autorisé à entrer ici");

        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
    

}
