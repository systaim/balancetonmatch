<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Composition extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $fillable =['rencontre_id', 'user_id', 'player_id', 'club_id'];

    public function match()
    {
        return $this->hasOne(Rencontre::class);
    }

    public function players()
    {
        return $this->hasMany(Player::class);
    }

    public function clubs()
    {
        return $this->hasMany(Club::class);
    }

    public function player()
    {
        return $this->belongsTo(Player::class, 'player_id');
    }
}
