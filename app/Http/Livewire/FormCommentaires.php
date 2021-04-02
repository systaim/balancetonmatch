<?php

namespace App\Http\Livewire;

use App\Models\Commentaire;
use App\Models\Commentator;
use App\Models\Counter;
use App\Models\Player;
use App\Models\Statistic;
use Illuminate\Http\Request;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\RequiredIf;
use Livewire\WithFileUploads;

class FormCommentaires extends Component
{

    use WithFileUploads;
    
    // Variables initailisées dans MatchContoller@show 
    public $commentator;
    public $match;
    public $commentsMatch;
    public $nbrFavoris;

    // Variables donnant accès aux colonnes de la table match
    public $type_comments;
    public $type_but = "";
    public $type_carton = "";
    public $type_actionMatch = "";
    public $minute = 0;
    public $team_action = '';

    public $commentPerso = "";
    public $minuteCom;
    public $player;
    public $home_score;
    public $away_score;
    public $tpsMatch;
    public $stats;
    public $dateMatch;
    public $heureMatch;
    public $firstCom;
    public $file;
    public $menuCom;
    public $playerPrenom;
    public $playerNom;
    public $playerMatch;
    public $visitors;
    public $textInfo;

    public $listGoal = ['GOOOOAAL !', 'BUUUUT !!!', 'GOAL GOAL GOAL !!'];
    public $mitempsJoueurs = ['Les joueurs rentrent aux vestiaires', 'Tout le monde à la buv... euuuh aux vestiaires !'];
    
    public function mount()
    {
        $this->dateMatch = $this->match->date_match;

        //calcul du temps de jeu
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
            $this->textInfo = "Commentaires fermés";
            $this->match->save();
        }

        $this->minuteCom = $this->minute;
        
        $this->miseAJourCom();

        $this->countVisitor();
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

        $this->miseAJourCom();

