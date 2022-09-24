<div>
    <form wire:submit.prevent="storeAction('{{ $action_choisie }}')">
        <h3 class="text-2xl text-center">Pour qui ?</h3>
        <P class="text-sm text-center">Clique sur le logo de ton choix</P>
        <div class="flex justify-evenly my-6">
            <button type="button"
                class="logo h-20 w-20 ring-2 ring-secondary shadow-lg {{ $team_choisie == 'home' ? 'animate__animated animate__rubberBand animate__infinite animate__slow' : '' }}"
                wire:click="setTeamChoisie('home')">
                <img class="object-contain" src="{{ asset($match->homeClub->logo) }}"
                    alt="Logo de {{ $match->homeClub->abbreviation }}">
            </button>
            <button type="button"
                class="logo h-20 w-20 ring-2 ring-secondary shadow-lg {{ $team_choisie == 'away' ? 'animate__animated animate__rubberBand animate__infinite animate__slow' : '' }}"
                wire:click="setTeamChoisie('away')">
                <img class="object-contain" src="{{ asset($match->awayClub->logo) }}"
                    alt="Logo de {{ $match->awayClub->abbreviation }}">
            </button>
        </div>
        @if ($team_choisie)
            <div class="flex flex-wrap justify-center">
                <div>
                    <button type="button" class="w-36 bg-white rounded-md m-3 shadow-lg"
                        wire:click="setActionChoisie('goal')">
                        <div class="m-1 rounded-md overflow-hidden h-16">
                            <img src="{{ asset('images/goal.png') }}" alt="" class="object-cover">
                        </div>
                        <div class="flex justify-center">
                            <p class="font-bold">BUT</p>
                        </div>
                    </button>
                    <button type="button" class="w-36 bg-white rounded-md m-3 shadow-lg"
                        wire:click="setActionChoisie('yellow_card')">
                        <div class="m-1 rounded-md overflow-hidden h-16">
                            <img src="{{ asset('images/carton-jaune.jpeg') }}" alt="">
                        </div>
                        <div class="flex justify-center">
                            <p class="font-bold">CARTON JAUNE</p>
                        </div>
                    </button>
                </div>
                <div>
                    <button type="button" class="w-36 bg-white rounded-md m-3 shadow-lg"
                        wire:click="setActionChoisie('red_card')">
                        <div class="m-1 rounded-md overflow-hidden h-16">
                            <img src="{{ asset('images/carton-rouge.jpeg') }}" alt="">
                        </div>
                        <div class="flex justify-center">
                            <p class="font-bold">CARTON ROUGE</p>
                        </div>
                    </button>
                    <button type="button" class="w-36 bg-white rounded-md m-3 shadow-lg"
                        wire:click="setActionChoisie('substitute')">
                        <div class="m-1 rounded-md overflow-hidden h-16">
                            <img src="{{ asset('images/remplacement.jpeg') }}" alt="">
                        </div>
                        <div class="flex justify-center">
                            <p class="font-bold">REMPLACEMENT</p>
                        </div>
                    </button>
                </div>
            </div>
        @endif
        <div>
            @if ($action_choisie)
                @if ($action_choisie == 'goal')
                    <div>
                        <div class="flex justify-center items-center flex-wrap p-4 w-full">
                            <div class="my-3">
                                <p class="font-bold text-center">Qui marque ?</p>
                                <select
                                    class="border-l-0 border-t-0 border-black border-r-0 text-black focus:outline-none"
                                    name="player" id="player" wire:model="player1" required>
                                    <option value="">Choisis un joueur</option>
                                    <option value="0">CSC</option>
                                    @foreach ($team_choisie == 'home' ? $homeCompo->sortBy('first_name') : $awayCompo as $compo)
                                        <option value="{{ $compo->id }}">{{ $compo->player->full_name }}</option>
                                    @endforeach
                                    {{-- @for ($i = 1; $i <= 16; $i++)
                                        <option value="{{ $i }}">Numéro {{ $i }}</option>
                                    @endfor --}}
                                </select>
                            </div>
                            <div class="my-3 mx-1">
                                <p class="font-bold text-center">Un passeur ?</p>
                                <select
                                    class="border-l-0 border-t-0 border-black border-r-0 text-black focus:outline-none"
                                    name="player" id="player" wire:model="player2">
                                    <option value="">Choisis un joueur</option>
                                    @foreach ($team_choisie == 'home' ? $homeCompo->sortBy('first_name') : $awayCompo as $compo)
                                        <option value="{{ $compo->id }}">{{ $compo->player->full_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="flex flex-col items-center">
                            <p class="font-bold text-center">Action en particulier ?</p>
                            <select name="type_de_but" id="type_de_but" wire:model="type_de_but"
                                class="border-l-0 border-t-0 border-black border-r-0 text-black focus:outline-none">
                                <option value="">Choisis un type d'action</option>
                                <option value="pénalty">Pénalty</option>
                                <option value="CF direct">Coup-franc direct</option>
                            </select>
                        </div>
                    </div>
                @elseif ($action_choisie == 'yellow_card')
                    <div class="flex justify-center items-center flex-wrap p-4 w-full">

                        <div class="my-3">
                            <p class="font-bold text-center">Quel joueur ?</p>
                            <select class="border-l-0 border-t-0 border-black border-r-0 text-black focus:outline-none"
                                name="player" id="player" wire:model="player1" required>
                                <option value="">Choisis un joueur</option>
                                @foreach ($team_choisie == 'home' ? $homeCompo->sortBy('first_name') : $awayCompo as $compo)
                                        <option value="{{ $compo->id }}">{{ $compo->player->full_name }}</option>
                                    @endforeach
                            </select>
                        </div>
                    </div>
                @elseif ($action_choisie == 'red_card')
                    <div class="flex justify-center items-center flex-wrap p-4 w-full">

                        <div class="my-3">
                            <p class="font-bold text-center">Quel joueur ?</p>
                            <select class="border-l-0 border-t-0 border-black border-r-0 text-black focus:outline-none"
                                name="player" id="player" wire:model="player1" required>
                                <option value="">Choisis un joueur</option>
                                @foreach ($team_choisie == 'home' ? $homeCompo->sortBy('first_name') : $awayCompo as $compo)
                                        <option value="{{ $compo->id }}">{{ $compo->player->full_name }}</option>
                                    @endforeach
                            </select>
                        </div>
                    </div>
                @elseif ($action_choisie == 'substitute')
                    <div class="flex justify-center items-center flex-wrap p-4 w-full">

                        <div class="my-3 mx-1">
                            <p class="font-bold text-center">Le joueur sortant ?</p>
                            <select class="border-l-0 border-t-0 border-black border-r-0 text-black focus:outline-none"
                                name="player" id="player" wire:model="player1" required>
                                <option value="">Choisis un joueur</option>
                                <option value="0">CSC</option>
                                @foreach ($team_choisie == 'home' ? $homeCompo->sortBy('first_name') : $awayCompo as $compo)
                                        <option value="{{ $compo->id }}">{{ $compo->player->full_name }}</option>
                                    @endforeach
                            </select>
                        </div>
                        <div class="my-3">
                            <p class="font-bold text-center">Le joueur sortant ?</p>
                            <select class="border-l-0 border-t-0 border-black border-r-0 text-black focus:outline-none"
                                name="player" id="player" wire:model="player2" required>
                                <option value="">Choisis un joueur</option>
                                @foreach ($team_choisie == 'home' ? $homeCompo->sortBy('first_name') : $awayCompo as $compo)
                                        <option value="{{ $compo->id }}">{{ $compo->player->full_name }}</option>
                                    @endforeach
                            </select>
                        </div>
                    </div>
                @endif
                <div class="flex justify-center my-4 text-sm">
                    <div class="flex flex-col items-center">
                        <p class="text-center">Temps de jeu</p>
                        <input type="number" class="rounded-md w-24" required wire:model="tps_de_jeu">
                    </div>
                </div>
                {{-- @if ($match->live == 'finDeMatch') --}}
                    <div class="flex justify-center my-4 text-sm">
                        <div class="flex flex-col items-center">
                            <p class="text-center">Quelle période ?</p>
                            <input type="number" class="rounded-md w-24" required wire:model="periode" min="1" max="2">
                        </div>
                    </div>
                {{-- @endif --}}
                <div class="flex justify-center text-sm">
                    <button type="submit" class="btn btnPrimary">Commenter</button>
                </div>
            @endif
        </div>
    </form>
</div>
