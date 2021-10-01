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
    }

    public function hydrate()
    {
        $this->majPage();
    }

    public function majPage()
    {
        $this->home_score = $this->match->home_score;
        $this->away_score = $this->match->away_score;
        $this->match->date_match;
        $this->majCommentaires();
        $this->countVisitor();

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
