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
     * Get the department that owns the Club
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'department_id');
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

    public function getLogoAttribute()
    {
        if ($this->logo_path) {
            return "{$this->logo_path}";
        } else{
            return "https://android-apiapp.azureedge.net/common/bib_img/logo/{$this->numAffiliation}.jpg";
        }
    }

    public function getInitialAttribute()
    {
        if ($this->abbreviation) {
            return strtoupper("{$this->abbreviation}");
        } else {
            $words = explode(" ", "{$this->name}");
            $name = "";
            foreach($words as $word){
                if (is_numeric($word[0])) {
                    $explode_word = str_split($word);
                    foreach ($explode_word as $letter) {
                        $name .= $letter;
                    }
                } else {
                    $name .= $word[0];
                }
            }

            return strtoupper($name);
        }
    }

    public function composition($match_id)
    {
        $composition = [];
        $match = Rencontre::find($match_id);
        $club = Club::find($this->id);
        $compos = Composition::where('club_id', $this->id)->where('rencontre_id', $match_id)->get();
        foreach ($compos as $compo ) {
            array_push($composition, $compo->player_id);
        }
        return $composition;
    }

    public function player_of_this_match($match_id, $player_id)
    {
        if (in_array($player_id, $this->composition($match_id, $this->id))) {
            return "disabled";
        } else {
            return "{$player_id}";
        }

    }

}
