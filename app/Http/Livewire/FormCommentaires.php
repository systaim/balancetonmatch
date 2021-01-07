<?php

namespace App\Http\Livewire;

use App\Models\Commentaire;
use App\Models\Commentator;
use App\Models\Statistic;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;



class FormCommentaires extends Component
{

    use WithFileUploads;

    public $users;
    public $match;
    public $clubHome;
    public $clubAway;
    public $commentsMatch;
    public $type_comments;
    public $type_but = "";
    public $type_carton = "";
    public $type_actionMatch = "";
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
    public $commentator;
    public $firstCom;
    public $file;
    public $menuCom;
    
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

        if ($this->dateMatch->diffInMinutes(now(), false) >= 0 && $this->dateMatch->diffInMinutes(now(), false) <= 45) {
            $this->minute = now()->diffInMinutes($this->dateMatch);
        } elseif ($this->dateMatch->diffInMinutes(now(), false) >= 45 && $this->dateMatch->diffInMinutes(now(), false) <= 60) {
            $this->minute = 45;
        } elseif ($this->dateMatch->diffInMinutes(now(), false) >= 60 && $this->dateMatch->diffInMinutes(now(), false) <= 90) {
            $this->minute = now()->diffInMinutes($this->dateMatch) - 15;
        } else {
            $this->minute = 0;
        }
        if (now()->diffInMinutes($this->dateMatch, false) < -150) {
            $this->match->live = "finDeMatch";
            $this->match->save();
        }

