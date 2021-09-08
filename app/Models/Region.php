<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\divisionsRegion;

class Region extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function divisionsRegions(){
        return $this->hasMany(DivisionsRegion::class);
    }

    /**
     * Get all of the districts for the Region
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function districts(): HasMany
    {
        return $this->hasMany(DivisionsDepartment::class);
    }

    public function competitions(){
        return $this->belongsTo(Competition::class);
    }

    public function departements()
    {
        return $this->hasMany(Department::class);
    }
}
