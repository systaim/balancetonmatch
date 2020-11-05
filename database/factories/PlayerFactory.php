<?php

namespace Database\Factories;

use App\Models\Club;
use App\Models\Player;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PlayerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Player::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $users = User::all()->pluck('id');
        $clubs = Club::all()->pluck('id');
        $position = ['gardien de but', 'défenseur', 'milieu', 'attaquant'];
        return [
            'name' => $this->faker->lastName,
            'first_name' => $this->faker->firstName,
            'date_of_birth' => $this->faker->date,
            'position' => $this->faker->randomElement($position),
            'user_id' => $this->faker->randomElement($users),
            'club_id' => $this->faker->randomElement($clubs),
        ];
    }
}
