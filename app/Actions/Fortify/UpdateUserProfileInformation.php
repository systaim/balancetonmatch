<?php

namespace App\Actions\Fortify;

use App\Models\Club;
use App\Models\Player;
use App\Models\Region;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{

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
            'club' => ['nullable', 'string'],
            'region' => ['nullable', 'string'],
        ])->validateWithBag('updateProfileInformation');

        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }
        if (isset($input['club']) && $input['club'] != "") {
            $club = Club::where('name', $input['club'])->first();
            $user->club_id = $club->id;
            if($user->role == 'manager'){
                $user->role = 'guest';
            }
        } else {
            $user->club_id = null;
        }
        if (isset($input['region']) && $input['region'] != "") {
            $region = Region::where('name', $input['region'])->first();
            $user->region_id = $region->id;
        } else {
            $user->region_id = null;
        }
        if (isset($input['player'])) {
            $player = Player::where('last_name', $input['player'])->first();
            $user->is_player = $player->id;
        }
        $user->forceFill([
            'last_name' => $input['last_name'],
            'first_name' => $input['first_name'],
            'pseudo' => $input['pseudo'],
            'email' => $input['email'],
        ])->save();
    }
}
