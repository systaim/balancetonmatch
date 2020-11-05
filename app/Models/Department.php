<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = ['name','region_id'];

    public function region(){
        return $this->belongsTo(Region::class);
    }

    public function divisionDepartement(){
        return $this->hasMany(DivisionsDepartment::class);
    }


}
