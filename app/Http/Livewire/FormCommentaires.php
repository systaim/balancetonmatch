<?php

namespace App\Http\Livewire;

use App\Models\Club;
use App\Models\Commentaire;
use App\Models\Commentator;
use App\Models\Counter;
use App\Models\Player;
use App\Models\Statistic;
use App\Models\Tab;
use App\Models\Reaction;
use App\Models\User;
use App\Notifications\but;
use App\Notifications\matchBegin;
use App\Notifications\matchEnd;
use Illuminate\Http\Request;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\RequiredIf;
use Livewire\WithFileUploads;

use function App\Models\favorismatches;

class FormCommentaires extends Component
{

    use WithFileUploads;

    // Variables initailisées dans MatchContoller@show 
    public $commentator;
    public $match;
    public $commentsMatch;
    public $nbrFavoris;
    public $favorimatch;

    // Variables donnant accès aux colonnes de la table match
    public $type_comments;
    public $type_but = "";
    public $type_carton = "";
    public $type_actionMatch = "";
    public $minute;
    public $team_action = '';
    public $imageAction = '';
    public $minuteMatch;
    public $commentPerso = "";
    public $minuteCom;
    public $player;
    public $home_score;
    public $away_score;
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
    public $infoMatch = "";
    public $btnTpsDejeu = false;
    public $minuteModifiee;
    public $btnScore = false;
    public $reactions;
    public $merci = 0;
    public $listeMatchDuCommentateur;
    public $sommeMerci = 0;

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

        $this->reactions = Reaction::all();

        if ($this->match->commentateur) {
            $this->listeMatchDuCommentateur = Commentator::where('user_id', $this->match->commentateur->user->id)->get();

            foreach ($this->listeMatchDuCommentateur as $commentateur) {
                $this->sommeMerci += $commentateur->merci;
            }
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

    public function clickButtonComment()
    {

        if ($this->buttonComment == false) $this->buttonComment = true;
        else $this->buttonComment = false;
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

    public function reaction($emoji, $commentaire)
    {

        DB::table('commentaire_reaction')->insert([
            'commentaire_id' => $commentaire,
            'reaction_id' => $emoji,
            // ['ip-address' => request()->ip()],
        ]);

        $this->miseAJourCom();
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
        $this->commentsMatch = $this->match->commentaires()->with(['statistic', 'reactions'])->orderBy('minute', 'desc')->orderBy('updated_at', 'desc')->get();
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

    public function clickTpsDeJeu()
    {
        if ($this->btnTpsDejeu == false) $this->btnTpsDejeu = true;
        else $this->btnTpsDejeu = false;
    }

    public function corrigerTpsDeJeu()
    {
        $this->minute = $this->minuteModifiee;
        $this->match->tps_de_jeu = $this->minuteModifiee;
        $this->match->save();

        $this->btnTpsDejeu = false;
        $this->miseAjourTemps();
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

    //incrémentation, décrémentation du score

    public function merci()
    {
        // dd(request()->user());
        $this->merci += 1;
        $this->match->commentateur->merci += 1;
        $this->match->commentateur->save();

        $this->sommeMerci += 1;
    }

    public function clickBtnScore()
    {
        if ($this->btnScore == false) $this->btnScore = true;
        else $this->btnScore = false;
    }

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

                foreach ($this->favorimatch as $favori) {
                    $favori->user->notify(new matchBegin($this->match));
                    $favori->save();
                }

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

                session()->flash('success', 'Bon Match ! ⚽⚽⚽');
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
        $commentData['images'] = "images/gifs/lonely-goalie.gif";



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

            $this->match->debut_sde_mt = now();
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

            foreach ($this->favorimatch as $favori) {
                $favori->user->notify(new matchEnd($this->match));
                $favori->save();
            }

            $this->commentsMatch =  $this->match->commentaires()->orderBy('minute', 'desc')->orderBy('updated_at', 'desc')->get();
            session()->flash('success', '😍 MERCI MERCI MERCI 😍');
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
                // $statData['action'] = "yellow_card";
                // $commentData['comments'] = "2e carton jaune";

                // $statData2['action'] = "red_card";
                // $statData2['player_id'] = $this->player;
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

            if ($this->type_comments == "but") {
                foreach ($this->favorimatch as $favori) {
                    $favori->user->notify(new but($this->match));
                    $favori->save();
                }
            }

            $this->commentsMatch = $this->match->commentaires()->orderBy('minute', 'desc')->orderBy('updated_at', 'desc')->get();
            session()->flash('success', 'Commentaire bien pris en compte ! 💪');
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
