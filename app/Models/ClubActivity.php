<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClubActivity extends Model
{
    use HasFactory;

    public $fillable = ['club_id', 'user_id', 'type', 'description'];

    public function user()
    {
        return $this->BelongsTo(User::class);
    }
}
