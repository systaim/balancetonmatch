<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Composition extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function match()
    {
        return $this->hasOne(Match::class);
    }

    public function players()
    {
        return $this->hasMany(Player::class);
    }

    public function clubs()
    {
        return $this->hasMany(Club::class);
    }
}
