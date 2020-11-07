<div>
    <h2 class="titlePage">Créer un match</h2>
    <form wire:submit.prevent="saveMatch">
        <div class="bg-primary rounded-lg relative text-white my-2 p-3">
            <div>
                <label for="region">Région</label>
                <select class="inputForm focus:outline-none focus:shadow-outline w-full my-1" name="region" id="region" wire:model="region">
                    <option>Choisissez la région</option>
                    @foreach($regions as $region)
                    <option value="{{ $region->name }}">{{ $region->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="competition">Compétition</label>
                <select class="inputForm focus:outline-none focus:shadow-outline w-full my-1" name="compétition" id="competition" wire:model="competition">
                    <option>Choisissez une compet'</option>
                    <option value="1">Championnat régional</option>
                    <option value="2">Championnat départemental</option>
                    <option value="3">Coupe de France</option>
                    <option value="4">Coupe régionale</option>
                    <option value="5">Coupe départementale</option>
                </select>
            </div>
            @if($competition == "1")
            <div>
                <label for="divisionsRegions">Divisions régionales</label>
                <select class="inputForm focus:outline-none focus:shadow-outline w-full my-1" name="divisionsRegions" id="divisionsRegions" wire:model="divisionsRegions">
                    <option>Choisissez une division</option>
                    <option value="1">R1</option>
                    <option value="2">R2</option>
                    <option value="3">R3</option>
                </select>
            </div>
            @endif
            @if($competition == "2")
            <div>
                <label for="divisionsDepartments">Divisions départementales</label>
                <select class="inputForm focus:outline-none focus:shadow-outline w-full my-1" name="divisionsDepartments" id="divisionsDepartments" wire:model="divisionsDepartments">
                    <option>Choisissez une division</option>
                    <option value="1">D1</option>
                    <option value="2">D2</option>
                    <option value="3">D3</option>
                    <option value="4">D4</option>
                    <option value="5">D5</option>
                </select>
            </div>
            @endif
            <div>
                <label for="home_team">Equipe à domicile</label>
                <input class="inputForm focus:outline-none focus:shadow-outline w-full my-1" list="teams" wire:model="searchHome" type="search" name="home_team" id="home_team">
                <datalist id="teams" wire:model="clubs">
                    @foreach ($clubs as $club)
                    <option value="{{ $club->name }}">{{ $club->name }}</option>
                    @endforeach
                </datalist>
            </div>
            <div>
                <label for="away_team">Equipe à l'extérieur</label>
                <input class="inputForm focus:outline-none focus:shadow-outline w-full my-1" list="teams" wire:model="searchAway" type="search" name="away_team" id="away_team">
                <datalist id="teams" wire:model="clubs">
                    @foreach ($clubs as $club)
                    <option value="{{ $club->name }}">{{ $club->name }}</option>
                        @endforeach
                </datalist>
            </div>
            <div>
                <label for="date">Date</label>
                <input class="inputForm focus:outline-none focus:shadow-outline w-full my-1" type="date" name="date_match" id="date_match" wire:model="dateMatch">
            </div>
            <div>
                <label for="heure">Heure</label>
                <input class="inputForm focus:outline-none focus:shadow-outline w-full my-1" type="time" name="time" id="time" wire:model="timeMatch">
            </div>
            <div class="flex justify-center">
                <input class="btn btnPrimary" type="submit" value="C'est parti !">
            </div>
        </div>
    </form>
</div>