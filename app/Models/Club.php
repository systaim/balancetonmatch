<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Club extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['abbreviation', 'name', 'city', 'logo_path', 'primary_color', 'secondary_color'];

    public function staffs()
    {
        return $this->hasMany(Staff::class);
    }

    public function players()
    {
        return $this->hasMany(Player::class);
    }

    public function teams()
    {
        return $this->hasMany(Team::class);
    }

    public function matchs()
    {
        return $this->hasMany(Match::class);
    }

    public function dernierMatch($limit = null)
    {
        return Match::popular($this->id, $limit)->get();
    }

    public function statistics()
    {
        return $this->hasManyThrough(Statistic::class, Player::class);
    }

    public static function searchByName(string $name){
        return self::searchBy('name', $name);
    }

    public static function searchBy(string $key, string $value)
    {
        return collect(Club::all())
        ->filter(fn($club) => Str::contains(strtolower($club[$key]), strtolower($value)))
        ->all();
    }
}
