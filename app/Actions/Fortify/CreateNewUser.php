<?php

namespace App\Actions\Fortify;

use App\Models\Club;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use phpDocumentor\Reflection\Types\Nullable;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {

        Validator::make($input, [
            'last_name' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'pseudo' => ['required', 'string', 'max:50'],
            'date_of_birth' => ['nullable', 'date'],
            'club' => ['nullable'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
        ])->validate();

        return User::create([
            'last_name' => $input['last_name'],
            'first_name' => $input['first_name'],
            'pseudo' => $input['pseudo'],
            'date_of_birth' => $input['date_of_birth'],
            'prefer_team' => $input['club'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
