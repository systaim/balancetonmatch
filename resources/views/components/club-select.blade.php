<div>
    <label for="club">Mon club</label>
    <input class="inputForm focus:outline-none focus:shadow-outline w-full my-1" list="clubs" type="search" name="home_team" id="home_team" :value="old('club')" autocomplete="club">
    <datalist id="clubs">
        @foreach ($clubs as $club)
        <option value="{{ $club->id }}">{{ $club->name }}</option>
        @endforeach
    </datalist>
</div>