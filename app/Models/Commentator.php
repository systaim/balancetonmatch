<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Commentator extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'rencontre_id'];

    protected $hidden = ['id', 'created_at', 'updated_at', 'deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function match()
    {
        return $this->belongsTo(Rencontre::class, 'rencontre_id');
    }

    public function commentaires()
    {
        return $this->hasMany(Commentaire::class);
    }

}
