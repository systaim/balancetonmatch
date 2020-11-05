<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function divisionsRegions(){
        return $this->hasMany(DivisionsRegion::class);
    }

    public function competitions(){
        return $this->belongsTo(Competition::class);
    }
}
