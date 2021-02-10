<div>
    <label for="club">Mon club <span class="text-xs">(optionnel)</span></label>
    <input class="inputForm focus:outline-none focus:shadow-outline w-full my-1" value="{{ Auth::user() ? Auth::user()->club->name : "" }}" list="clubs" type="search" name="club" id="club" :value="old('club')" autocomplete="club">
    <datalist id="clubs">
        @foreach ($clubs as $club)
        <option value="{{ $club->name }}">{{ $club->name }}</option>
        @endforeach
    </datalist>
</div>