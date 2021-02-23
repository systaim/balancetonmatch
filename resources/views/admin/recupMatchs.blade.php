<?php

// $host = 'localhost';
// $user = 'root';   // identifiant utilisateur
// $pswd = 'Q3mkz8yx';   // mot de passe utilisateur
// $dbname = 'comments';

$host = 'db5001503922.hosting-data.io';
$user = 'dbu1205498';   // identifiant utilisateur
$pswd = 'ionQ3mkz8yx!';   // mot de passe utilisateur
$dbname = 'dbs1261525';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pswd);
} catch (PDOException $error) {
    echo $error->getMessage();
    exit;
}

ini_set('user_agent', 'My-Application/2.5');

$re = '/"date">\X+?(\d+) (\S+) (\d+) - (\d+)H(\d+)\X+?"equipe1">\X+?\/logo\/(\d{6})\X+?"equipe2">\X+?\/logo\/(\d{6})/m';
$str = file_get_contents("https://footbretagne.fff.fr/competitions/?id=373170&poule=1&phase=2&type=cp&tab=resultat");
preg_match_all($re, $str, $matches);
// var_dump(count($matches[0]));
// var_dump($matches[1]);


for ($i = 0; $i < count($matches[0]); $i++) {

    switch ($matches[2][0]) {
        case 'janvier':
            $mois = "01";
            break;
        case 'février':
            $mois = "02";
            break;
        case 'mars':
            $mois = "03";
            break;

        default:
            $mois = "00";
            break;
    }
    $date = $matches[3][$i] . '-' . $mois . '-' . $matches[1][$i] . ' ' . $matches[4][$i] . ':' . $matches[5][$i];

    // $homeTeam = $pdo->query("SELECT id FROM clubs
    // WHERE numAffiliation = '{$matches[6][$i]}' ");

    // $awayTeam = $pdo->query("SELECT * FROM clubs
    // WHERE numAffiliation = '{$matches[7][$i]}' ");

    $stm = $pdo->prepare("INSERT INTO comments.matches(live, home_team_id, away_team_id, date_match, competition_id, user_id)
    VALUES(:live,
    (SELECT id FROM clubs
    WHERE numAffiliation =:home_team_id),
    (SELECT id FROM clubs
    WHERE numAffiliation = :away_team_id),
    :date_match,
    :competition_id,
    :user_id)");


    // echo "<pre>";
    // var_dump($matches[6][$i]);
    // var_dump($matches[7][$i]);
    // var_dump($date);
    // echo "</pre>";

    if ($matches[6][$i] && $matches[7][$i] && $date) {

        $stm->execute([
            ':live' => "attente",
            ':home_team_id' => $matches[6][$i],
            ':away_team_id' => $matches[7][$i],
            ':date_match' => $date,
            ':competition_id' => 3,
            ':user_id' => 1,
        ]);
    }
    var_dump($stm->errorCode());
    if ($stm->errorCode() != "00000") {
        var_dump($stm->errorInfo());
        var_dump($matches[6][$i]);
        var_dump($matches[7][$i]);
    };
}
