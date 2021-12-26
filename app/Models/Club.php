<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Club extends Model
{

    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['abbreviation','numAffiliation','zip_code', 'name', 'city', 'logo_path', 'primary_color', 'secondary_color', 'region_id'];

    // protected $hidden = ['id', 'created_at', 'updated_at', 'deleted_at'];

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
    //     return $this->hasMany(Rencontre::class, ['home_team_id', 'away_team_id'],['id', 'id']);
    // }

    public function matches($date = null)
    {
        return Rencontre::club($this->id, $date);
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

    /**
     * Get all of the teams for the Club
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function teams(): HasMany
    {
        return $this->hasMany(Team::class);
    }

}