        $this->countVisitor();
    }

    public function needHelp()
    {
        $this->firstCom = 1;
        Auth::user()->first_com = 1;
        Auth::user()->save();
    }

    public function deleteMenu()
    {
        $this->deleteMenu = 1;
    }

    public function miseAJourJoueur($teamAction, Statistic $stat)
    {
        // dd($this->playerMatch);
        // dd($teamAction);

        

        if (empty($this->playerMatch) || $this->playerMatch == null) {
            // dd('creation');
            $dataPlayer = $this->validate([
                'playerPrenom' => 'required|string|min:2',
                'playerNom' => 'required|string|min:2',
            ]);

            $player = new Player();
            $player['first_name'] = $this->playerPrenom;
            $player['last_name'] = $this->playerNom;
            if ($teamAction == "home") {
                $player['club_id'] = $this->match->home_team_id;
            }
            if ($teamAction == "away") {
                $player['club_id'] = $this->match->away_team_id;
            }
            $player['user_id'] = Auth::user()->id;

            if ($player->save()) {
                $stat->player()->associate($player);
                $stat->save();
            }
        } else {
            // dd('utilisation');
            $stat->player()->associate($this->playerMatch);
            $stat->save();
        }

        $this->miseAJourCom();
        return redirect()->to('matches/' . $this->match->id);
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
        
        $this->firstCom = 0;
        Auth::user()->first_com = 0;
        Auth::user()->save();
    }

    public function becomeCommentator()
    {
        

        if ($this->dateMatch->diffInMinutes(now(), false) > -30) {
            $commentateur = new Commentator;
            $commentateur['user_id'] = Auth::user()->id;
            $commentateur['match_id'] = $this->match->id;
            $commentateur->save();

            session()->flash('success', 'Tu es le commentateur de ce match ! 😎');
            return redirect()->to('matches/' . $this->match->id);
        } else {
            session()->flash('warning', "Reviens 30 minutes avant le coup d'envoi pour pouvoir commenter");
            return redirect()->to('matches/' . $this->match->id);
        }
    }

    public function matchReporte()
    {
        

        if ($this->dateMatch->diffInMinutes(now(), false) > -30) {
            $commentateur = new Commentator;
            $commentateur['user_id'] = Auth::user()->id;
            $commentateur['match_id'] = $this->match->id;
            $commentateur->save();
            $this->match->live = "reporte";
            $this->match->save();
        } else {
            session()->flash('warning', "Reviens 30 minutes avant le coup d'envoi pour pouvoir annoncer le report ou l'annulation ");
            return redirect()->to('matches/' . $this->match->id);
        }
    }

    public function timeZero()
    {
        if ($this->dateMatch->diffInMinutes(now(), false) > -30) {


            $commentData['type_comments'] = "Début du match ! 🤩";
            $commentData['minute'] = 0;
            $commentData['team_action'] = 'match';
            $commentData['commentator_id'] = $this->match->commentateur->id;
            $commentData['images'] = "images/gifs/start.gif";

            $comment = Commentaire::create($commentData);

            if ($comment) {

                $this->match->live = "debut";

                $this->home_score = 0;
                $this->match->home_score = 0;

                $this->away_score = 0;
                $this->match->away_score = 0;

                $this->match->save();

                $comment->save();

                session()->flash('success', 'Bon Match ! ⚽⚽⚽');
                return redirect()->to('matches/' . $this->match->id);
            } else {
                session()->flash('danger', 'Un problème s\'est produit');
                return redirect()->to('matches/' . $this->match->id);
            }
        } else {
            session()->flash('warning', "Reviens 30 minutes avant le coup d'envoi");
            return redirect()->to('matches/' . $this->match->id);
        }
    }

    public function timeMitemps()
    {

        
        $this->match->live = "mitemps";
        $this->match->save();

        $commentData['type_comments'] = "C'est la mi-temps ! 🍻";
        $commentData['minute'] = 45;
        $commentData['team_action'] = 'match';
        $commentData['comments'] = $this->mitempsJoueurs[array_rand($this->mitempsJoueurs)];
        $commentData['commentator_id'] = $this->match->commentateur->id;
        // $commentData['images'] = "images/gifs/lonely-goalie.gif";



        $comment = Commentaire::create($commentData);

        if ($comment) {

            $comment->save();

            session()->flash('success', 'Mi-temps ! Repos bien mérité... Rendez-vous dans 15 minutes 🍻');
            return redirect()->to('matches/' . $this->match->id);
        }
    }

    public function timeReprise()
    {
        
        $this->match->live = "repriseMT";

        $commentData['type_comments'] = "C'est la reprise ! 😎";
        $commentData['minute'] = 45;
        $commentData['team_action'] = 'match';
        $commentData['commentator_id'] = $this->match->commentateur->id;


        $comment = Commentaire::create($commentData);

        if ($comment) {

            $this->match->save();
            $comment->save();
            $this->commentsMatch =  $this->match->commentaires()->orderBy('minute', 'desc')->orderBy('updated_at', 'desc')->get();
            session()->flash('success', 'C\'est reparti !! 😉');
            return redirect()->to('matches/' . $this->match->id);
        }
    }

    public function timeFinDuMatch()
    {
        
        $this->match->live = "finDeMatch";

        $this->nbrFavoris = 0;

        $commentData['type_comments'] = "FIN DU MATCH !!!";
        $commentData['minute'] = 90;
        $commentData['team_action'] = 'match';
        $commentData['commentator_id'] = $this->match->commentateur->id;

        $comment = Commentaire::create($commentData);

        if ($comment) {

            $this->match->save();
            $comment->save();
            $this->commentsMatch =  $this->match->commentaires()->orderBy('minute', 'desc')->orderBy('updated_at', 'desc')->get();
            session()->flash('success', '😍 MERCI MERCI MERCI 😍');
            return redirect()->to('matches/' . $this->match->id);
        }
    }

    protected $rules = [
        'type_comments' => 'required|string',
        'minute' => 'required|string',
        'team_action' => 'required|string',
        'file' => 'nullable | mimes:jpeg,jpg,png,gif,mp4,mov,ogg,qt,m3u8,ts,3gp|max:10240'
    ];

    protected $messages = [
        'type_comments.required' => 'c\'est requis !',
        'type_comments.string' => 'mauvais format',
    ];

    public function saveComment()
    {

        if ($this->dateMatch->diffInMinutes(now(), false) >= 0 && $this->match->live == "debut" || $this->match->live == "repriseMT") {

            $statData2['action'] = '';

            $this->validate([
                'type_comments' => 'required|string',
                'minute' => 'required|integer|between:1,120',
                'team_action' => 'required|string',
                'file' => 'nullable | mimes:jpeg,jpg,png,gif,mp4,gif,mov,ogg,quicktime,m3u8,ts,3gp|max:10240'
            ]);


            $commentData = ['minute' => $this->minuteCom, 'team_action' => $this->team_action];
            $commentData['commentator_id'] = $this->commentator[0]->id;

            if ($this->type_comments == "but") {
                $commentData['type_action'] = "goal";
                $commentData['type_comments'] = $this->listGoal[array_rand($this->listGoal)];
                $commentData['comments'] = $this->type_but;
                // if($this->type_but == "perso"){
                //     $commentData['comments'] = $this->commentPerso;
                // } else {
                //     $commentData['comments'] = $this->type_but;
                // }

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
                    $commentData['comments'] = "1er carton jaune";
                }
                if ($this->type_carton == '2e carton jaune') {
                    $commentData['type_action'] = "2nd yellow_card";
                    $statData['action'] = "yellow_card";
                    $commentData['comments'] = "2e carton jaune";

                    $statData2['action'] = "red_card";
                    $statData2['player_id'] = $this->player;
                }
                if ($this->type_carton == 'Carton rouge') {
                    $commentData['type_action'] = "red_card";
                    $commentData['comments'] = "Le joueur est exclu du match";
                    $statData['action'] = "red_card";
                }
                if ($this->type_carton == 'Carton blanc') {
                    $commentData['type_action'] = "white_card";
                    $commentData['comments'] = "Le joueur est exclu pendant 10 minutes";
                }
            } else {
                $commentData['type_comments'] = $this->type_comments;
            }

            $comment = Commentaire::create($commentData);

            if ($comment) {

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
                session()->flash('success', 'Commentaire bien pris en compte ! 💪');
                return redirect()->to('matches/' . $this->match->id);
            }
        } else {
            session()->flash('warning', "Il n'est pas possible de commenter maintenant");
            return redirect()->to('matches/' . $this->match->id);
        }
    }

    public function retour()
    {
        $this->team_action = false;
        $this->file = "";
        $this->type_comments = "";
        $this->player = "";
        $this->type_but = "";
        $this->type_carton = "";
    }

    public function render()
    {
        return view('livewire.form-commentaires');
    }
}
