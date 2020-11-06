<?php

namespace App\Models;

use Brick\Math\Exception\MathException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Commentaire extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['user_id','player_id','match_id','type_comments', 'comments','minute','team_action'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function match(){
        return $this->belongsTo(Match::class);
    }

    public function statistic(){
        return $this->hasOne(Statistic::class);
    }

    public function player(){
        return $this->hasOneThrough(Player::class, Statistic::class);
    }

    public function scopePopular($query, $id){
        return $query->where('match_id', $id)->latest('minute');
    }
}
