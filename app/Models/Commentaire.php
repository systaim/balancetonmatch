<?php

namespace App\Models;

use App\Models\Reaction;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Commentaire extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'commentator_id',
        'type_action',
        'player_id',
        'match_id',
        'type_comments',
        'comments',
        'minute',
        'team_action',
        'images',
        'updated_at'
    ];

    protected $hidden = ['id', 'created_at', 'updated_at', 'deleted_at'];

    protected $visible = ['type_comments', 'comments', 'team_action', 'minute', 'images'];

    // public function user(){
    //     return $this->belongsTo(User::class);
    // }

    public function commentator()
    {
        return $this->belongsTo(Commentator::class);
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
}
