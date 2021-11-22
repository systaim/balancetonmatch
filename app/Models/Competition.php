<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Competition extends Model
{
    use HasFactory;

    public function region(){
        return $this->belongsTo(Region::class);
    }

    /**
     * Get all of the divisionRegion for the Competition
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function divisionRegions(): HasManyThrough
    {
        return $this->hasManyThrough(DivisionsRegion::class, Rencontre::class);
    }

    /**
     * Get all of the groups for the Competition
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function groups(): HasManyThrough
    {
        return $this->hasManyThrough(Group::class, Rencontre::class);
    }

    public function matchs(){
        return $this->hasMany(Rencontre::class, 'match_id');
    }
}
