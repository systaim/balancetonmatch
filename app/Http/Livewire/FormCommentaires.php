<?php

namespace App\Http\Livewire;

use App\Models\Commentaire;
use App\Models\Match;
use App\Models\Statistic;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class FormCommentaires extends Component
{

    public $match;
    public $clubHome;
    public $clubAway;
    public $commentsMatch;
    public $type_comments;
    public $type_but = "";
    public $type_carton = "";
    public $minute;
    public $team_action = '';
    public $live;
    public $player;
    public $home_score;
    public $away_score;
    public $tpsMatch;
    public $stats;
    public $dateMatch;
    public $heureMatch;
    public $matchNonDispo = "";
    public $listGoal = ['GOOOOAAL !', 'BUUUUT !!!', 'GOAL GOAL GOAL !!'];
    public $mitempsJoueurs = ['Les joueurs rentrent aux vestiaires', 'Tout le monde à la buv... euuuh aux vestiaires !'];

    public function mount($match, $clubHome, $clubAway, $commentsMatch)
    {
        $this->clubHome = $clubHome;
        $this->clubAway = $clubAway;
        $this->commentsMatch = $commentsMatch;
        $this->match = $match;
        $this->live = $match->live;
        $this->home_score = $match->home_score;
        $this->away_score = $match->away_score;
        $this->heureMatch = $match->time;
        $this->user = $match->user_id;
        $this->dateMatch = $match->date_match;
    }

    public function updateHomeScore()
    {
        $this->home_score += 1;
        $this->match->home_score += 1;
        $this->match->save();
    }
    public function updateAwayScore()
    {
        $this->away_score += 1;
        $this->match->away_score += 1;
        $this->match->save();
    }

    public function matchReporte()
    {
        $user = Auth::user();

        if ($this->dateMatch->diffInMinutes(now()) > -30 && $this->dateMatch->diffInHours(now()) < 24) {
        $this->match->live = 'reporte';
        $this->match->user_id = $user->id;
        $this->match->save();
        } else {
            session()->flash('messageAnnulation', "Il est possible de commenter 30 minutes avant le match et jusque 24h après");
        }
    }

    public function timeZero()
    {
        $user = Auth::user();

        if ($this->dateMatch->diffInMinutes(now()) > -30 && $this->dateMatch->diffInHours(now()) < 24) {
            $this->match->live = "debut";
            $this->match->user_id = $user->id;
            $this->match->save();

            if ($this->home_score == null) {
                $this->home_score = 0;
                $this->match->home_score = 0;
                $this->match->save();
            }

            if ($this->away_score == null) {
                $this->away_score = 0;
                $this->match->away_score = 0;
                $this->match->save();
            }

            $commentData['type_comments'] = "Début du match ! 🤩";
            $commentData['minute'] = 0;
            $commentData['team_action'] = 'match';

            $comment = Commentaire::create($commentData);

            if ($comment) {

                $comment->user()->associate($user);
                $comment->match()->associate($this->match);
                $comment->save();
                $this->commentsMatch =  $this->match->commentaires()->orderBy('minute', 'desc')->orderBy('updated_at', 'desc')->get();
                // session()->flash('messageComment', 'Merci pour ce commentaire 😉');
            }
        } else {
            session()->flash('messageCom', "Il est possible de commenter 30 minutes avant le match et jusque 24h après");
        }
    }

    public function timeMitemps()
    {

        $user = Auth::user();
        $this->match->live = "mitemps";
        $this->match->save();

        $commentData['type_comments'] = "C'est la mi-temps ! 🍻";
        $commentData['minute'] = 45;
        $commentData['team_action'] = 'match';
        $commentData['comments'] = $this->mitempsJoueurs[array_rand($this->mitempsJoueurs)];

        $comment = Commentaire::create($commentData);

        if ($comment) {

            $comment->user()->associate($user);
            $comment->match()->associate($this->match);
            $comment->save();
            $this->commentsMatch =  $this->match->commentaires()->orderBy('minute', 'desc')->orderBy('updated_at', 'desc')->get();
            // session()->flash('messageComment', 'Merci pour ce commentaire 😉');
        }
    }

    public function timeReprise()
    {
        $user = Auth::user();
        $this->match->live = "repriseMT";
        $this->match->save();

        $commentData['type_comments'] = "C'est la reprise ! 😎";
        $commentData['minute'] = 45;
        $commentData['team_action'] = 'match';

        $comment = Commentaire::create($commentData);

        if ($comment) {

            $comment->user()->associate($user);
            $comment->match()->associate($this->match);
            $comment->save();
            $this->commentsMatch =  $this->match->commentaires()->orderBy('minute', 'desc')->orderBy('updated_at', 'desc')->get();
            // session()->flash('messageComment', 'Merci pour ce commentaire 😉');
        }
    }

    public function timeFinDuMatch()
    {
        $user = Auth::user();
        $this->match->live = "finDeMatch";
        $this->match->save();

        $commentData['type_comments'] = "FIN DU MATCH !!!";
        $commentData['minute'] = 90;
        $commentData['team_action'] = 'match';

        $comment = Commentaire::create($commentData);

        if ($comment) {

            $comment->user()->associate($user);
            $comment->match()->associate($this->match);
            $comment->save();
            $this->commentsMatch =  $this->match->commentaires()->orderBy('minute', 'desc')->orderBy('updated_at', 'desc')->get();
            // session()->flash('messageComment', 'Merci pour ce commentaire 😉');
        }
    }

    public function saveComment()
    {
        $user = Auth::user();
        $statData2['action'] = '';
        $validateData = $this->validate([
            'type_comments' => 'required',
            'minute' => 'required',
            'team_action' => 'required',
        ]);

        $commentData = ['minute' => $this->minute, 'team_action' => $this->team_action];

        if ($this->type_comments == "but") {
            $commentData['type_comments'] = $this->listGoal[array_rand($this->listGoal)];
            $commentData['comments'] = $this->type_but;

            $statData['action'] = "goal";


            if ($this->team_action == 'home') {
                $this->home_score += 1;
                $this->match->home_score += 1;
                $this->match->save();
            }
            if ($this->team_action == 'away') {
                $this->away_score += 1;
                $this->match->away_score += 1;
                $this->match->save();
            }
        } elseif ($this->type_comments == "carton") {

            $commentData['type_comments'] = $this->type_carton;

            if ($this->type_carton == 'Carton jaune') {
                $statData['action'] = "yellow_card";
            }
            if ($this->type_carton == '2e carton jaune') {
                $statData['action'] = "yellow_card";
                $statData2['action'] = "red_card";
                $statData2['player_id'] = $this->player;
            }
            if ($this->type_carton == 'Carton rouge') {
                $statData['action'] = "red_card";
            }
        } else {
            $commentData['type_comments'] = $this->type_comments;
        }

        $comment = Commentaire::create($commentData);

        if ($comment) {

            $comment->user()->associate($user);
            $comment->match()->associate($this->match);
            $comment->save();

            $statData['commentaire_id'] = $comment->id;
            $statData['player_id'] = $this->player;
            $statComment = Statistic::create($statData);
            $statComment->commentaire()->associate($comment);
            $statComment->save();
            if ($statData2['action'] != '') {
                $statComment2 = Statistic::create($statData2);
                $statComment2->commentaire()->associate($comment);
                $statComment2->save();
            }
            $this->commentsMatch = $this->match->commentaires()->orderBy('minute', 'desc')->orderBy('updated_at', 'desc')->get();
            session()->flash('messageComment', 'Merci pour ce commentaire 😉');
            $this->team_action = false;
        }
    }

    public function render()
    {
        return view('livewire.form-commentaires');
    }
}
