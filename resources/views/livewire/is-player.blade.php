<div>
   <p>êtes vous un joueur ?</p>
   @foreach($players as $player)
    {{ $player->first_name }} {{ $player->last_name }}
   @endforeach
</div>
