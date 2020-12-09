<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;


class Match extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['home_team', 'home_score', 'away_team', 'away_score', 'date_match', 'time', 'location', 'weather', 'competition_id', 'live', 'stat_id'];

    protected $dates = ['date_match'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function favorismatches()
    {
        $this->hasMany(Favorismatch::class);
    }

    public function club()
    {
        return $this->belongsTo(Club::class);
    }

    public function commentaires()
    {
        return $this->hasManyThrough(Commentaire::class, Commentator::class);
    }

    public function homeClub()
    {
        return $this->belongsTo(Club::class, 'home_team_id');
    }

    public function awayClub()
    {
        return $this->belongsTo(Club::class, 'away_team_id');
    }

    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id');
    }

    public function competition()
    {
        return $this->belongsTo(Competition::class, 'competition_id');
    }

    public function divisionRegion()
    {
        return $this->belongsTo(DivisionsRegion::class, 'division_region_id');
    }

    public function divisionDepartment()
    {
        return $this->belongsTo(DivisionsDepartment::class, 'division_department_id');
    }

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id');
    }

    public function commentateur()
    {
        return $this->hasOne(Commentator::class);
    }
}
