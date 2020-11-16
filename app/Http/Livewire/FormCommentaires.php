<?php

namespace App\Http\Livewire;

use App\Models\Commentaire;
use App\Models\Commentator;
use App\Models\Match;
use App\Models\Statistic;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class FormCommentaires extends Component
{

    public $users;
    public $match;
    public $clubHome;
    public $clubAway;
    public $commentsMatch;
    public $type_comments;
    public $type_but = "";
    public $type_carton = "";
    // public $type_actionMatch = "";
    public $minute = 0;
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
    public $nbrFavoris;
    public $sousMenu;
    public $commentators;
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
        $this->user = $match->user_id;
        $this->dateMatch = $match->date_match;
        $this->minute = now()->diffInMinutes($this->dateMatch);
        if(now()->diffInMinutes($this->dateMatch) >= 0 && now()->diffInMinutes($this->dateMatch) <= 45){
            $this->minute = now()->diffInMinutes($this->dateMatch);
        } elseif (now()->diffInMinutes($this->dateMatch) >= 45 && now()->diffInMinutes($this->dateMatch) <= 60) {
            $this->minute = 45;
        } elseif (now()->diffInMinutes($this->dateMatch) > 60 && now()->diffInMinutes($this->dateMatch) < 90) {
            $this->minute = now()->diffInMinutes($this->dateMatch) - 15;
        } else {
            $this->minute = 90;
        }
        if (now()->diffInHours($this->dateMatch, false) < -4) {
            $this->match->live = "finDeMatch";
            $this->match->save();
            $this->nbrFavoris = 0;
        }
    }

    public function sousMenu()
    {
        $this->sousMenu = 1;
    }

    public function chrono()
    {
        if ($this->minute < 90) {
            $this->minute += 1;
        }
    }

    public function miseAJourCom()
    {
        $this->home_score = $this->match->home_score;
        $this->away_score = $this->match->away_score;
        $this->commentsMatch = $this->match->commentaires()->orderBy('minute', 'desc')->orderBy('updated_at', 'desc')->get();
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

        if ($this->dateMatch->diffInMinutes(now(), false) > -30) {
            $commentateur = new Commentator;
            $commentateur['user_id'] = $user->id;
            $commentateur['match_id'] = $this->match->id;
            $commentateur->save();
            $this->match->live = "reporte";
            $this->match->save();
        } else {
            session()->flash('messageAnnulation', "Revenez 30 minutes avant le coup d'envoi");
        }
    }

    public function timeZero()
    {
        $user = Auth::user();

        if ($this->dateMatch->diffInMinutes(now(), false) > -30) {
            $commentateur = new Commentator;
            $commentateur['user_id'] = $user->id;
            $commentateur['match_id'] = $this->match->id;
            $commentateur->save();
            $this->match->live = "debut";
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

                $comment->commentator()->associate($commentateur);
                $comment->save();
                $this->commentsMatch =  $this->match->commentaires()->orderBy('minute', 'desc')->orderBy('updated_at', 'desc')->get();
                session()->flash('messageComment', 'Merci pour ce commentaire 😉');
            }
        } else {
            session()->flash('messageCom', "Revenez 30 minutes avant le coup d'envoi");
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

            foreach ($this->commentators as $comm) {
                $comment->commentator()->associate($comm->id);
            }
            $comment->save();
            $this->commentsMatch =  $this->match->commentaires()->orderBy('minute', 'desc')->orderBy('updated_at', 'desc')->get();
            session()->flash('messageComment', 'Évènement bien pris en compte');
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

            foreach ($this->commentators as $comm) {
                $comment->commentator()->associate($comm->id);
            }
            $comment->save();
            $this->commentsMatch =  $this->match->commentaires()->orderBy('minute', 'desc')->orderBy('updated_at', 'desc')->get();
            session()->flash('messageComment', 'Évènement bien pris en compte');
        }
    }

    public function timeFinDuMatch()
    {
        $user = Auth::user();
        $this->match->live = "finDeMatch";
        $this->match->save();
        $this->nbrFavoris = 0;

        $commentData['type_comments'] = "FIN DU MATCH !!!";
        $commentData['minute'] = 90;
        $commentData['team_action'] = 'match';

        $comment = Commentaire::create($commentData);

        if ($comment) {

            foreach ($this->commentators as $comm) {
                $comment->commentator()->associate($comm->id);
            }
            $comment->save();
            $this->commentsMatch =  $this->match->commentaires()->orderBy('minute', 'desc')->orderBy('updated_at', 'desc')->get();
            session()->flash('messageComment', '😍 MERCI MERCI MERCI 😍');
        }
    }

    public function saveComment()
    {
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
            foreach ($this->commentators as $comm) {
                $comment->commentator()->associate($comm->id);
            }

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
