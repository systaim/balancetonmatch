<div>
    <label for="prefer_team">Mon club</label>
    <input class="inputForm focus:outline-none focus:shadow-outline w-full my-1" list="clubs" type="search" name="prefer_team" id="prefer_team" :value="old('prefer_team')" autocomplete="prefer_team">
    <datalist id="clubs">
        @foreach ($clubs as $club)
        <option value="{{ $club->id }}">{{ $club->name }}</option>
        @endforeach
    </datalist>
</div>