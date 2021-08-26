<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Tab extends Model
{
    use HasFactory;

    protected $fillable = ['number', 'score', 'match_id', 'club_id'];

    /**
     * Get the match that owns the Tab
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function match(): BelongsTo
    {
        return $this->belongsTo(Match::class);
    }

    /**
     * Get the club that owns the Tab
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function club(): BelongsTo
    {
        return $this->belongsTo(Club::class);
    }
}
