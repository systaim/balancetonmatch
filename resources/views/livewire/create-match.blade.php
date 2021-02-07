<div>
    <div class="flex justify-center">
        <h2 class="titlePage">Créer un match</h2>
    </div>
    <form wire:submit.prevent="saveMatch">
        @csrf
        <div class="bg-primary rounded-lg relative text-white my-2 px-3 py-3 m-auto sm:w-11/12 md:w-7/12 lg:w-6/12 xl:w-4/12">
            <div class="flex justify-evenly mb-4">
                <div class="flex flex-col w-2/5">
                    <label for="date_match">Date</label>
                    <input autofocus class="inputForm focus:outline-none focus:shadow-outline w-full my-1" type="date" name="date_match" id="date_match" wire:model="dateMatch" :value="old('date_match')" autocomplete="date_match" required>
                    @error('date_match')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="flex flex-col w-2/5">
                    <label for="time">Heure</label>
                    <input class="inputForm focus:outline-none focus:shadow-outline w-full my-1" type="time" name="time" id="time" wire:model="timeMatch" :value="old('time')" autocomplete="time" required>
                    @error('time')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- CHOIX COMPETITION -->

            <div class=" mb-4">
                <label for="competition">Compétition</label>
                <select class="inputForm focus:outline-none focus:shadow-outline w-full my-1" name="competition" id="competition" wire:model="competition" :value="old('last_name')" required autocomplete="last_name">
                    <option>Choisis une compet'</option>
                    <option value="1">Championnat régional</option>
                    <option value="2">Championnat départemental</option>
                    <option value="3">Coupe de France</option>
                    <option value="4">Coupe régionale</option>
                    <option value="5">Coupe départementale</option>
                    <option value="6">Match amical</option>
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

            <!-- CHOIX REGION -->

            @if($competition == 1 || $competition == 2 || $competition == 4 || $competition == 5)
            <div class=" mb-4">
                <label for="region">Région</label>
                <select class="inputForm focus:outline-none focus:shadow-outline w-full my-1" name="region" id="region" wire:model="region" :value="old('region')" autocomplete="region" required>
                    <option>Choisis la région</option>
                    @foreach($regions as $region)
                    <option value="{{ $region->name }}">{{ $region->name }}</option>
                    @endforeach
                </select>
                @error('region')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            @endif

            <!-- CHOIX R1 R2 R3-->

            @if($competition == "1")
            <div class=" mb-4">
                <label for="divisionsRegions">Divisions régionale</label>
                <select class="inputForm focus:outline-none focus:shadow-outline w-full my-1" name="divisionsRegions" id="divisionsRegions" wire:model="divisionsRegions" :value="old('divisionsRegions')" autocomplete="divisionsRegions" required>
                    <option>Choisissez une division</option>
                    <option value="1">R1</option>
                    <option value="2">R2</option>
                    <option value="3">R3</option>
                </select>
                @error('divisionsRegions')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            @endif

            <!-- CHOIX DISTRICT (DEPARTMENT) -->

            @if($competition == 2 || $competition == 5)
            <div class=" mb-4">
                <label for="district">District</label>
                <select class="inputForm focus:outline-none focus:shadow-outline w-full my-1" name="district" id="district" wire:model="district" :value="old('district')" autocomplete="district" required>
                    <option>Choisis un district</option>
                    @foreach($departments->sortBy('name') as $department)
                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                    @endforeach
                    @error('district')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </select>
            </div>
            @endif

            <!-- CHOIX D1 D2 D3... -->

            @if($competition == 2)
            <div class=" mb-4">
                <label for="divisionsDepartments">Division</label>
                <select class="inputForm focus:outline-none focus:shadow-outline w-full my-1" name="divisionsDepartments" id="divisionsDepartments" wire:model="divisionsDepartments" :value="old('divisionsDepartments')" autocomplete="divisionsDepartments" required>
                    <option>Choisis une division</option>
                    <option value="1">D1</option>
                    <option value="2">D2</option>
                    <option value="3">D3</option>
                    <option value="4">D4</option>
                    <option value="5">D5</option>
                </select>
                @error('divisionsDepartments')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            @endif

            <!-- CHOIX GROUPE -->

            @if($competition == 1 || $competition == 2)
            <div class=" mb-4">
                <label for="group">Groupe</label>
                <select class="inputForm focus:outline-none focus:shadow-outline w-full my-1" name="group" id="group" wire:model="group" :value="old('group')" autocomplete="group" required>
                    <option>Choisis un groupe</option>
                    @foreach($groups as $group)
                    <option value="{{ $group->name}}">{{ $group->name }}</option>
                    @endforeach
                </select>
                @error('group')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            @endif

            <!-- CHOIX DES EQUIPES -->

            <div class=" mb-4">
                <label for="home_team">Equipe à domicile</label>
                <input class="inputForm focus:outline-none focus:shadow-outline w-full my-1" list="teams" wire:model="searchHome" type="search" name="home_team" id="home_team" :value="old('home_team')" autocomplete="home_team" required>
                <datalist id="teams" wire:model="clubs">
                    @foreach ($clubs as $club)
                    <option value="{{ $club->name }}">{{ $club->name }}</option>
                    @endforeach
                </datalist>
                @error('home_team')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class=" mb-4">
                <label for="away_team">Equipe à l'extérieur</label>
                <input class="inputForm focus:outline-none focus:shadow-outline w-full my-1" list="teams" wire:model="searchAway" type="search" name="away_team" id="away_team" :value="old('away_team')" autocomplete="away_team" required>
                <datalist id="teams" wire:model="clubs">
                    @foreach ($clubs as $club)
                    <option value="{{ $club->name }}">{{ $club->name }}</option>
                    @endforeach
                </datalist>
                @error('away_team')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class=" mb-4">
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
            @endif
        </div>
    </form>
</div>