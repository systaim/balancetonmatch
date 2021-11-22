<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Player extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['last_name','first_name','date_of_birth','team','position', 'user_id', 'club_id','avatar_path','created_by'];

    protected $date = [
        'date_of_birth',
    ];

    public function club(){
        return $this->belongsTo(Club::class, 'club_id');
    }

    public function match(){
        return $this->belongsTo(Rencontre::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function statistics(){
        return $this->hasManyThrough(Statistic::class, Commentaire::class);
    }
}
