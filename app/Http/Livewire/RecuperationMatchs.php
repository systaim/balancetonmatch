<?php

namespace App\Http\Livewire;

use App\Models\Club;
use App\Models\Rencontre;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;


class RecuperationMatchs extends Component
{
    public $groupe, $division, $region, $departement, $page;

    public function mount($page)
    {
        $this->page = $page;
    }

    public function recuperation()
    {
        $journee = 1;
        $re = '/"date">\X+?(\d+) (\S+) (\d+) - (\d+)H(\d+)\X+?"equipe1">\X+?BC(\d{6})\X+?phlogos\/BC(\d{6})\X+?/m';
        $url = 'https://balancetonmatch.com/recup-matchs/D' . $this->division->id . '-' . $this->groupe->id . '-' . $this->departement->id . '.html';
        $str = file_get_contents($url);
        preg_match_all($re, $str, $matches, PREG_SET_ORDER, 0);

        // dd(count($matches) / 6);
        $table = [];
        foreach ($matches as $key => $match) {
            if ($key % 6 != 0) {
            } elseif ($key != 0 && $key % 6 == 0) {
                $journee++;
            }
            $jour = $match[1];
            $mois = "";
            switch ($match[2]) {
                case 'janvier':
                    $mois = "01";
                    break;
                case 'février':
                    $mois = "02";
                    break;
                case 'mars':
                    $mois = "03";
                    break;
                case 'avril':
                    $mois = "04";
                    break;
                case 'mai':
                    $mois = "05";
                    break;
                case 'juin':
                    $mois = "06";
                    break;
                case 'juillet':
                    $mois = "07";
                    break;
                case 'août':
                    $mois = "08";
                    break;
                case 'septembre':
                    $mois = "09";
                    break;
                case 'octobre':
                    $mois = "10";
                    break;
                case 'novembre':
                    $mois = "11";
                    break;
                case 'décembre':
                    $mois = "12";
                    break;
                default:
                    $mois = "";
                    break;
            }
            $annee = $match[3];
            $heure = $match[4];
            $minute = $match[5];
            $equipe1 = Club::where('numAffiliation', $match[6])->first();
            $equipe2 = Club::where('numAffiliation', $match[7])->first();
            Rencontre::updateOrCreate(
                [
                    'live' => 'attente',
                    'slug' => $equipe1->name . '-vs-' . $equipe2->name . '-' . $jour . '-' . $mois . '-' . $annee,
                    'home_team_id' => $equipe1->id,
                    'away_team_id' => $equipe2->id,
                    'competition_id' => 2,
                    'division_department_id' => $this->division->id,
                    'department_id' => $this->departement->id,
                    'group_id' => $this->groupe->id,
                    'region_id' => $this->region->id,
                    'journee_id' => $journee,
                    'user_id' => Auth::id(),
                ],
                [
                    'date_match' => $annee . '-' . $mois . '-' . $jour . ' ' . $heure . ':' . $minute . ':00',
                ]
            );
        }
        return redirect($this->page);
    }
    public function render()
    {
        return view('livewire.recuperation-matchs');
    }
}