<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reaction extends Model
{
    use HasFactory;


    /**
     * Get the commentaire that owns the Reaction
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function commentaires()
    {
        return $this->belongsToMany(Commentaire::class);
    }

    public function getCommentaire($id)
    {
        $r = Commentaire::where('commentaire_id', $id);
        return $r;
    }
}
