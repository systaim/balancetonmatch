<div>
    <p>Un nouveau joueur a été créé pour le club <span class="font-bold">{{ $player['club_id'] }}</span></p>
</div>
<div>
    <p>Voici les informations envoyées par 
        <span class="capitalize">{{ $player['user_first_name'] }}</span> <span class="uppercase">{{ $player['user_last_name'] }}</span> ({{ $player['user_id'] }}) : </p>
</div>
<div>
    <p>Nom de famille : {{ $player['last_name'] }}</p>
    <p>Prénom : {{ $player['first_name'] }}</p>
    <p>Date de naissance : {{ $player['date_of_birth'] }}</p>
    <p>Position : {{ $player['position'] }}</p>
    <p></p>
</div>