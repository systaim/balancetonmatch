<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = ['images', 'match_id', 'commentator_id'];

    public function match()
    {
        return $this->BelongsTo(Rencontre::class);
    }

    public function commentateur()
    {
        return $this->BelongsTo(Commentator::class);
    }
}
