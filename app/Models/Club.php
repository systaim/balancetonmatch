<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Club extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['abbreviation', 'name', 'city', 'logo_path', 'primary_color', 'secondary_color'];

    public function staffs()
    {
        return $this->hasMany(Staff::class);
    }

    public function players()
    {
        return $this->hasMany(Player::class);
    }

    public function teams()
    {
        return $this->hasMany(Team::class);
    }

    public function matchs()
    {
        return $this->belongsTo(Match::class);
    }

    public function statistics()
    {
        return $this->hasManyThrough(Statistic::class, Player::class);
    }

    public function favoristeams()
    {
        $this->hasMany(Favoristeam::class);
    }
}
