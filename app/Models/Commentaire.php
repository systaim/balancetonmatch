<?php

namespace App\Models;

use App\Models\Reaction;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

class Commentaire extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'commentator_id',
        'rencontre_id',
        'type_action',
        'player_id',
        'match_id',
        'type_comments',
        'comments',
        'minute',
        'team_action',
        'images',
        'updated_at',
        'icon',
        'buteur_id',
        'passeur_id',
        'injury_id',
        'in_substitute_id',
        'out_substitute_id',
        'yellow_card_id',
        'red_card_id'
    ];

    // protected $hidden = ['id', 'created_at', 'updated_at', 'deleted_at'];

    // protected $visible = ['type_comments', 'comments', 'team_action', 'minute', 'images'];

    // public function user(){
    //     return $this->belongsTo(User::class);
    // }

    public function commentator()
    {
        return $this->belongsTo(Commentator::class);
    }

    public function match()
    {
        return $this->belongsTo(Rencontre::class);
    }

    public function statistic()
    {
        return $this->hasOne(Statistic::class);
    }

    public function player()
    {
        return $this->hasOneThrough(Player::class, Statistic::class);
    }

    public function reactions()
    {
        return $this->belongsToMany(Reaction::class);
    }

    public function goal()
    {
        return $this->belongsTo(Player::class, 'buteur_id');
    }

    public function passeur()
    {
        return $this->belongsTo(Player::class, 'passeur_id');
    }

    public function blesse()
    {
        return $this->belongsTo(Player::class, 'injury_id');
    }

    public function yellow_card()
    {
        return $this->belongsTo(Player::class, 'yellow_card_id');
    }

    public function red_card()
    {
        return $this->belongsTo(Player::class, 'red_card_id');
    }

    public function in_substitute()
    {
        return $this->belongsTo(Player::class, 'in_substitute_id');
    }

    public function out_substitute()
    {
        return $this->belongsTo(Player::class, 'out_substitute_id');
    }


}
