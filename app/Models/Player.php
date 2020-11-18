<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Player extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['last_name','first_name','date_of_birth','team','position', 'user_id', 'club_id'];

    protected $date = [
        'date_of_birth',
    ];

    public function club(){
        return $this->belongsTo(Club::class, 'club_id');
    }

    public function match(){
        return $this->belongsTo(Match::class);
    }
    
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function statistics(){
        return $this->hasMany(Statistic::class);
    }
}
