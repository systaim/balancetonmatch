<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    public $fillable = ['user_id', 'match_id', 'type'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function match()
    {
        return $this->hasOne(Match::class);
    }

}
