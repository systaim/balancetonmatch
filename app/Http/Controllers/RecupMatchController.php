<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\Rencontre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RecupMatchController extends Controller
{

    function enleveaccents($str)
    {
        $str = htmlentities($str, ENT_NOQUOTES, 'utf-8');
        $str = preg_replace('#&([A-za-z])(?:uml|circ|tilde|acute|grave|cedil|ring);#', '\1', $str);
        $str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str);
        return $str = preg_replace('#&[^;]+;#', '', $str);
    }

    public function getMatches()
    {

        $rencontres = Rencontre::all();
        $total = count($rencontres) + 1;

        DB::update("ALTER TABLE matches AUTO_INCREMENT = $total;");

        ini_set('user_agent', 'My-Application/2.5');

        $re = '/"date">\X+?(\d+) (\S+) (\d+) - (\d+)H(\d+)\X+?"equipe1">\X+?phlogos\/BC(\d{6})\X+?name ">\s+(\X+?)\s{2}\X+?equipe2">\X+?nobold">\s+(\X+?)\s{2}\X+?phlogos\/BC(\d{6})\X+?/m';

        $str = file_get_contents("https://foot22.fff.fr/competitions/?id=385122&poule=3&phase=1&type=ch&tab=calendar");
        preg_match_all($re, $str, $matches);

        // dd($matches[0]);
        for ($i = 0; $i < count($matches[0]); $i++) {

            switch ($matches[2][$i]) {
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
                    $mois = "00";
                    break;
            }
            $date = $matches[3][$i] . '-' . $mois . '-' . $matches[1][$i] . ' ' . $matches[4][$i] . ':' . $matches[5][$i];


            // $stm = $pdo->prepare("INSERT INTO matches(live, slug, home_team_id, away_team_id, date_match, competition_id, region_id, user_id)
            // VALUES(:live,
            // :slug,
            // (SELECT id FROM clubs
            // WHERE numAffiliation = :home_team_id),
            // (SELECT id FROM clubs
            // WHERE numAffiliation = :away_team_id),
            // :date_match,
            // :competition_id,
            // -- :department_id,
            // :region_id,
            // :user_id)");


            $t1 = $this->enleveaccents(str_replace(".", "-", $matches[7][$i]));
            $t11 = strtolower(str_replace(" ", "-", $t1));
            $t2 = $this->enleveaccents(str_replace(".", "-", $matches[8][$i]));
            $t22 = strtolower(str_replace(" ", "-", $t2));

            $home_team = Club::where('numAffiliation', $matches[6][$i])->first();
            $away_team = Club::where('numAffiliation', $matches[9][$i])->first();

            // echo "<pre>";
            // echo($home_team->id ."-". $away_team->id ."|". $date);
            // echo "</pre>";
            // echo "<pre>";

            // echo($matches[2][$i]);
            // echo($t11 . "-vs-" . $t22 . "-" . $matches[1][$i] . "-" . $mois . "-" . $matches[3][$i]);
            // // echo($matches[7][$i]);
            // echo($away_team->id);
            // // echo($matches[8][$i]);
            // echo($date);
            // echo "</pre>";

            Rencontre::upsert(
                [
                    'slug' => $t11 . "-vs-" . $t22 . "-" . $matches[1][$i] . "-" . $mois . "-" . $matches[3][$i],
                    'home_team_id' => $home_team->id,
                    'away_team_id' => $away_team->id,
                    'date_match' => $date,
                    'competition_id' => 2,
                    'division_department_id' => 2,
                    'group_id' => 3,
                    'region_id' => 3,
                    'department_id' => 22,
                    'user_id' => 11,
                ],
                [
                    'home_team_id', 'away_team_id'
                ],
                [
                    'slug', 'home_team_id', 'away_team_id', 'date_match', 'competition_id', 'region_id', 'user_id'
                ]
            );

            // $stm->execute([
            //     ':live' => "attente",
            //     ':slug' => $t11 . "-vs-" . $t22 . "-" . $matches[1][$i] . "-" . $mois . "-" . $matches[3][$i],
            //     ':home_team_id' => $matches[6][$i],
            //     ':away_team_id' => $matches[9][$i],
            //     ':date_match' => $date,
            //     ':competition_id' => 4,
            //     // ':department_id' => 35,
            //     ':region_id' => 3,
            //     ':user_id' => 11,
            // ]);

            // var_dump($stm->errorCode());
            // if ($stm->errorCode() != "00000") {
            //     echo "<pre>";
            //     var_dump($stm->errorInfo());
            //     var_dump($matches[6][$i]);
            //     var_dump($matches[7][$i]);
            //     var_dump($matches[9][$i]);
            //     var_dump($matches[8][$i]);
            //     var_dump($t11 . "-vs-" . $t22 . "-" . $matches[1][$i] . "-" . $mois . "-" . $matches[3][$i]);
            //     echo "</pre>";
            // };
        }
    }
}
