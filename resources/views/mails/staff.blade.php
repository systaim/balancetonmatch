<div>
    <p>Un nouveau joueur a été créé pour le club <span class="font-bold">{{ $staff['club_id'] }}</span></p>
</div>
<div>
    <p>Voici les informations envoyées par 
        <span class="capitalize">{{ $staff['user_first_name'] }}</span> <span class="uppercase">{{ $staff['user_last_name'] }}</span> ({{ $staff['user_id'] }}) : </p>
</div>
<div>
    <p>Nom de famille : {{ $staff['last_name'] }}</p>
    <p>Prénom : {{ $staff['first_name'] }}</p>
    <p>Poste : {{ $staff['quality'] }}</p>
    <p></p>
</div>