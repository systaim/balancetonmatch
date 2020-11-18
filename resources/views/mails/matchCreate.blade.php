<h2>Match créé</h2>

<div>
    <p>Voici les informations envoyées par 
        <span class="capitalize">{{ $match['user_first_name'] }}</span> <span class="uppercase">{{ $match['user_last_name'] }}</span> ({{ $match['user_id'] }}) : </p>
</div>

<div class="flex justify-evenly">
    <p>{{ $match['homeTeam'] }}</p>
    <p>VS</p>
    <p>{{ $match['awayTeam'] }}</p>
</div>