        // foreach ($this->commentator as $comm) {
        //     $this->firstCom = $comm->user->first_com;
        // }
    }

    public function hydrate()
    {
        if ($this->dateMatch->diffInMinutes(now(), false) >= 0 && $this->dateMatch->diffInMinutes(now(), false) <= 45) {
            $this->minute = now()->diffInMinutes($this->dateMatch);
        } elseif ($this->dateMatch->diffInMinutes(now(), false) >= 45 && $this->dateMatch->diffInMinutes(now(), false) <= 60) {
            $this->minute = 45;
        } elseif ($this->dateMatch->diffInMinutes(now(), false) >= 60 && $this->dateMatch->diffInMinutes(now(), false) <= 90) {
            $this->minute = now()->diffInMinutes($this->dateMatch) - 15;
        } else {
            $this->minute = "";
        }
        if (now()->diffInMinutes($this->dateMatch, false) < -150) {
            $this->match->live = "finDeMatch";
            $this->match->save();
        }
    }

    public function needHelp()
    {
        $user = Auth::user();
        $this->firstCom = 1;
        $user->first_com = 1;
        $user->save();
    }

    public function deleteMenu()
    {
        $this->deleteMenu = 1;
    }

    public function miseAJourCom()
    {
        $this->home_score = $this->match->home_score;
        $this->away_score = $this->match->away_score;
        $this->commentsMatch = $this->match->commentaires()->orderBy('minute', 'desc')->orderBy('updated_at', 'desc')->get();
    }

    // public function updateHomeScore()
    // {
    //     $this->home_score += 1;
    //     $this->match->home_score += 1;
    //     $this->match->save();
    // }
    // public function updateAwayScore()
    // {
    //     $this->away_score += 1;
    //     $this->match->away_score += 1;
    //     $this->match->save();
    // }

    public function clickFirstCom()
    {
        $user = Auth::user();
        $this->firstCom = 0;
        $user->first_com = 0;
        $user->save();
    }

    public function becomeCommentator()
    {
        $user = Auth::user();

        if ($this->dateMatch->diffInMinutes(now(), false) > -30) {
            $commentateur = new Commentator;
            $commentateur['user_id'] = $user->id;
            $commentateur['match_id'] = $this->match->id;
            $commentateur->save();
            return redirect()->to('matches/' . $this->match->id);
            // $this->commentators->push($commentateur);
        } else {
            session()->flash('messageComment', "Revenez 30 minutes avant le coup d'envoi");
        }
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
        if ($this->dateMatch->diffInMinutes(now(), false) > -30) {

            $commentData['type_comments'] = "Début du match ! 🤩";
            $commentData['minute'] = 0;
            $commentData['team_action'] = 'match';

            $comment = Commentaire::create($commentData);

            if ($comment) {

                $this->match->live = "debut";

                $this->home_score = 0;
                $this->match->home_score = 0;

                $this->away_score = 0;
                $this->match->away_score = 0;

                $this->match->save();

                foreach ($this->commentator as $comm) {
                    $comment->commentator()->associate($comm->id);
                }
                $comment->save();

                $this->commentsMatch =  $this->match->commentaires()->orderBy('minute', 'desc')->orderBy('updated_at', 'desc')->get();
                session()->flash('successMessage', 'Bon Match ! 😉');
            } else {
                session()->flash('successMessage', 'Un problème s\'est produit');
            }
        } else {
            session()->flash('messageComment', "Revenez 30 minutes avant le coup d'envoi");
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

            foreach ($this->commentator as $comm) {
                $comment->commentator()->associate($comm->id);
            }
            $comment->save();
            $this->commentsMatch =  $this->match->commentaires()->orderBy('minute', 'desc')->orderBy('updated_at', 'desc')->get();
            session()->flash('successMessage', 'Évènement bien pris en compte');
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

            foreach ($this->commentator as $comm) {
                $comment->commentator()->associate($comm->id);
            }
            $comment->save();
            $this->commentsMatch =  $this->match->commentaires()->orderBy('minute', 'desc')->orderBy('updated_at', 'desc')->get();
            session()->flash('successMessage', 'Évènement bien pris en compte');
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

            foreach ($this->commentator as $comm) {
                $comment->commentator()->associate($comm->id);
            }
            $comment->save();
            $this->commentsMatch =  $this->match->commentaires()->orderBy('minute', 'desc')->orderBy('updated_at', 'desc')->get();
            session()->flash('successMessage', '😍 MERCI MERCI MERCI 😍');
        }
    }

    public function saveComment()
    {

        if ($this->dateMatch->diffInMinutes(now(), false) >= 0 && $this->match->live == "debut" || $this->match->live == "repriseMT") {

            $statData2['action'] = '';
            $this->validate([
                'type_comments' => 'required',
                'minute' => 'required',
                'team_action' => 'required',
                'file' => 'nullable|max:4096'
            ]);

            $commentData = ['minute' => $this->minute, 'team_action' => $this->team_action];

            if ($this->type_comments == "but") {
                $commentData['type_action'] = "goal";
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
                    $commentData['type_action'] = "1st yellow_card";
                    $statData['action'] = "yellow_card";
                }
                if ($this->type_carton == '2e carton jaune') {
                    $commentData['type_action'] = "2nd yellow_card";
                    $statData['action'] = "yellow_card";
                    $statData2['action'] = "red_card";
                    $statData2['player_id'] = $this->player;
                }
                if ($this->type_carton == 'Carton rouge') {
                    $commentData['type_action'] = "red_card";
                    $statData['action'] = "red_card";
                }
            } else {
                $commentData['type_comments'] = $this->type_comments;
            }

            $comment = Commentaire::create($commentData);

            if ($comment) {
                foreach ($this->commentator as $comm) {
                    $comment->commentator()->associate($comm->id);
                }
                if ($this->file) {
                    $path = $this->file->store('uploads');
                    $comment->images = $path;
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
                session()->flash('successMessage', 'Merci pour ce commentaire 😉');
                $this->team_action = false;
                $this->file = "";
                $this->type_comments = "";
                $this->player = "";
                $this->type_but = "";
                $this->type_carton = "";
            }
        } else {
            session()->flash('messageDebutDeMatch', "Il n'est pas possible de commenter maintenant");
        }
    }

    public function render()
    {
        return view('livewire.form-commentaires');
    }
}
