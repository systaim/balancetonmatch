<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use NotificationChannels\WebPush\HasPushSubscriptions;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use SoftDeletes;
    use HasPushSubscriptions;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'last_name',
        'first_name',
        'pseudo',
        'email',
        'date_of_birth',
        'tel',
        'password',
        'rank',
        'profile_photo_path',
        'region_id',
        'note',
        'first_com',
        'is_player',
        'club_id',
        'nb_commentaires'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function club()
    {
        return $this->belongsTo(Club::class, 'club_id');
    }

    public function player()
    {
        return $this->belongsTo(Player::class, 'is_player');
    }

    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id');
    }

    public function commentators()
    {
        return $this->hasMany(Commentator::class);
    }

    public function favoristeams()
    {
        return $this->hasMany(Favoristeam::class);
    }

    public function favorismatches()
    {
        return $this->hasMany(Favorismatch::class);
    }

    public function isFavoriTeam($club)
    {
        return $this->favoristeams->contains(function ($favori) use ($club) {
            return $favori->club_id == $club->id;
        });
    }

    public function isFavoriMatch($match)
    {
        return $this->favorismatches->contains(function ($favori) use ($match) {
            return $favori->match_id == $match->id;
        });
    }

    public function getnbrLikes($user_id)
    {
        $com = Commentator::where('user_id', $user_id)->get();

        $likes = $com->merci;

        return $likes;
    }

    /**
     * Get all of the comments for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function articles(): HasMany
    {
        return $this->hasMany(Article::class,);
    }

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
