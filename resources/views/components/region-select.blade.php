<div>
<label for="region">Ma region <span class="text-xs">(optionnel)</span></label>
    <input class="inputForm focus:outline-none focus:shadow-outline w-full my-1" value="{{ Auth::user()->region ? Auth::user()->region->name : "" }}" list="regions" type="search" name="region" id="region" :value="old('region')" autocomplete="region">
    <datalist id="regions">
        @foreach ($regions as $region)
        <option value="{{ $region->name }}">{{ $region->name }}</option>
        @endforeach
    </datalist>
</div>