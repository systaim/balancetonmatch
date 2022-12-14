<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;



class Rencontre extends Model
{

    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'slug',
        'home_team_id',
        'home_score',
        'away_team_id',
        'away_score',
        'date_match',
        'time',
        'location',
        'weather',
        'competition_id',
        'journee_id',
        'region_id',
        'department_id',
        'division_department_id',
        'division_region_id',
        'group_id',
        'live',
        'validate_score',
        'validate_fil_match',
        'validate_by',
        'user_id'
    ];

    protected $dates = ['date_match', 'debut_match_reel', 'fin_match_reel', 'debut_prolongations', 'fin_prolongations'];

    protected $table = 'matches';

    // protected $hidden = ['id', 'created_at', 'updated_at', 'deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function validate_by_user()
    {
        return $this->belongsTo(User::class, 'validate_by');
    }

    public function scopeClub($query, $id, $date = null)
    {
        if ($date == null) {
            $date = Carbon::now();
        }
        return $query->where('date_match', '>=', $date)
            ->where('home_team_id', $id)
            ->orwhere('away_team_id', $id);
    }

    public function favorismatches()
    {
        $this->hasMany(Favorismatch::class);
    }

    // public function club()
    // {
    //     return $this->belongsTo(Club::class);
    // }

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

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
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

    public function connected()
    {
        return $this->hasMany(Counter::class, 'page-address');
    }

    public function medias()
    {
        return $this->HasMany(Gallery::class);
    }
}
