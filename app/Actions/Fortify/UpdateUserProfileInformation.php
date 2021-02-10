<?php

namespace App\Actions\Fortify;

use App\Models\Club;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    public $clubs;

    public function __construct()
    {
        $this->clubs = Club::all();
    }
    /**
     * Validate and update the given user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    public function update($user, array $input)
    {
        Validator::make($input, [
            'last_name' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'pseudo' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'photo' => ['nullable', 'image', 'max:4080'],
            'club_id' => ['nullable'],
        ])->validateWithBag('updateProfileInformation');

        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }

        $user->forceFill([
            'last_name' => $input['last_name'],
            'first_name' => $input['first_name'],
            'pseudo' => $input['pseudo'],
            'email' => $input['email'],
        ])->save();

    }
}
