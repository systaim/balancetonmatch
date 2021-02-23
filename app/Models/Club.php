<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Club extends Model
{
    use \Awobaz\Compoships\Compoships;

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

    // public function teams()
    // {
    //     return $this->hasMany(Team::class);
    // }

    // public function matchs()
    // {
    //     return $this->hasMany(Match::class, ['home_team_id', 'away_team_id'],['id', 'id']);
    // }
    // public function scopeMatches($query)
    // {
    //     return $query->;
    // }

    public function matches($date = null)
    {
        return Match::club($this->id, $date);
    }


    public function statistics()
    {
        return $this->hasManyThrough(Statistic::class, Player::class);
    }

    public function favoristeams()
    {
        return $this->hasMany(Favoristeam::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id');
    }

}
