<div>
<label for="region">Ma region</label>
    <input class="inputForm focus:outline-none focus:shadow-outline w-full my-1" list="regions" type="search" name="region" id="region" :value="old('region')" autocomplete="region">
    <datalist id="regions">
        @foreach ($regions as $region)
        <option value="{{ $region->name }}">{{ $region->name }}</option>
        @endforeach
    </datalist>
</div>