<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commentator extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'match_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function match()
    {
        return $this->hasMany(Match::class, 'match_id');
    }

    public function commentaires()
    {
        return $this->hasMany(Commentaire::class, 'commentator_id');
    }
}
