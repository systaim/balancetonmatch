<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\Match_;

class Statistic extends Model
{
    use HasFactory;

    protected $fillable = ['action','commentaire_id','player_id'];

    public function player(){
        return $this->belongsTo(Player::class);
    }

    public function commentaire(){
        return $this->belongsTo(Commentaire::class);
    }

    public function match()
    {
        return $this->hasManyThrough(Commentator::class, Match::class);
    }
}
