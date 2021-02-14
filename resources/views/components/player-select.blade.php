<div>
<label for="player">Es tu un de ces joueurs ?<span class="text-xs">(optionnel)</span></label>
    <input class="inputForm focus:outline-none focus:shadow-outline w-full my-1" value="{{ Auth::user()->player ? Auth::user()->player->first_name .' '. Auth::user()->player->last_name: '' }}" list="players" type="search" name="player" id="player" :value="old('player')" autocomplete="player">
    <datalist id="players">
        @foreach ($players as $player)
        <option value="{{ $player->last_name }}">{{ $player->last_name }}</option>
        @endforeach
    </datalist>
</div>