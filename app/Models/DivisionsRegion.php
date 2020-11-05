<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DivisionsRegion extends Model
{
    use HasFactory;

    protected $fillable = ['name','region_id'];

    public function region(){
        return $this->belongsTo(Region::class);
    }

    public function group(){
        return $this->morphMany(Group::class,'relatable');
    }
}
