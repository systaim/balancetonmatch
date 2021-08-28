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
     * Get all of the divisions for the Competition
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function divisions(): HasManyThrough
    {
        return $this->hasManyThrough(Match::class, DivisionsRegion::class, null, null,'division_region_id');
    }

    public function matchs(){
        return $this->hasMany(Match::class);
    }
}
