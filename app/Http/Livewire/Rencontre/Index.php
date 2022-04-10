<?php

namespace App\Http\Livewire\Rencontre;

use App\Models\Club;
use App\Models\Commentaire;
use App\Models\Commentator;
use App\Models\Composition;
use App\Models\Counter;
use App\Models\Gallery;
use App\Models\Player;
use App\Models\Reaction;
use App\Models\Statistic;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithFileUploads;

    public $match, $minute, $home_score, $away_score, $team_choisie, $action_choisie, $player1, $player2, $tps_de_jeu, $name_of_periode = '', $periode, $comments, $type_de_but;
    public $new_date_match, $home_score_mis_a_jour, $away_score_mis_a_jour, $visitors, $variable_tps_pour_commenter, $commentaires_match_ouverts = false;
    public $commentateur, $homeCompo, $awayCompo, $prenom, $nom_de_famille, $joueur_choisi, $lieu;

    //variables d'affichage
    public $open_menu_comment = false, $open_delete_comment = false, $commentIdToDelete = false, $open_match = true, $open_infos = false, $open_compos = false, $open_share = false;
    public $selected_compo_id, $open_galerie, $open_store_photo = false, $open_create_player = false, $corriger_le_score = false, $open_store_lieu = false;

    //Galerie
    public $photos, $photo_match;

    public function mount($match)
    {
        $this->match = $match;
        $this->miseAJourScore();
        $this->miseAjourTemps();
        $this->commentairesMatchAuto();
        $this->countVisitor();
        $this->TexteBoutonPeriodeMatch();
        $this->clotureMatchAuto();
        $this->commentateurDuMatch();
        $this->list_commentaires();
        $this->periodeActuelle();
        $this->homeCompo();
        $this->awayCompo();
        $this->storeCompos();
        // dd($this->match->homeClub->composition($this->match->id, $this->match->homeClub->id));
    }

    public function hydrate()
    {
        $this->miseAjourTemps();
        $this->miseAJourScore();
        $this->countVisitor();
        $this->TexteBoutonPeriodeMatch();
        $this->clotureMatchAuto();
        $this->commentateurDuMatch();
        $this->list_commentaires();
        $this->periodeActuelle();
        $this->homeCompo();
        $this->awayCompo();
    }

    public function openTab($tab)
    {
        if ($tab == 'match') {
            $this->open_match = true;
            $this->open_compos = false;
            $this->open_infos = false;
            $this->open_share = false;
            $this->open_galerie = false;
        }

        if ($tab == 'compos') {
            $this->open_match = false;
            $this->open_compos = true;
            $this->open_infos = false;
            $this->open_share = false;
            $this->open_galerie = false;
        }

        if ($tab == 'infos') {
            $this->open_match = false;
            $this->open_compos = false;
            $this->open_infos = true;
            $this->open_share = false;
            $this->open_galerie = false;
        }

        if ($tab == 'share') {
            $this->open_match = false;
            $this->open_compos = false;
            $this->open_infos = false;
            $this->open_share = true;
            $this->open_galerie = false;
        }
        if ($tab == 'galerie') {
            $this->open_match = false;
            $this->open_compos = false;
            $this->open_infos = false;
            $this->open_share = false;
            $this->open_galerie = true;
            $this->photos = Gallery::where('match_id', $this->match->id)->get();
        }
    }

    public function incrementScore($team)
    {
        $this->{$team . '_score'} += 1;
        $this->match->{$team . '_score'} += 1;
        $this->match->save();
    }

    public function decrementScore($team)
    {
        if ($this->match->{$team . '_score'} > 0) {
            $this->{$team . '_score'} -= 1;
            $this->match->{$team . '_score'} -= 1;
            $this->match->save();
        }
    }

    public function storeScore()
    {
        $this->corriger_le_score = false;
        // $this->match->live = "finDeMatch";
        // $this->match->validate_score = true;
        $this->match->save();
    }

    public function storeCompos()
    {
        // dd($this->awayCompo);
        for ($i = 1; $i <= 16; $i++) {
            if ($this->homeCompo->count() < 16) {
                Composition::create([
                    'rencontre_id' => $this->match->id,
                    'player_id' => $i,
                    'club_id' => $this->match->homeClub->id
                ]);
            }
            if ($this->awayCompo->count() < 16) {
                Composition::create([
                    'rencontre_id' => $this->match->id,
                    'player_id' => $i,
                    'club_id' => $this->match->awayClub->id
                ]);
            }
        }
    }

    public function homeCompo()
    {
        $this->homeCompo = Composition::where('rencontre_id', $this->match->id)
            ->where('club_id', $this->match->home_team_id)
            ->get();
    }

    public function awayCompo()
    {
        $this->awayCompo = Composition::where('rencontre_id', $this->match->id)
            ->where('club_id', $this->match->away_team_id)
            ->get();
    }

    public function selectedCompoId($compo_id)
    {
        $this->selected_compo_id = $compo_id;
        $this->open_create_player = null;
        $this->joueur_choisi = null;
    }

    public function setCompoIdToNull()
    {
        $this->selected_compo_id = null;
    }

    public function corrigerLeScore()
    {
        $this->corriger_le_score = !$this->corriger_le_score;
    }

    public function list_commentaires()
    {
        $this->comments = $this->match->commentaires()->orderBy('minute', 'desc')->orderBy('updated_at', 'desc')->get();
    }

    public function openStoreLieu()
    {
        $this->open_store_lieu = true;
    }

    public function storeLieu()
    {
        $this->open_store_lieu = false;
        $this->match->location = ucfirst($this->lieu);
        $this->match->save();
    }

    public function TexteBoutonPeriodeMatch()
    {
        if ($this->match->live != "finDeMatch") {
            if ($this->match->live == "attente") {
                $this->variable_tps_pour_commenter = true;
                $this->name_of_periode = "Le match commence";
            } elseif ($this->match->live == "debut" && now()->diffInMinutes($this->match->debut_match_reel) > 40) {
                $this->variable_tps_pour_commenter
                    = true;
                $this->name_of_periode = "Mi-temps";
            } elseif ($this->match->live == "mitemps") {
                $this->variable_tps_pour_commenter = true;
                $this->name_of_periode = "C'est la reprise";
            } elseif ($this->match->live == "repriseMT" && now()->diffInMinutes($this->match->debut_match_reel) > 100) {
                $this->variable_tps_pour_commenter = true;
                $this->name_of_periode = "Fin du match";
            } else {
                $this->variable_tps_pour_commenter = false;
            }
        }
    }

    public function periodeActuelle()
    {
        if ($this->match->live == "debut") {
            $this->periode = 1;
        } elseif ($this->match->live == "repriseMT") {
            $this->periode = 2;
        }
    }

    public function commentairesMatchAuto()
    {

        $this->home_score = $this->match->home_score;
        $this->away_score = $this->match->away_score;

        $commentateur = Commentator::firstOrCreate([
            'rencontre_id' => $this->match->id,
            'user_id' => 0,
        ]);

        $commentaire_data = [
            'team_action' => 'match',
            'rencontre_id' => $this->match->id,
            'commentator_id' => $commentateur->id,
            'type_comments' => $this->periode,
        ];

        $commentaire_data['comments'] = '1<sup>ère</sup> période';
        $commentaire_data['type_comments'] = 1;
        Commentaire::firstOrCreate($commentaire_data);

        $commentaire_data['comments'] = '2<sup>ème</sup> période';
        $commentaire_data['type_comments'] = 2;
        Commentaire::firstOrCreate($commentaire_data);

        $this->match->save();
    }

    public function validateScoreMatch()
    {
        $this->match->validate_score = 1;
        $this->match->validate_by = Auth::id();
        $this->match->save();
    }

    public function miseAJourScore()
    {
        $this->home_score = $this->match->home_score;
        $this->away_score = $this->match->away_score;
    }

    public function devenirCommentateur()
    {
        Commentator::create([
            'user_id' => Auth::id(),
            'rencontre_id' => $this->match->id,
        ]);

        $this->commentateurDuMatch();
    }

    public function miseAJourPeriodeDuMatch($start = null)
    {
        if ($start) {
            $this->match->debut_match_reel = $this->match->date_match;
        }

        $commentateur = Commentator::firstOrCreate([
            'rencontre_id' => $this->match->id,
            'user_id' => Auth::id(),
        ]);

        $commentaire_data = [
            'team_action' => 'match',
            'rencontre_id' => $this->match->id,
            'commentator_id' => $commentateur->id,
            'type_comments' => $this->periode,
        ];

        if ($this->match->live == "attente") {

            $this->match->home_score = 0;
            $this->match->away_score = 0;
            $this->home_score = 0;
            $this->away_score = 0;

            $this->match->live = 'debut';
        } elseif ($this->match->live == "debut") {

            $this->match->live = 'mitemps';
        } elseif ($this->match->live == "mitemps") {

            // $commentaire_data['comments'] = '2<sup>ème</sup> période';
            // $commentaire_data['type_comments'] = 2;
            // Commentaire::create($commentaire_data);

            $this->match->live = 'repriseMT';
        } elseif ($this->match->live == "repriseMT") {
            $this->match->validate_score = 1;
            $this->match->live = 'finDeMatch';

            $commentaire_data = [
                'team_action' => 'match',
                'rencontre_id' => $this->match->id,
                'commentator_id' => $commentateur->id,
            ];

            $commentaire_data['comments'] = 'Fin du match';
            $commentaire_data['type_comments'] = 3;
            Commentaire::firstOrCreate($commentaire_data);
        }

        $this->match->save();

        $this->open_menu_comment = false;
        $this->list_commentaires();
    }

    public function miseAjourTemps()
    {
        $debut_de_match = now()->diffInMinutes($this->match->debut_match_reel);
        // dd($debut_de_match);
        if ($this->match->live == "debut") {
            $this->minute = $debut_de_match;
            if ($this->minute >= 45) {
                $this->minute = "45+";
            }
        }

        if ($this->match->live == "mitemps") {
            $this->minute = "MT";
        }

        if ($this->match->live == "repriseMT") {
            $this->minute =  $debut_de_match - 15;
            if ($this->minute >= 90) {
                $this->minute = "90+";
            }
            if ($this->minute <= 45) {
                $this->minute = 45;
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
    }

    public function clotureMatchAuto()
    {
        // dd(now()->diffInMinutes($this->match->debut_match_reel));
        if (now()->diffInMinutes($this->match->date_match) > 60 && $this->match->live == "attente") {
            $this->commentaires_match_ouverts = false;
        } elseif ($this->match->live == "finDeMatch") {
            $this->commentaires_match_ouverts = false;
        } else {
            $this->commentaires_match_ouverts = true;
        }

        if (now()->diffInMinutes($this->match->debut_match_reel) > 120 && $this->match->live != "finDeMatch") {
            $this->match->live = 'finDeMatch';

            $commentateur = Commentator::firstOrCreate([
                'rencontre_id' => $this->match->id,
                'user_id' => 0,
            ]);

            $commentaire_data = [
                'team_action' => 'match',
                'rencontre_id' => $this->match->id,
                'commentator_id' => $commentateur->id,
                'type_comments' => $this->periode,
            ];

            $commentaire_data['comments'] = 'Fin du match automatique';
            $commentaire_data['type_comments'] = 3;
            Commentaire::firstOrCreate($commentaire_data);

            $this->match->save();
        }
    }

    public function scoreValide()
    {
        $this->match->validate_score = 1;
        $this->match->save();
    }

    public function saveNewDatetime($start_match = null)
    {
        if ($start_match == 'start_match') {
            $this->match->debut_match_reel = $this->new_date_match;
            $this->miseAJourPeriodeDuMatch();
        } else {
            $this->match->date_match = $this->new_date_match;
        }

        $this->match->save();
    }

    public function openMenuComment()
    {
        $this->open_menu_comment = !$this->open_menu_comment;
        $this->team_choisie = null;
        $this->action_choisie = null;
        $this->periode = null;
        $this->tps_de_jeu = $this->minute;
    }

    public function commentateurDuMatch()
    {
        $this->commentateur = Commentator::where('user_id', '!=', 0)
            ->where('rencontre_id', $this->match->id)
            ->first();
    }

    public function setTeamChoisie($team)
    {
        $this->team_choisie = $team;
    }

    public function setActionChoisie($action)
    {
        $this->action_choisie = $action;
    }

    public function openDeleteComment($comment_id)
    {
        $this->commentIdToDelete = $comment_id;
        $this->open_delete_comment = !$this->open_delete_comment;
    }

    public function setCommentIdToDeleteToNull()
    {
        $this->commentIdToDelete = null;
    }

    public function storeAction($type_action)
    {

        // dd($this->type_de_but);

        $commentateur = Commentator::firstOrCreate([
            'rencontre_id' => $this->match->id,
            'user_id' => Auth::id(),
        ]);

        $commentaire_data = [
            'commentator_id' => $commentateur->id,
            'rencontre_id' => $this->match->id,
            'type_action' => $type_action,
            'team_action' => $this->team_choisie,
            'minute' => $this->tps_de_jeu,
            'type_comments' => $this->periode
        ];

        if ($type_action != "substitute") {
            if ($type_action == 'goal') {
                $commentaire_data['buteur_id'] = $this->player1;
                if ($this->type_de_but) {
                    $commentaire_data['comments'] = $this->type_de_but;
                }
                $commentaire_data['icon'] = 'images/but.png';

                if ($this->commentaires_match_ouverts) {
                    $this->{$this->team_choisie . '_score'} += 1;
                    $this->match->{$this->team_choisie . '_score'} += 1;
                }
                if ($this->team_choisie == "home" && !$this->match->away_score) {
                    $this->match->away_score = 0;
                } elseif ($this->team_choisie == "away" && !$this->match->home_score) {
                    $this->match->home_score = 0;
                }

                if ($this->player2 && $type_action == 'goal' && $this->type_de_but != 'pénalty' && $this->type_de_but != 'CF direct') {
                    $commentaire_data['passeur_id'] = $this->player2;
                    $commentaire = Commentaire::create($commentaire_data);


                    Statistic::create([
                        'action' => 'passeD',
                        'commentaire_id' => $commentaire->id,
                        'player_id' => $this->player2,
                    ]);
                } else {
                    $commentaire = Commentaire::create($commentaire_data);
                }

                $this->match->save();
            }

            if ($type_action == 'yellow_card') {
                // $commentaire_data['comments'] = 'Carton jaune';
                $commentaire_data['yellow_card_id'] = $this->player1;
                $commentaire_data['icon'] = 'images/yellow-card.png';
                $commentaire = Commentaire::create($commentaire_data);
            }
            if ($type_action == 'red_card') {
                // $commentaire_data['comments'] = 'Carton rouge';
                $commentaire_data['red_card_id'] = $this->player1;
                $commentaire_data['icon'] = 'images/red-card.png';
                $commentaire = Commentaire::create($commentaire_data);
            }

            Statistic::create([
                'action' => $type_action,
                'commentaire_id' => $commentaire->id,
                'player_id' => $this->player1,

            ]);

            Auth::user()->nb_commentaires += 1;
            Auth::user()->save();
            $this->list_commentaires();
        }

        if ($type_action == "substitute") {
            $commentaire_data['out_substitute_id'] = $this->player1;
            $commentaire_data['in_substitute_id'] = $this->player2;
            // $commentaire_data['comments'] = 'Remplacement';
            $commentaire_data['icon'] = 'images/substitute.png';
            $commentaire = Commentaire::create($commentaire_data);
        }

        $this->openMenuComment();
        $this->player1 = null;
        $this->player2 = null;
        $this->type_de_but = null;
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

        $this->visitors = Counter::where('page-address', $this->match->id)->where('updated_at', '>', now()->subMinutes(15))->count();
    }

    public function supprimerCommentaire($commentaire_id, $team)
    {
        $commentaires = Commentaire::where('id', $commentaire_id)->get();
        foreach ($commentaires as $commentaire) {
            if ($commentaire->type_action == 'goal' && $this->commentaires_match_ouverts) {
                $this->{$team . '_score'} -= 1;
                $this->match->{$team . '_score'} -= 1;
                $this->match->save();
            }

            $commentaire->delete();
        }
        if ($this->commentaires_match_ouverts) {
            $statistics = Statistic::where('commentaire_id', $commentaire_id)->get();
            foreach ($statistics as $statistic) {
                $statistic->delete();
            }
        }

        $this->list_commentaires();
    }

    public function openStorePhoto()
    {
        $this->open_store_photo = !$this->open_store_photo;
    }

    public function closeStorePhoto()
    {
        $this->open_store_photo = false;
        $this->photo_match = null;
    }

    public function storePhoto($match_id)
    {

        $this->validate(
            [
                'photo_match' => 'mimes:jpeg,jpg,png,gif|max:10240',
            ],
            [
                'photo_match.mimes' => 'Format non conforme',
            ]
        );

        $path = $this->photo_match->store('photos_match');
        $photo['images'] = $path;
        $photo['match_id'] = $match_id;
        $photoSave = Gallery::create($photo);

        // dd($photoSave);
        $photoSave->save();

        // session()->flash('success', 'Photo enregistrée');

        $this->store_photo_match = null;
        $this->photos = Gallery::where('match_id', $this->match->id)->get();
        $this->closeStorePhoto();
    }

    public function openCreatePlayer()
    {
        $this->open_create_player = !$this->open_create_player;
    }

    public function storePlayer($club_id, $compo_id)
    {
        $club = Club::find($club_id);

        if ($this->joueur_choisi) {
            $compo = Composition::find($compo_id);
            $compo->player_id = $this->joueur_choisi;
            $compo->save();
        } else {
            $player = Player::create([
                'last_name' => strtoupper($this->nom_de_famille),
                'first_name' => ucfirst($this->prenom),
                'club_id' => $club_id,
                'created_by' => Auth::id(),
            ]);

            $compo = Composition::find($compo_id);
            $compo->player_id = $player->id;
            $compo->save();
        }


        $this->selected_compo_id = null;
        $this->nom_de_famille = null;
        $this->prenom = null;
        $this->homeCompo();
        $this->awayCompo();
    }

    public function render()
    {
        return view('livewire.rencontre.index', [
            'reactions' => Reaction::all(),
            'commentateurs' => Commentator::where('rencontre_id', $this->match->id)
                ->where('user_id', '!=', 0)
                ->get(),
        ]);
    }
}
