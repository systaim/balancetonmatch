<div>
    <h2 class="titlePage">Créer un match</h2>
    <form wire:submit.prevent="saveMatch">
        @csrf
        <div class="bg-primary rounded-lg relative text-white my-2 px-3 py-3">
            <div>
                <label for="competition">Compétition</label>
                <select class="inputForm focus:outline-none focus:shadow-outline w-full my-1" name="competition" id="competition" wire:model="competition">
                    <option>Choisissez une compet'</option>
                    <option value="1">Championnat régional</option>
                    <option value="2">Championnat départemental</option>
                    <option value="3">Coupe de France</option>
                    <option value="4">Coupe régionale</option>
                    <option value="5">Coupe départementale</option>
                </select>
            </div>
            <div class="flex flex-row justify-center">
                <div class="hidden p-4" wire:loading wire:target="competition">
                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </div>
            </div>
            @if($competition)
            <div>
                @if($competition != 3)
                <label for="region">Région</label>
                <select class="inputForm focus:outline-none focus:shadow-outline w-full my-1" name="region" id="region" wire:model="region">
                    <option>Choisissez la région</option>
                    @foreach($regions as $region)
                    <option value="{{ $region->name }}">{{ $region->name }}</option>
                    @endforeach
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
            <div>
                <label for="group">Groupe</label>
                <select class="inputForm focus:outline-none focus:shadow-outline w-full my-1" name="group" id="group" wire:model="group">
                    <option>Choisissez un groupe</option>
                    @foreach($groups as $group)
                    <option value="{{ $group->name}}">{{ $group->name }}</option>
                    @endforeach
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
            <div>
                <label for="group">Groupe</label>
                <select class="inputForm focus:outline-none focus:shadow-outline w-full my-1" name="group" id="group" wire:model="group">
                    <option>Choisissez un groupe</option>
                    @foreach($groups as $group)
                    <option value="{{ $group->name}}">{{ $group->name }}</option>
                    @endforeach
                </select>
            </div>
            @endif
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
            <div>
                <div class="flex justify-center items-center">
                    <button class="relative btn flex" type="submit" wire:model="saveMatch">
                        <div class="mr-3">
                            <p>Créer un match</p>
                        </div>
                        <div class="hidden" wire:loading wire:target="saveMatch">
                            <svg wire:target="saveMatch" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </div>
                    </button>
                </div>
                <div class="text-center">
                    <p>{{$messageErreur}}</p>
                </div>
            </div>

        </div>
        @endif
    </form>
</div>