<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    public $fillable = ['user_id', 'match_id', 'club_id', 'type', 'player_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function match()
    {
        return $this->belongsTo(Rencontre::class);
    }

    public function player()
    {
        return $this->belongsTo(Player::class);
    }

    public function club()
    {
        return $this->belongsTo(Club::class);
    }

}
