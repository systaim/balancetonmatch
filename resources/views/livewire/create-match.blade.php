<div>
    <div class="relative w-full py-10 px-4 bg-primary text-white flex justify-center items-center mb-6">
        <h2 class="text-4xl lg:text-6xl">Créer un match</h2>
    </div>
    <form wire:submit.prevent="saveMatch">
        @csrf
        <!-- CHOIX DES EQUIPES -->
        <div class="lg:grid grid-cols-12 w-11/12 m-auto">
            <div class="lg:col-span-5 flex items-start justify-center">
                @if ($homeTeam == '')
                    <div class="mx-4">
                        <label class="text-xs px-3" for="searchHome">Equipe à domicile</label>
                        @error('searchHome')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <input class="bg-transparent w-full focus:outline-none text-3xl xl:text-5xl uppercase px-3"
                            placeholder="DOMICILE" wire:model="searchHome" type="search" name="searchHome"
                            id="searchHome" :value="old('searchHome')" autocomplete="searchHome" required autofocus>
                            <div class="w-full h-0.5 bg-black"></div>
                        @if ($clubsHome != [] && count($clubsHome) != 0)
                            <p class="text-sm py-1">Clique sur une équipe<br>Fais le bon choix 😉</p>
                        @elseif(count($clubsHome) == 0 && strlen($searchHome) > 2)
                            <div class="text-sm py-1">
                                <p>Pas de résultats 😓
                                </p>
                            </div>
                        @else
                            <p class="text-xs py-1">Nom du club, de la ville, code postal ou initiales si renseigné</p>
                        @endif
                        @foreach ($clubsHome as $club)
                            <div class="flex flex-col mb-3 w-full">
                                <div class="relative flex flex-row justify-around items-center bg-primary overflow-hidden cursor-pointer"
                                    wire:click="addHomeTeam({{ $club->id }})" wire:key="{{ $loop->index }}">
                                    <div class="w-16 m-2 z-10">
                                        <div class="logo h-12 w-12 lg:h-16 lg:w-16 cursor-pointer">
                                            <img class="object-contain" src="{{ asset($club->logo) }}"
                                    alt="Logo de {{ $club->name }}">
                                        </div>
                                    </div>
                                    <div class="flex items-center py-2 w-full text-secondary overflow-hidden ml-2 z-10">
                                        <p class="font-bold cursor-pointer" wire:model="homeTeam">{{ $club->name }}
                                        </p>
                                    </div>
                                    <div class="absolute -bottom-7 -right-7 transform -rotate-45 z-0">
                                        <div class="h-2 w-36 mb-1"
                                            style="background-color: {{ $club->primary_color }};"></div>
                                        <div class="h-2 w-36" style="background-color: {{ $club->secondary_color }};">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="relative py-6 px-2 bg-secondary text-primary rounded-md mx-4 w-full shadow-xl">
                        <div class="logo h-28 w-28 m-auto">
                            <img class="object-contain"
                                src="{{ $homeTeamLogo }}">
                        </div>
                        <h2 class="text-center text-2xl xl:text-5xl truncate">{{ $homeTeam }}</h2>
                        <span
                            class="absolute top-1 right-1 cursor-pointer text-white text-base font-bold bg-danger h-6 w-6 rounded-full flex items-center justify-center"
                            wire:click="resetHomeTeam">
                            X</span>
                    </div>
                @endif
            </div>

            <div class="lg:col-span-2 flex justify-center {{ $clubsHome != [] || $clubsAway != [] ? 'items-start' : 'items-center' }}">
                <p class="flex justify-center items-center font-bold h-16 w-16 m-4">
                    <img src="{{ asset('images/vs-primary.png') }}" alt="">
                </p>
            </div>

            <div class="lg:col-span-5 flex items-start justify-center">
                @if ($awayTeam == '')
                    <div class="mx-4">
                        <label class="text-xs px-3" for="searchAway">Equipe à l'extérieur</label>
                        @error('searchAway')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <input
                            class="bg-transparent w-full focus:outline-none text-3xl xl:text-5xl uppercase px-3"
                            placeholder="EXTERIEUR" wire:model="searchAway" type="search" name="searchAway"
                            id="searchAway" :value="old('searchAway')" autocomplete="searchAway" required>
                            <div class="w-full h-0.5 bg-black"></div>
                        @if ($clubsAway != [] && count($clubsAway) != 0)
                            <p class="text-sm py-1">Clique sur une équipe<br>Fais le bon choix 😉</p>
                        @elseif(count($clubsAway) == 0 && strlen($searchAway) > 2)
                            <p class="text-sm py-1">Pas de résultats ? 😓
                        @else
                            <p class="text-xs py-1">Nom du club, de la ville, code postal ou initiales si renseigné</p>
                        @endif
                        @foreach ($clubsAway as $club)
                            <div class="flex flex-col mb-3 w-full">
                                <div class="relative flex flex-row items-center bg-primary overflow-hidden cursor-pointer"
                                    wire:click="addAwayTeam({{ $club->id }})" wire:key="{{ $loop->index }}">
                                    <div class="w-16 m-2 z-10">
                                        <div class="logo h-12 w-12 lg:h-16 lg:w-16 cursor-pointer">
                                            <img class="object-contain" src="{{ asset($club->logo) }}"
                                    alt="Logo de {{ $club->name }}">
                                        </div>
                                    </div>
                                    <div class="flex items-center py-2 w-full text-secondary overflow-hidden ml-2 z-10">
                                        <p class="font-bold cursor-pointer" wire:model="awayTeam">{{ $club->name }}
                                        </p>
                                    </div>
                                    <div class="absolute -bottom-7 -right-7 transform -rotate-45 z-0">
                                        <div class="h-2 w-36 mb-1"
                                            style="background-color: {{ $club->primary_color }};"></div>
                                        <div class="h-2 w-36"
                                            style="background-color: {{ $club->secondary_color }};"></div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="relative py-6 px-2 bg-secondary text-primary rounded-md mx-4 w-full shadow-xl">
                        <div class="logo h-28 w-28 m-auto">
                            <img class="object-contain"
                                src="{{ $awayTeamLogo }}">
                        </div>
                        <h2 class="text-center text-2xl xl:text-5xl truncate">{{ $awayTeam }}</h2>
                        <span
                            class="absolute top-1 right-1 cursor-pointer text-white text-base font-bold bg-danger h-6 w-6 rounded-full flex items-center justify-center"
                            wire:click="resetAwayTeam">
                            X</span>
                    </div>
                @endif
            </div>
        </div>

        <div
            class="bg-primary relative text-white my-6 px-3 py-3 m-auto shadow-lg sm:w-11/12 md:w-7/12 lg:w-6/12 xl:w-4/12 rounded-md">
            <div class="flex justify-evenly mb-4">
                <div class="flex flex-col w-2/5">
                    <label for="dateMatch">Date</label>
                    <input autofocus class="inputForm focus:outline-none focus:shadow-outline w-full my-1" type="date"
                        name="dateMatch" id="dateMatch" wire:model="dateMatch" :value="old('dateMatch')"
                        autocomplete="dateMatch" required>
                    @error('dateMatch')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="flex flex-col w-2/5">
                    <label for="time">Heure</label>
                    <input class="inputForm focus:outline-none focus:shadow-outline w-full my-1" type="time" name="time"
                        id="time" wire:model="timeMatch" :value="old('time')" autocomplete="time" required>
                    @error('time')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            @if ($homeTeam && $awayTeam)
                <!-- CHOIX COMPETITION -->
                <div class="mb-4">
                    <label for="competition">Compétition</label>
                    @error('competition')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <select class="inputForm focus:outline-none focus:shadow-outline w-full my-1" name="competition"
                        id="competition" wire:model="competition" :value="old('competition')" required
                        autocomplete="competition">
                        <option>Choisis une compet'</option>
                        <option value="1">Championnat régional</option>
                        <option value="2">Championnat départemental</option>
                        <option value="3">Coupe de France</option>
                        <option value="4">Coupe régionale</option>
                        <option value="5">Coupe départementale 1</option>
                        <option value="7">Match départementale 2</option>
                        <option value="6">Match amical</option>
                    </select>
                </div>
                <div class="flex flex-row justify-center">
                    <div class="hidden p-4" wire:loading wire:target="competition">
                        <!-- <i class="fas fa-spinner animate-spin"></i> -->
                        <div class="loader"></div>
                    </div>
                </div>

                @if ($competition)

                    <!-- CHOIX REGION -->

                    @if ($competition == 1 || $competition == 2 || $competition == 4 || $competition == 5)
                        <div class=" mb-4">
                            <label for="region">Région</label>
                            @error('region')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <select class="inputForm focus:outline-none focus:shadow-outline w-full my-1" name="region"
                                id="region" wire:model="region" :value="old('region')" autocomplete="region" required>
                                <option>Choisis la région</option>

                                @foreach ($regions as $region)
                                    <option value="{{ $region['name'] }}">{{ $region['name'] }}</option>
                                @endforeach
                            </select>

                        </div>
                    @endif

                    <!-- CHOIX R1 R2 R3-->

                    @if ($competition == '1')
                        <div class=" mb-4">
                            <label for="divisionsRegions">Divisions régionale</label>
                            @error('divisionsRegions')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <select class="inputForm focus:outline-none focus:shadow-outline w-full my-1"
                                name="divisionsRegions" id="divisionsRegions" wire:model="divisionsRegions"
                                :value="old('divisionsRegions')" autocomplete="divisionsRegions" required>
                                <option>Choisissez une division</option>
                                <option value="1">R1</option>
                                <option value="2">R2</option>
                                <option value="3">R3</option>
                            </select>

                        </div>
                    @endif

                    <!-- CHOIX DISTRICT (DEPARTMENT) -->
                    @if ($competition == 2 || $competition == 5)
                        <div class=" mb-4">

                            <label for="district">District</label>
                            @error('district')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <select class="inputForm focus:outline-none focus:shadow-outline w-full my-1"
                                name="district" id="district" wire:model="district" :value="old('district')"
                                autocomplete="district" required>
                                <option>Choisis un district</option>
                                @foreach ($districts as $district)
                                    <option value="{{ $district['id'] }}">{{ $district['name'] }}</option>
                                @endforeach

                            </select>
                        </div>
                    @endif

                    <!-- CHOIX D1 D2 D3... -->

                    @if ($competition == 2)
                        <div class=" mb-4">
                            <label for="divisionsDepartments">Division</label>
                            @error('divisionsDepartments')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <select class="inputForm focus:outline-none focus:shadow-outline w-full my-1"
                                name="divisionsDepartments" id="divisionsDepartments" wire:model="divisionsDepartments"
                                :value="old('divisionsDepartments')" autocomplete="divisionsDepartments" required>
                                <option>Choisis une division</option>
                                <option value="1">D1</option>
                                <option value="2">D2</option>
                                <option value="3">D3</option>
                                <option value="4">D4</option>
                                <option value="5">D5</option>
                            </select>

                        </div>
                    @endif

                    <!-- CHOIX GROUPE -->

                    @if ($competition == 1 || $competition == 2)
                        <div class=" mb-4">
                            <label for="group">Groupe</label>
                            @error('group')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <select class="inputForm focus:outline-none focus:shadow-outline w-full my-1" name="group"
                                id="group" wire:model="group" :value="old('group')" autocomplete="group" required>
                                <option>Choisis un groupe</option>
                                @foreach ($groups as $group)
                                    <option value="{{ $group['name'] }}">{{ $group['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif

                    <div class=" mb-4">
                        <div class="flex justify-center items-center">
                            <button class="relative btn flex" type="submit" wire:model="saveMatch">
                                <div class="mr-3">
                                    <p>Créer un match</p>
                                </div>
                                <div class="hidden" wire:loading wire:target="saveMatch">
                                    <!-- <i class="fas fa-spinner animate-spin"></i> -->
                                    <div class="loader"></div>
                                </div>
                            </button>
                        </div>
                        {{-- @if (\Session::has('danger'))
                            <div class="message-alert danger">
                                <i class="fas fa-times-circle text-5xl text-white rounded-full shadow-xl"></i>
                                <p> {!! \Session::get('danger') !!}</p>
                            </div>
                        @endif --}}
                    </div>
                @endif
            @endif
        </div>

    </form>

</div>
