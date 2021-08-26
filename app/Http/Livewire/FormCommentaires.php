<?php

namespace App\Http\Livewire;

use App\Models\Club;
use App\Models\Commentaire;
use App\Models\Commentator;
use App\Models\Counter;
use App\Models\Player;
use App\Models\Statistic;
use App\Models\Tab;
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
    public $imageAction = '';

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
    public $buttonComment = false;
    public $tabHome;
    public $tabAway;
    public $scoreTabHome;
    public $scoreTabAway;
    public String $infoMatch = "";

    public int $clickBut = 0;
    public int $clickPenalty = 0;

    public $listGoal = [
        'GOOOOAAL !',
        'BUUUUT !!!',
        'GOAL GOAL GOAL !!',
        'ET C\'EST LE BUUUUUUUUUTTTT'
    ];
    public $mitempsJoueurs = [
        'Les joueurs rentrent aux vestiaires',
        'Tout le monde à la buv... euuuh aux vestiaires !'
    ];
    public $goalsText = [
        "Patate au ras du poteau !!!",
        "Une grosse frappe de mule qui finit au fond des filets !",
        "Une frappe de toute beauté.",
        "Il a nettoyé la lucarne !",
        "Plat du pied sécurité",
        "Le 1 contre 1 est remporté par le joueur et ca fait ficelle !",
        "Une séquence de jeu magnifique qui se solde par un but",
        "Quel lob !!!",
        "Une frappe écrasée qui rentre tout de même...",

    ];
    public $cardsText = [
        "Il l'a fauché comme un lapin en plein vol !",
        "Celui là n'est pas venu faire le voyage pour rien !",

    ];
    public $occasionsText = [
        "Une frappe trop enlevée qui passe au dessus du cadre, dommage...",
        "Sa frappe est trop écrasée pour inquiéter le gardien",
        "Le face à face est remporté par le gardien !!!",
        "Une frappe bien partie mais non cadrée",
        "Une belle séquence de possession qui ne se concrétise pas..."
    ];
    public $penaltysScoreText = [
        "La panenka est tentée et réussie ! Quel geste mes amis !!!",
        "Le gardien était sur la trajectoire mais le ballon fini sa course dans les filets",
        "Pénalty transformé ! Contre pied parfait",
    ];
    public $penaltysNoScoreText = [
        "La panenka est tentée et... manquée !",
        "Pénalty arrêté par le gardien ! Superbe arrêt ! Il qui est parti du bon côté",
        "Le pénalty a heurté un montant !",
        "Le joueur sélance pour tirer le pénalty... HORS CADRE..."
    ];
    public $faultsText = [
        "Faute du défenseur, PÉNALTY !",
        "MAAAIIIIINNN dans la surface, PÉNALTY",
        "FAUTE !!! Pénalty !",
        "Faute ! Coup-franc !",
    ];
    public $cfText = [
        "Coup franc direeeect !!!!",
        "Beau coup-franc en 2 temps",
        "Un centre qui est concrétisé dans la surface",
    ];
    public $gameFactsText = [
        "Corner !",
        "6 mètres",
        "Touche",
        "L'équipe prend le jeu à son compte.",
    ];

    public function mount()
    {
        $this->dateMatch = $this->match->date_match;

        if (now()->diffInMinutes($this->match->debut_match_reel, false) < -240) {
            $this->match->live = "finDeMatch";
            $this->textInfo = "Commentaires fermés";
            $this->match->save();

            $this->textInfo = "Commentaires fermés";
        }

        if ($this->match->live == "finDeMatch") {
            $this->textInfo = "Commentaires fermés";
        }

        $this->minuteCom = $this->minute;

        foreach ($this->commentsMatch as $comment) {
            $this->imageAction = $comment->images;
        }

        $this->miseAJourCom();
        $this->miseAJourPenalty();
        $this->countVisitor();
        $this->miseAjourTemps();
    }

    public function hydrate()
    {

        if (now()->diffInMinutes($this->match->debut_match_reel, false) < -240) {
            $this->match->live = "finDeMatch";
            $this->textInfo = "Commentaires fermés";
            $this->match->save();

            $this->textInfo = "Commentaires fermés";
        }

        if ($this->match->live == "finDeMatch") {
            $this->textInfo = "Commentaires fermés";
        }

        // $this->minuteCom = $this->minute;

        foreach ($this->commentsMatch as $comment) {
            $this->imageAction = $comment->images;
        }

        $this->miseAJourCom();
        $this->miseAJourPenalty();
        $this->countVisitor();
        $this->miseAjourTemps();
    }

    public function menuBut()
    {
        if ($this->clickBut == 1) $this->clickBut = 0;
        if ($this->clickBut == 0) $this->clickBut = 1;
    }

    public function clickButtonComment()
    {

        if ($this->buttonComment == false) {
            $this->buttonComment = true;
        } else {
            $this->buttonComment = false;
        }
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

    public function miseAJourPenalty()
    {

        $this->tabHome = Tab::where('match_id', $this->match->id)->where('club_id', $this->match->homeClub->id)->get();
        $this->tabAway = Tab::where('match_id', $this->match->id)->where('club_id', $this->match->awayClub->id)->get();
        $this->scoreTabHome = Tab::where('score', 1)->where('match_id', $this->match->id)->where('club_id', $this->match->homeClub->id)->count();
        $this->scoreTabAway = Tab::where('score', 1)->where('match_id', $this->match->id)->where('club_id', $this->match->awayClub->id)->count();

        if (count($this->tabHome) <= 5 && count($this->tabAway) <= 5) {
            if ((5 - count($this->tabHome) + $this->scoreTabHome < $this->scoreTabAway) || (5 - count($this->tabAway) + $this->scoreTabAway < $this->scoreTabHome)) {
                $this->match->live = "finDeMatch";
                $this->match->save();
            }
        } elseif (count($this->tabHome) > 5 && count($this->tabAway) > 5 && count($this->tabHome) == count($this->tabAway)) {
            if ($this->scoreTabHome > $this->scoreTabAway || $this->scoreTabAway > $this->scoreTabHome) {
                $this->match->live = "finDeMatch";
                $this->match->save();
            }
        }
    }

    public function miseAjourTemps()
    {

        $this->minute = now()->diffInMinutes($this->match->debut_match_reel);

        if ($this->match->live == "mitemps") {
            $this->minute = "MT";
        }

        if ($this->match->debut_match_reel < $this->match->debut_sde_mt) {
            $this->minute = 45 + now()->diffInMinutes($this->match->debut_sde_mt);
        }

        if ($this->match->debut_debut_sde_mt < $this->match->debut_prolongations) {
            $this->minute = 90 + now()->diffInMinutes($this->match->debut_prolongations);
        }

        if ($this->match->debut_prolongations < $this->match->debut_sde_mt_prolong) {
            $this->minute = 105 + now()->diffInMinutes($this->match->debut_sde_mt_prolong);
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

    //incrémentation, décrémentation du score

    public function incrementHomeScore()
    {
        $this->home_score += 1;
        $this->match->home_score += 1;
        $this->match->save();
    }

    public function incrementAwayScore()
    {
        $this->away_score += 1;
        $this->match->away_score += 1;
        $this->match->save();
    }

    public function decrementHomeScore()
    {
        if ($this->home_score > 0) {
            $this->home_score -= 1;
            $this->match->home_score -= 1;
            $this->match->save();
        }
    }
    public function decrementAwayScore()
    {
        if ($this->away_score > 0) {
            $this->away_score -= 1;
            $this->match->away_score -= 1;
            $this->match->save();
        }
    }

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

            // session()->flash('success', 'Tu es le commentateur de ce match ! 😎');
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

    public function prolongations()
    {
        $commentData['type_comments'] = "Début des prolongations";
        $commentData['minute'] = 90;
        $commentData['team_action'] = 'match';
        $commentData['commentator_id'] = $this->match->commentateur->id;
        // $commentData['images'] = "images/gifs/start.gif";

        $comment = Commentaire::create($commentData);
        $comment->save();

        $this->match->live = "prolongations1";
        $this->match->debut_prolongations = now();
        $this->match->save();

        return redirect()->to('matches/' . $this->match->id);
    }

    public function miTempsProlongations()
    {
        $commentData['type_comments'] = "Mi-temps des prolongations";
        $commentData['minute'] = 105;
        $commentData['team_action'] = 'match';
        $commentData['commentator_id'] = $this->match->commentateur->id;
        // $commentData['images'] = "images/gifs/start.gif";

        $comment = Commentaire::create($commentData);
        $comment->save();

        $this->match->live = "MTProlongations";
        $this->match->save();

        return redirect()->to('matches/' . $this->match->id);
    }

    public function secondeProlongation()
    {
        $commentData['type_comments'] = "Reprise des prolongations";
        $commentData['minute'] = 105;
        $commentData['team_action'] = 'match';
        $commentData['commentator_id'] = $this->match->commentateur->id;
        // $commentData['images'] = "images/gifs/start.gif";

        $comment = Commentaire::create($commentData);
        $comment->save();

        $this->match->live = "prolongations2";
        $this->match->debut_sde_mt_prolong = now();
        $this->match->save();

        return redirect()->to('matches/' . $this->match->id);
    }

    public function finProlongations()
    {
        $commentData['type_comments'] = "Fin des prolongations";
        $commentData['minute'] = 120;
        $commentData['team_action'] = 'match';
        $commentData['commentator_id'] = $this->match->commentateur->id;
        // $commentData['images'] = "images/gifs/start.gif";

        $comment = Commentaire::create($commentData);
        $comment->save();

        $this->match->live = "finProlongations";
        $this->match->fin_prolongations = now();

        $this->match->save();

        return redirect()->to('matches/' . $this->match->id);
    }

    public function tirsAuBut()
    {
        $commentData['type_comments'] = "La séance des tirs aux but va commencer.";
        $commentData['minute'] = 120;
        $commentData['team_action'] = 'match';
        $commentData['commentator_id'] = $this->match->commentateur->id;
        // $commentData['images'] = "images/gifs/start.gif";

        $comment = Commentaire::create($commentData);
        $comment->save();

        $this->match->live = "tab";
        $this->match->save();

        return redirect()->to('matches/' . $this->match->id);
    }

    public function timeZero()
    {

        // dd(now());
        if ($this->dateMatch->diffInMinutes(now(), false) > -30) {


            $commentData['type_comments'] = "Début du match ! 🤩";
            $commentData['minute'] = 0;
            $commentData['team_action'] = 'match';
            $commentData['commentator_id'] = $this->match->commentateur->id;
            $commentData['images'] = "images/gifs/start.gif";

            $comment = Commentaire::create($commentData);

            if ($comment) {

                $this->match->live = "debut"; // modification colonne live
                $this->match->debut_match_reel = now();
                /* demarrage du score */
                $this->home_score = 0;
                $this->match->home_score = 0;

                $this->away_score = 0;
                $this->match->away_score = 0;

                /* sauvegarde du match et du commentaire */
                $this->match->save();
                $comment->save();

                // /*creation second com PUB */
                // $commentData2['type_comments'] = 'Publicité';
                // $commentData2['minute'] = 0;
                // $commentData2['team_action'] = 'match';
                // $commentData2['comments'] = $this->pub;
                // $commentData2['commentator_id'] = $this->match->commentateur->id;

                // $comment2 = Commentaire::create($commentData2);
                // $comment2->save();

                // session()->flash('success', 'Bon Match ! ⚽⚽⚽');
                return redirect()->to('matches/' . $this->match->id);
            }
        } else {
            // session()->flash('warning', "Reviens 30 minutes avant le coup d'envoi");
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
        $commentData['images'] = "images/gifs/lonely-goalie.gif";



        $comment = Commentaire::create($commentData);

        if ($comment) {

            $comment->save();

            // session()->flash('success', 'Mi-temps ! Repos bien mérité... Rendez-vous dans 15 minutes 🍻');
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

            $this->match->debut_sde_mt = now();
            $this->match->save();
            $comment->save();
            $this->commentsMatch =  $this->match->commentaires()->orderBy('minute', 'desc')->orderBy('updated_at', 'desc')->get();
            // session()->flash('success', 'C\'est reparti !! 😉');
            return redirect()->to('matches/' . $this->match->id);
        }
    }

    public function timeFinDuMatch()
    {

        $this->match->live = "finDeMatch";
        $this->match->fin_match_reel = now();
        $this->nbrFavoris = 0;

        $commentData['type_comments'] = "FIN DU MATCH !!!";
        $commentData['minute'] = 90;
        $commentData['team_action'] = 'match';
        $commentData['commentator_id'] = $this->match->commentateur->id;

        $comment = Commentaire::create($commentData);

        if ($comment) {

            $this->textInfo = "Commentaires fermés";

            $this->match->save();
            $comment->save();
            $this->commentsMatch =  $this->match->commentaires()->orderBy('minute', 'desc')->orderBy('updated_at', 'desc')->get();
            // session()->flash('success', '😍 MERCI MERCI MERCI 😍');
            return redirect()->to('matches/' . $this->match->id);
        }
    }

    // protected $rules = [
    //     'type_comments' => 'required|string',
    //     'minute' => 'required|string',
    //     'team_action' => 'required|string',
    //     // 'file' => 'nullable | mimes:jpeg,jpg,png,gif,mp4,mov,ogg,qt,m3u8,ts,3gp|max:10240'
    // ];

    public function saveComment()
    {

        // if ($this->dateMatch->diffInMinutes(now(), false) >= 0 && $this->match->live == "debut" || $this->match->live == "repriseMT") {

        $statData2['action'] = '';

        $this->validate([
            'type_comments' => 'required|string',
            'minuteCom' => 'required|integer|between:1,120',
            'team_action' => 'nullable|string',
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
        } elseif ($this->type_comments == "arret") {
            $commentData['type_comments'] = "Le live en direct";
            $commentData['comments'] = "Arrêt du gardien";
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
            if ($this->type_comments == "but" || $this->type_comments == "carton") {
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
            }

            $this->commentsMatch = $this->match->commentaires()->orderBy('minute', 'desc')->orderBy('updated_at', 'desc')->get();
            // session()->flash('success', 'Commentaire bien pris en compte ! 💪');
            return redirect()->to('matches/' . $this->match->id);
        }
        // } else {
        //     session()->flash('warning', "Il n'est pas possible de commenter maintenant");
        //     return redirect()->to('matches/' . $this->match->id);
        // }
    }

    public function tabMarque(Club $club)
    {
        // dd($this->tabHome);

        $tab['score'] = 1;
        $tab['match_id'] = $this->match->id;
        $tab['club_id'] = $club->id;


        if ($club->id == $this->match->homeClub->id) {
            $tab['number'] = count($this->tabHome) + 1;
            $tabCreate = Tab::create($tab);
            $tabCreate->save();
            $this->tabHome = Tab::where('match_id', $this->match->id)->where('club_id', $this->match->homeClub->id)->get();
        }

        if ($club->id == $this->match->awayClub->id) {
            $tab['number'] = count($this->tabAway) + 1;
            $tabCreate = Tab::create($tab);
            $tabCreate->save();
            $this->tabAway = Tab::where('match_id', $this->match->id)->where('club_id', $this->match->awayClub->id)->get();
        }

        $this->miseAJourPenalty();
    }

    public function tabLoupe(Club $club)
    {
        $tab['score'] = 0;
        $tab['match_id'] = $this->match->id;
        $tab['club_id'] = $club->id;


        if ($club->id == $this->match->homeClub->id) {
            $tab['number'] = count($this->tabHome) + 1;
            $tabCreate = Tab::create($tab);
            $tabCreate->save();
            $this->tabHome = Tab::where('match_id', $this->match->id)->where('club_id', $this->match->homeClub->id)->get();
        }

        if ($club->id == $this->match->awayClub->id) {
            $tab['number'] = count($this->tabAway) + 1;
            $tabCreate = Tab::create($tab);
            $tabCreate->save();
            $this->tabAway = Tab::where('match_id', $this->match->id)->where('club_id', $this->match->awayClub->id)->get();
        }

        $this->miseAJourPenalty();
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
