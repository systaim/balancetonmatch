<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DivisionsDepartment extends Model
{
    use HasFactory;

    protected $fillable = ['name','department_id'];

    public function departments(){
        return $this->belongsTo(Department::class);
    }

    public function group(){
        return $this->morphMany(Group::class,'relatable');
    }
}
