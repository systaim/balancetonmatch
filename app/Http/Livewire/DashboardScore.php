<?php

namespace App\Http\Livewire;

use App\Models\Counter;
use App\Models\Tab;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DashboardScore extends Component
{

    public $match;
    public $home_score;
    public $away_score;
    public $btnScore = false;
    public $tabHome;
    public $tabAway;
    public $scoreTabHome;
    public $scoreTabAway;
    public $commentsMatch;
    public $nbrFavoris;
    public $minute;

    protected $listeners = [ 'majPage' ];

    public function mount()
    {

        $this->tabHome = Tab::where('match_id', $this->match->id)->where('club_id', $this->match->homeClub->id)->get();
        $this->tabAway = Tab::where('match_id', $this->match->id)->where('club_id', $this->match->awayClub->id)->get();
        $this->scoreTabHome = Tab::where('score', 1)->where('match_id', $this->match->id)->where('club_id', $this->match->homeClub->id)->count();
        $this->scoreTabAway = Tab::where('score', 1)->where('match_id', $this->match->id)->where('club_id', $this->match->awayClub->id)->count();

        $this->home_score = $this->match->home_score;
        $this->away_score = $this->match->away_score;

        $this->majCommentaires();
        $this->countVisitor();
        $this->miseAjourTemps();
    }

    public function hydrate()
    {
        $this->majPage();
        $this->miseAjourTemps();
    }

    public function majPage()
    {
        $this->home_score = $this->match->home_score;
        $this->away_score = $this->match->away_score;
        $this->match->date_match;
        $this->majCommentaires();
        $this->countVisitor();

    }

    public function miseAjourTemps()
    {
        if ($this->match->live == "debut") {
            $this->minute = now()->diffInMinutes($this->match->date_match);
            if ($this->minute >= 45) {
                $this->minute = "45+";
            }
        }

        if ($this->match->live == "mitemps") {
            $this->minute = "MT";
        }

        if ($this->match->live == "repriseMT") {
            $this->minute =  now()->diffInMinutes($this->match->date_match) - 15;
            if ($this->minute >= 95) {
                $this->minute = "90+";
            }
        }

        if ($this->match->live == "prolongations1") {
            $this->minute = now()->diffInMinutes($this->match->debut_prolongations) + 90;
        }

        if ($this->match->live == "prolongations2") {
            $this->minute = now()->diffInMinutes($this->match->debut_sde_mt_prolong) + 105;
        }

        if ($this->match->live == "MTProlongations") {
            $this->minute = "MT";
        }

        if ($this->match->live == "finProlongations") {
            $this->minute = "FIN";

            if ($this->match->home_score == $this->match->away_score) {
                $this->infoMatch = "Les tirs au but vont commencer !!!";
            }
        }


        if ($this->match->live == "tab") {
            $this->minute == "TAB";
        }
        // if ($this->match->debut_match_reel) {
        //     if ($this->match->debut_match_reel->diffInMinutes(now(), false) >= 0 && $this->match->debut_match_reel->diffInMinutes(now(), false) <= 45) {
        //         $this->minute = now()->diffInMinutes($this->match->debut_match_reel);
        //     } elseif ($this->match->debut_match_reel->diffInMinutes(now(), false) >= 45 && $this->match->debut_match_reel->diffInMinutes(now(), false) <= 60 || $this->match->live =="mitemps") {
        //         $this->minute = 45;
        //     } elseif ($this->match->debut_match_reel->diffInMinutes(now(), false) >= 60 && $this->match->debut_match_reel->diffInMinutes(now(), false) <= 105) {
        //         $this->minute = now()->diffInMinutes($this->match->debut_match_reel) - 15;
        //     }
        // }
    }

    public function majCommentaires(){
        $this->commentsMatch = $this->match->commentaires()->orderBy('minute', 'desc')->orderBy('updated_at', 'desc')->get();
    }

    public function countVisitor()
    {

        $visitor = Counter::where('ip-address', request()->ip())->first();

        if (!$visitor) {
            $visitor = new Counter();
            $visitor['ip-address'] = request()->ip();
        }

        $visitor['page-address'] = $this->match->id;

        if (Auth::user()) {
            $visitor['user_id'] = Auth::user()->id;
        }

        $visitor->touch();
        $visitor->save();

        $this->visitors = Counter::where('page-address', $this->match->id)->where('updated_at', '>', now()->subMinutes(15))->get();
    }

    public function render()
    {
        return view('livewire.dashboard-score');
    }
}
