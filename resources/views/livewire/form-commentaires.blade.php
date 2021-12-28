<div wire:poll.3s x-data="{ open: false }">
    <!----------------------
    Options commentaires "équipe"
    ------------------------->
    <div>
        @auth
            @if (Auth::user()->role == 'super-admin' || ($match->commentateur != null && $match->commentateur->user_id == Auth::user()->id && $match->live != 'attente' && $match->live != 'finDeMatch' && $match->live != 'tab'))
                @if (!$buttonComment)
                    <div class="flex justify-center">
                        <button type="button" wire:click="clickButtonComment" class="fixed bottom-20 z-40">
                            <div
                                class="flex justify-evenly items-center bg-primary text-white px-1 py-2 rounded-full w-48 border-2 border-secondary">
                                <div
                                    class="animate-pulse h-10 w-10 shadow-2xl border-2 border-secondary bg-primary flex justify-center items-center rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 6h16M4 12h8m-8 6h16" />
                                    </svg>
                                </div>
                                <p class="px-3">Je commente</p>
                            </div>
                        </button>
                    </div>
                @endif
            @endif
        @endauth
        @if ($buttonComment)
            <div class="flex justify-center">
                <button type="button" wire:click="clickButtonComment" class="fixed flex justify-center bottom-20 z-50">
                    <div
                        class="h-14 w-14 shadow-2xl border-2 border-secondary bg-primary flex justify-center items-center rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>
                </button>
            </div>
            <div class="bg-orange-400">
                <div class="fixed bottom-16 left-2 z-40 ">
                    <input class="hidden" type="radio" wire:model="team_action" id="homeAction"
                        name="team_action" value="home">
                    <label for="homeAction">
                        <div class="logo h-20 w-20 shadow-2xl border-2 border-primary">
                            @if ($match->homeClub->logo_path)
                                <img class="object-contain" src="{{ asset($match->homeClub->logo_path) }}"
                                    alt="Logo de {{ $match->homeClub->name }}">
                            @else
                                <img class="object-contain"
                                    src="https://android-apiapp.azureedge.net/common/bib_img/logo/{{ $match->homeClub->numAffiliation }}.jpg"
                                    alt="Logo de {{ $match->homeClub->name }}">
                            @endif
                        </div>
                    </label>
                </div>
                <div class="fixed bottom-16 right-2 z-40">
                    <input class="hidden" type="radio" wire:model="team_action" id="awayAction"
                        name="team_action" value="away">
                    <label for="awayAction">
                        <div class="logo h-20 w-20 shadow-2xl border-2 border-primary">
                            @if ($match->awayClub->logo_path)
                                <img class="object-contain" src="{{ asset($match->awayClub->logo_path) }}"
                                    alt="Logo de {{ $match->awayClub->name }}">
                            @else
                                <img class="object-contain"
                                    src="https://android-apiapp.azureedge.net/common/bib_img/logo/{{ $match->awayClub->numAffiliation }}.jpg"
                                    alt="Logo de {{ $match->awayClub->name }}">
                            @endif
                        </div>
                    </label>
                </div>
                <div>
                    @if ($team_action == 'home')
                        <div>
                            <label class="fixed m-3 z-40 bottom-32 left-0" for="but" class="cursor-pointer">
                                <input class="hidden" type="radio" id="but" wire:model="type_comments"
                                    name="type_comments" value="but">
                                <img class="border-2 border-secondary rounded-full shadow-xl bg-white m-2 p-2"
                                    src="{{ asset('images/ball.png') }}" width="50px" height="50px" alt="But !">
                            </label>
                            <label style="bottom:6.3rem; left: 4rem;" class="fixed m-3 z-40" for="carton"
                                class="cursor-pointer" for="carton" class="cursor-pointer">
                                <input class="hidden" type="radio" id="carton" wire:model="type_comments"
                                    name="type_comments" value="carton">
                                <img class="border-2 border-secondary rounded-full shadow-xl bg-white m-2 p-2"
                                    src="{{ asset('images/cards.png') }}" width="50px" height="50px" alt="Carton">
                            </label>
                            <label class="fixed bottom-10 left-20 m-3 z-40" for="arret" class="cursor-pointer"
                                for="arret" class="cursor-pointer">
                                <input class="hidden" type="radio" id="arret" wire:model="type_comments"
                                    name="type_comments" value="arret">
                                <img class="border-2 border-secondary rounded-full shadow-xl bg-white m-2 p-2"
                                    src="{{ asset('images/gants.png') }}" width="50px" height="50px" alt="Arret">
                            </label>
                        </div>
                    @endif
                    @if ($team_action == 'away')
                        <div>
                            <label class="fixed m-3 z-40 bottom-32 right-0" for="but" class="cursor-pointer">
                                <input class="hidden" type="radio" id="but" wire:model="type_comments"
                                    name="type_comments" value="but">
                                <img class="border-2 border-secondary rounded-full shadow-xl bg-white m-2 p-2"
                                    src="{{ asset('images/ball.png') }}" width="50px" height="50px" alt="But !">
                            </label>
                            <label style="bottom:6.3rem; right: 4rem;" class="fixed m-3 z-40" for="carton"
                                class="cursor-pointer" for="carton" class="cursor-pointer">
                                <input class="hidden" type="radio" id="carton" wire:model="type_comments"
                                    name="type_comments" value="carton">
                                <img class="border-2 border-secondary rounded-full shadow-xl bg-white m-2 p-2"
                                    src="{{ asset('images/cards.png') }}" width="50px" height="50px" alt="Carton">
                            </label>
                            <label class="fixed bottom-10 right-20 m-3 z-40" for="arret" class="cursor-pointer"
                                for="arret" class="cursor-pointer">
                                <input class="hidden" type="radio" id="arret" wire:model="type_comments"
                                    name="type_comments" value="arret">
                                <img class="border-2 border-secondary rounded-full shadow-xl bg-white m-2 p-2"
                                    src="{{ asset('images/gants.png') }}" width="50px" height="50px" alt="Arret">
                            </label>
                        </div>
                    @endif
                </div>
            </div>
        @endif
    </div>
    <div>
        <form wire:submit.prevent="saveComment">
            @csrf

            @include('livewire.commentaires.dashboard-score')

            <!-------------------------
                Formulaire d'action équipe 
                ---------------------------->
            <div class="openComment z-50 rounded-t-lg {{ $team_action }} {{ $type_comments }} border-t">
                <div class="flex flex-col items-center pt-5">
                    <div class="flex items-center">
                        @if ($team_action == 'home')
                            <div class="logo h-14 w-14 cursor-pointer m-4 border-2 border-primary">
                                <img class="object-contain"
                                    src="https://android-apiapp.azureedge.net/common/bib_img/logo/{{ $match->homeClub->numAffiliation }}.jpg"
                                    alt="logo">
                            </div>
                        @endif
                        @if ($team_action == 'away')
                            <div class="logo h-14 w-14 cursor-pointer m-4 border-2 border-primary">
                                <img class="object-contain"
                                    src="https://android-apiapp.azureedge.net/common/bib_img/logo/{{ $match->awayClub->numAffiliation }}.jpg"
                                    alt="logo">
                            </div>
                        @endif
                        <h3 class="text-xl text-center px-2 text-primary bg-gray-200 rounded-lg">
                            @switch($type_comments)
                                @case('but')
                                    But !
                                @break
                                @case('carton')
                                    Carton !
                                @break
                                @case('arret')
                                    Arrêt du gardien !
                                @break
                            @endswitch
                        </h3>
                    </div>
                    @if ($type_comments == 'carton')
                        <div
                            class="py-1-3 border rounded-lg shadow-2xl bg-white flex flex-wrap items-center justify-center">
                            <div class="actionsMatch relative">
                                <input class="hidden" type="radio" id="cartonJaune" wire:model="type_carton"
                                    name="type_comments" value="Carton jaune">
                                <label class="inputAction" for="cartonJaune">
                                    <img src="{{ asset('images/yellow-card.png') }}" alt="1er carton jaune"
                                        class="h-14">
                                </label>
                                <p class="absolute top-8 left-7 font-sans">1er</p>
                            </div>
                            <div class="actionsMatch relative">
                                <input class="hidden" type="radio" id="cartonJaune2" wire:model="type_carton"
                                    name="type_comments" value="2e carton jaune">
                                <label class="inputAction" for="cartonJaune2">
                                    <img src="{{ asset('images/yellow-card.png') }}" alt="2e carton jaune"
                                        class="h-14">
                                </label>
                                <p class="absolute top-8 left-7 font-sans">2e</p>
                            </div>
                            <div class="actionsMatch">
                                <input class="hidden" type="radio" id="cartonRouge" wire:model="type_carton"
                                    name="type_comments" value="Carton rouge">
                                <label class="inputAction" for="cartonRouge">
                                    <img src="{{ asset('images/red-card.png') }}" alt="carton rouge"
                                        class="h-14">
                                </label>
                            </div>
                            <div class="actionsMatch">
                                <input class="hidden" type="radio" id="cartonBlanc" wire:model="type_carton"
                                    name="type_comments" value="Carton blanc">
                                <label class="inputAction" for="cartonBlanc">
                                    <img src="{{ asset('images/white-card.png') }}" alt="carton blanc"
                                        class="h-14">
                                </label>
                            </div>
                        </div>
                    @endif
                    @if ($type_comments == 'but' || $type_comments == 'carton')
                        <div class="rounded-lg flex flex-col justify-center items-center p-4 w-full">
                            <select class="inputForm border border-black text-black" name="player" id="player"
                                wire:model="player"
                                {{ $type_comments == 'but' || $type_comments == 'carton' ? 'required' : '' }}>
                                <option value="">Choisis un joueur</option>
                                <option value="0">CSC</option>
                                @if ($team_action == 'home')
                                    @foreach ($match->homeClub->players->sortBy('first_name') as $player)
                                        <option value="{{ $player->id }}">{{ $player->first_name }}
                                            {{ $player->last_name }}</option>
                                    @endforeach
                                    @for ($i = 1; $i <= 16; $i++)
                                        <option value="{{ $i }}">Numéro {{ $i }}</option>
                                    @endfor
                                @endif
                                @if ($team_action == 'away')
                                    @foreach ($match->awayClub->players as $player)
                                        <option value="{{ $player->id }}">{{ $player->first_name }}
                                            {{ $player->last_name }}</option>
                                    @endforeach
                                    @for ($i = 1; $i <= 16; $i++)
                                        <option value="{{ $i }}">Numéro {{ $i }}</option>
                                    @endfor
                                @endif
                            </select>
                        </div>
                    @endif
                    <div class="flex items-center text-white m-auto my-4">
                        <label class="cursor-pointer my-4 btn border border-black text-black" for="file">
                            <div class="flex justify-between">
                                <div class="hidden" wire:loading wire:target="file">
                                    <svg class="animate-spin mr-2 h-5 w-5 text-primary"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                            stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor"
                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <p>Une photo ou une vidéo ? 📷</p>
                                </div>
                            </div>
                            <input class="hidden" type="file" wire:model="file" name="file" id="file"
                                accept="jpeg,png,jpg,gif,svg,mp4,mov">
                        </label>
                    </div>
                    @error('type_comments')
                        <span class="error">{{ $message }}</span>
                    @enderror
                    @if ($file)
                        <div class="flex flex-col items-center">
                            Aperçu de l'image :
                            <img class="w-36" src="{{ $file->temporaryUrl() }}">
                        </div>
                    @endif
                    @error('file')
                        <span class="alert alert-danger">{{ $message }}</span>
                    @enderror
                    <div class="flex flex-row justify-center items-center mt-4">
                        <label for="minuteCom">Temps de jeu</label>
                        <input class="border border-black mx-2 py-1 text-center outline-none" type="number"
                            name="minuteCom" wire:model="minuteCom" min="1" max="125"
                            placeholder="{{ $minute }}">
                        @error('minuteCom')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mt-6 flex items-center justify-center">
                        <label for="exit" class="mr-6 cursor-pointer" wire:click="retour">Retour</label>
                        <button wire:loading.attr="disabled" wire:loading.class.remove="btnPrimary" wire:target="file"
                            class="btn btnPrimary" type="submit" wire:click="$emit('majPage')">Je commente</button>
                        <input class="hidden" type="radio" id="exit" wire:model="team_action" name="team_action"
                            value="">
                    </div>
                </div>
            </div>
            <!----------------------
                Options commentaires "match"
                    ------------------------->
            <div>
                @auth
                    @if (!Auth::user()->isFavoriMatch($match) && $match->live == 'attente' && $match->date_match > now())
                        <div class="w-11/12 md:w-6/12 mx-auto">
                            <div
                                class="flex justify-start items-center bg-primary text-white px-1 py-2 rounded-lg border-2 border-white my-2">
                                <div
                                    class="h-12 w-12 shadow-2xl border-2 bg-white flex justify-center items-center rounded-full">
                                    <livewire:favori-match :match="$match" :user="Auth::user()" :key="time().$match->id" />
                                </div>
                                <div>
                                    <p class="px-3 text-xs">Toi aussi tu veux que ce match soit commenté ?</p>
                                    <p class="text-xs px-3">Clique sur l'étoile</p>
                                </div>
                            </div>
                        </div>
                    @endif
                @elseif ($match->live == 'attente' && $match->date_match > now())
                    <a href="/login">
                        <div class="w-11/12 md:w-6/12 mx-auto">
                            <div
                                class="flex justify-start items-center bg-primary text-white px-1 py-2 rounded-lg border-2 border-white my-2">
                                <div
                                    class="h-12 w-12 shadow-2xl border-2 bg-white flex justify-center items-center rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 cursor-pointer text-red-700"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="px-3 text-xs">Toi aussi tu veux que ce match soit commenté ?</p>
                                    <p class="text-xs px-3 font-semibold">Connecte toi</p>
                                </div>
                            </div>
                        </div>
                    </a>
                @endauth
                @auth
                    @if (Auth::user()->first_com == 1 && $match->commentateur != null && $match->commentateur->user_id == Auth::user()->id)
                        <div class="bg-cool-gray-800 w-11/12 rounded-lg p-4 text-white m-auto my-2 text-center">
                            <h3 class="text-secondary text-center text-lg mb-4">Commenter facilement</h3>
                            <div class="my-4 mx-6 flex justify-center">
                                <div class="p-2">
                                    <div class="___class_+?208___">
                                        <p>Appuie sur ce bouton en bas de la page</p>
                                        <div
                                            class="my-4 mx-auto flex justify-evenly items-center bg-primary text-white px-1 py-2 rounded-full w-48 border-2 border-secondary">
                                            <div
                                                class="h-10 w-10 shadow-2xl border-2 border-secondary bg-primary flex justify-center items-center rounded-full">

                                            </div>
                                            <p class="px-3">Je commente</p>
                                        </div>
                                    </div>
                                    <p>Les logos des 2 équipes apparaissent.</p>
                                    <p>Choisis l'équipe</p>
                                    <p>Renseigne l'action suivante ↓</p>
                                    <div class="flex justify-evenly">
                                        <figure class="flex flex-col items-center justify-center">
                                            <figcaption>
                                                But !
                                            </figcaption>
                                            <img class="border-2 border-secondary rounded-full shadow-xl bg-white m-2 p-2"
                                                src="{{ asset('images/ball.png') }}" width="50px" height="50px"
                                                alt="But">
                                        </figure>
                                        <figure class="flex flex-col items-center justify-center">
                                            <figcaption>
                                                Carton !
                                            </figcaption>
                                            <img class="border-2 border-secondary rounded-full shadow-xl bg-white m-2 p-2"
                                                src="{{ asset('images/cards.png') }}" width="50px" height="50px"
                                                alt="Arret">
                                        </figure>
                                        <figure class="flex flex-col items-center justify-center">
                                            <figcaption>
                                                Arrêt !
                                            </figcaption>
                                            <img class="border-2 border-secondary rounded-full shadow-xl bg-white m-2 p-2"
                                                src="{{ asset('images/gants.png') }}" width="50px" height="50px"
                                                alt="Arret">
                                        </figure>

                                    </div>
                                    <p>Tu peux ajouter une photo de l'exploit si tu veux</p>
                                    <p>Valide ! et c'est tout... 😉</p>
                                    {{-- <div class="w-11/12 h-0.5 bg-white my-2"></div>
                                <div class="my-2">
                                    <div
                                        class="mx-auto text-white font-bold text-2xl bg-primary flex justify-center items-center w-20 h-20 my-3 rounded-full border-2 border-secondary">
                                        20
                                    </div>
                                    <p class="my-2">Tu es arrivé en retard ? Il y a eu un soucis pendant le match ?</p>
                                    <p class="my-2">Appuie sur la bulle de temps de jeu et modifie le</p>
                                </div> --}}
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="button" class="btn btnSecondary" wire:click="clickFirstCom"
                                    wire:model="firstCom">Fermer</button>
                            </div>
                        </div>
                    @endif
                    @if ($match->commentateur && $match->live == 'attente' && $match->commentateur->user->id == Auth::user()->id)
                        <div
                            class="bg-primary text-secondary p-4 rounded-lg m-6 flex flex-col justify-center items-center w-11/12 md:w-6/12 mx-auto">
                            <p>Plus qu'à lancer le match ! 💪</p>
                        </div>
                    @elseif($match->commentateur && $match->live == 'attente')
                        <div
                            class="bg-primary text-secondary p-4 rounded-lg m-6 flex flex-col justify-center items-center w-11/12 md:w-6/12 mx-auto">
                            <p>On attend le départ du commentateur</p>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 animate-spin" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                        </div>
                    @endif
                    @if ($match->commentateur)
                        <div class="flex justify-center my-6 w-11/12 m-auto lg:w-8/12">
                            @if ($match->commentateur != null && $match->commentateur->user->id == Auth::user()->id)
                                @if ($match->live == 'attente')
                                    <div x-data="{ open: false }" class="flex flex-col items-center">
                                        <button type="button" @click="open = true">
                                            <div
                                                class="bg-success text-gray-800 w-full h-full p-3 flex justify-evenly items-center rounded-lg">
                                                <img src="{{ asset('images/whistle.png') }}" class="h-12 mr-3">
                                                <p>Démarrer le match ?</p>
                                            </div>
                                        </button>
                                        <button x-show="open" @click.away="open = false" type="button"
                                            class="btn btnDanger" wire:click="timeZero" wire:model="commentator"
                                            x-transition:enter="transition ease-out duration-300"
                                            x-transition:enter-start="opacity-0 transform scale-90"
                                            x-transition:enter-end="opacity-100 transform scale-100"
                                            x-transition:leave="transition ease-in duration-300"
                                            x-transition:leave-start="opacity-100 transform scale-100"
                                            x-transition:leave-end="opacity-0 transform scale-90">
                                            GO GO GO !!!
                                        </button>
                                    </div>

                                @endif
                                @if ($match->live == 'debut')
                                    <div x-data="{ open: false }" class="flex flex-col items-center">
                                        <button type="button" @click="open = true">
                                            <div
                                                class="bg-success text-gray-800 w-full h-full p-3 flex justify-evenly items-center rounded-lg">
                                                <img src="{{ asset('images/whistle.png') }}" class="h-12 mr-3">
                                                <div>
                                                    <p>C'est la mi-temps ?</p>
                                                </div>
                                            </div>
                                        </button>
                                        <button x-show="open" @click.away="open = false" type="button"
                                            class="btn btnDanger" wire:click="timeMitemps" wire:model="type_comments"
                                            x-transition:enter="transition ease-out duration-300"
                                            x-transition:enter-start="opacity-0 transform scale-90"
                                            x-transition:enter-end="opacity-100 transform scale-100"
                                            x-transition:leave="transition ease-in duration-300"
                                            x-transition:leave-start="opacity-100 transform scale-100"
                                            x-transition:leave-end="opacity-0 transform scale-90">
                                            Go a la buvette !
                                        </button>
                                    </div>

                                @endif
                                @if ($match->live == 'mitemps')
                                    <div x-data="{ open: false }" class="flex flex-col items-center">
                                        <button @click="open = true" type="button">
                                            <div
                                                class="bg-success text-gray-800 w-full h-full p-3 flex justify-evenly items-center rounded-lg">
                                                <img src="{{ asset('images/whistle.png') }}" class="h-6 mr-3">
                                                <div>
                                                    <p>C'est la reprise ?</p>
                                                </div>
                                            </div>
                                        </button>
                                        <button x-show="open" @click.away="open = false" type="button"
                                            class="btn btnDanger" wire:click="timeReprise" wire:model="type_comments"
                                            x-transition:enter="transition ease-out duration-300"
                                            x-transition:enter-start="opacity-0 transform scale-90"
                                            x-transition:enter-end="opacity-100 transform scale-100"
                                            x-transition:leave="transition ease-in duration-300"
                                            x-transition:leave-start="opacity-100 transform scale-100"
                                            x-transition:leave-end="opacity-0 transform scale-90">
                                            Oui
                                        </button>
                                    </div>

                                @endif
                                @if ($match->live == 'repriseMT')
                                    <div x-data="{ open: false }" class="flex flex-col items-center">
                                        <button @click="open = true" type="button">
                                            <div
                                                class="bg-success text-gray-800 w-full h-full p-3 flex justify-evenly items-center rounded-lg">
                                                <img src="{{ asset('images/whistle.png') }}" class="h-12 mr-3">
                                                <div>
                                                    <p>Le match est terminé ? ⏱</p>
                                                </div>
                                                </p>
                                            </div>
                                        </button>
                                        <button x-show="open" @click.away="open = false" type="button"
                                            class="btn btnDanger" wire:click="timeFinDuMatch" wire:model="type_comments"
                                            x-transition:enter="transition ease-out duration-300"
                                            x-transition:enter-start="opacity-0 transform scale-90"
                                            x-transition:enter-end="opacity-100 transform scale-100"
                                            x-transition:leave="transition ease-in duration-300"
                                            x-transition:leave-start="opacity-100 transform scale-100"
                                            x-transition:leave-end="opacity-0 transform scale-90">
                                            Yes ! C'est vraiment fini !
                                        </button>
                                    </div>
                                @endif
                                {{-- @if ($match->live == 'finDeMatch' && !$match->debut_prolongations && $match->competition_id == 3 && $match->home_score == $match->away_score)
                                <button type="button" wire:click="prolongations">
                                    <div
                                        class="bg-success text-gray-800 w-full h-full p-3 flex justify-evenly items-center rounded-lg">
                                        <img src="{{ asset('images/whistle.png') }}" class="h-12 mr-3">
                                        <p>Début de la 1ère mi-temps des prolongations</p>
                                    </div>
                                </button>
                            @endif
                            @if ($match->live == 'prolongations1')
                                <button type="button" wire:click="miTempsProlongations">
                                    <div
                                        class="bg-success text-gray-800 w-full h-full p-3 flex justify-evenly items-center rounded-lg">
                                        <img src="{{ asset('images/whistle.png') }}" class="h-12 mr-3">
                                        <p>Mi-temps de prolongations</p>
                                    </div>
                                </button>
                            @endif
                            @if ($match->live == 'MTProlongations')
                                <button type="button" wire:click="secondeProlongation">
                                    <div
                                        class="bg-success text-gray-800 w-full h-full p-3 flex justify-evenly items-center rounded-lg">
                                        <img src="{{ asset('images/whistle.png') }}" class="h-12 mr-3">
                                        <p>Reprise de la seconde mi-temps des prolongations
                                        </p>
                                    </div>
                                </button>
                            @endif
                            @if ($match->live == 'prolongations2')
                                <button type="button" wire:click="finProlongations">
                                    <div
                                        class="bg-primary text-white w-full h-full p-3 flex justify-evenly items-center rounded-lg">
                                        <img src="{{ asset('images/whistle-white.png') }}" class="h-12 mr-3">
                                        <p>Fin des prolongations</p>
                                    </div>
                                </button>
                            @endif --}}
                                @if ($match->live == 'finDeMatch' && $match->home_score == $match->away_score && ($match->competition_id >= 3 && $match->competition_id <= 7) && (count($tabHome) == 0 || count($tabAway) == 0))
                                    <button type="button" wire:click="tirsAuBut">
                                        <div
                                            class="bg-primary text-white w-full h-full p-3 flex justify-evenly items-center rounded-lg">
                                            <img src="{{ asset('images/whistle-white.png') }}" class="h-12 mr-3">
                                            <p>Tirs au but !!!</p>
                                        </div>
                                    </button>
                                @endif
                            @endif
                        </div>
                    @endif
                    @if (empty($match->commentateur) && $match->date_match > now()->subHours(3))
                        <div x-data="{open: false}" class="flex flex-col justify-center items-center my-2">
                            <p class="py-2 px-3 underline mb-3">En attente d'un commentateur</p>
                            <button type="button" @click="open = true">
                                <div
                                    class="bg-success text-gray-800 w-full h-full p-3 flex justify-evenly items-center rounded-lg">
                                    <img src="{{ asset('images/whistle.png') }}" class="h-12 mr-3">
                                    <p>Je souhaite commenter 😎</p>
                                </div>
                            </button>
                            <button x-show="open" @click.away="open = false" type="button" class="btn btnDanger"
                                wire:click="becomeCommentator" wire:model="commentator"
                                x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0 transform scale-90"
                                x-transition:enter-end="opacity-100 transform scale-100"
                                x-transition:leave="transition ease-in duration-300"
                                x-transition:leave-start="opacity-100 transform scale-100"
                                x-transition:leave-end="opacity-0 transform scale-90">
                                Je confirme 😇
                            </button>
                        </div>
                    @endif
                @else
                    @if (empty($match->commentateur) && $match->date_match > now()->subHours(3))
                        <div class="flex flex-col items-center my-6">
                            <div class="">
                                <p class=" py-2 px-3 underline mb-3">En attente d'un
                                    commentateur</p>
                            </div>
                            <a href="/login">
                                <button class="btn btnSuccess">
                                    <p>Tu souhaites commenter le match ?</p>
                                    <p class="text-sm">Connecte toi</p>
                                </button>
                            </a>
                        </div>
                    @else
                        <div class="flex flex-col items-center my-6">
                            <div class="">
                                <p class=" py-2 px-3 underline mb-3">
                                    Il n'est plus possible de commenter</p>
                            </div>
                        </div>
                    @endif
                @endauth
        </form>
        <!-- fin option commentaires "match" -->

        @if (!empty($photos))
            <div class="w-full">
                <div wire:ignore>
                    <div class="splide">
                        <div class="splide__track">
                            <ul class="splide__list">
                                @foreach ($photos as $photo)
                                    <li class="splide__slide">
                                        <div class="splide__slide__container">
                                            <img src="{{ asset($photo->images) }}" alt=""
                                                class="rounded-lg m-1 h-56">
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            var splide = new Splide('.splide', {
                                type: 'loop',
                                perMove: 1,
                                // height: '14rem',
                                focus: 'start',
                                padding: '20%',
                                trimSpace: false,
                                autoWidth: true,
                                autoplay: true,
                                pauseOnHover: true,
                                resetProgress: true,
                            });
                            splide.mount();
                        });
                    </script>
                </div>
                <div class="flex justify-center my-4" wire:click="btnStorePhotoMatch">
                    @if ($match->date_match > now()->subHours(3))
                        <button type="button"
                            class="btn btnPrimary">{{ $store_photo_match ? 'Fermer le menu' : 'Ajouter une photo' }}</button>
                    @endif

                </div>
                @if ($store_photo_match)
                    <form wire:submit.prevent="storePhotoMatch">
                        <div
                            class="{{ $photo_match ? 'hidden' : 'block' }} sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5 mt-5 mb-10 bg-white rounded-lg p-4">
                            <label for="cover-photo" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                Photo de match
                            </label>
                            <div class="mt-1 sm:mt-0 sm:col-span-2">
                                <div
                                    class="max-w-lg flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                    <div class="space-y-1 text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                                            viewBox="0 0 48 48" aria-hidden="true">
                                            <path
                                                d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <div class="flex text-sm text-gray-600">
                                            <label for="photo_match"
                                                class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                                <span>Ajouter une photo</span>
                                                <input id="photo_match" name="photo_match" type="file"
                                                    wire:model="photo_match" class="sr-only">
                                            </label>
                                        </div>
                                        <p class="text-xs text-gray-500">
                                            PNG, JPG, GIF up to 10MB
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @error('photo_match')
                            <div class="bg-orange-200 text-orange-700 px-2 py-1 rounded-md">{{ $message }}</div>
                        @enderror
                        @if ($photo_match)
                            <div class="m-4">
                                Prévisualisation avant validation :
                                <img class="rounded-lg shadow-xl" src="{{ $photo_match->temporaryUrl() }}">
                            </div>
                            <div class="hidden" wire:loading wire:target="photo_match">
                                <svg class="animate-spin mr-2 h-5 w-5 text-primary" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                        stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>
                            </div>
                            <div class="flex justify-between">
                                <button type="button" class="btn btnPrimary"
                                    wire:click="storePhotoMatch({{ $match->id }})">Je l'envoi</button>
                                <button type="button" class="btn"
                                    wire:click="btnStorePhotoMatch">J'annule</button>
                            </div>
                        @endif
                    </form>
                @endif
            </div>
        @endif

        <!-- Affichage des commentaires -->
        @if ($match->commentateur)
            <div
                class="my-2 w-11/12 lg:w-4/12 mx-auto bg-white text-primary rounded-lg shadow-2xl text-sm overflow-hidden">
                <div>
                    <h3 class="bg-secondary text-center">Le "Thierry Roland" du jour</h3>
                </div>
                <div class=" flex justify-around items-center">
                    <div>
                        <div class="flex justify-start items-center">
                            <img class="rounded-full h-8 w-8 object-cover mr-2"
                                src="{{ $match->commentateur->user->profile_photo_url }}">
                            <div class="flex items-center">
                                <p class="font-semibold">{{ ucfirst($match->commentateur->user->pseudo) }}</p>
                                <p class="text-xs mx-2">{{ $sommeMerci }}</p>
                            </div>
                        </div>
                    </div>
                    @if ($match->id != 0)
                        <div>
                            <button class="btn btnPrimary" wire:click="merci">Merci ! <span
                                    class="bg-white px-1 text-primary rounded-sm ml-2">{{ $match->commentateur->merci }}</span></button>
                        </div>
                    @endif
                </div>
            </div>
        @endif
        @if ($match->id == 0)
            <div class="flex flex-col items-center justify-center bg-secondary p-8">
                <p class="font-semibold uppercase">Ce match est fictif</p>
                <p class="text-sm">Il sert d'exemple pour découvrir un match commenté</p>
            </div>
        @endif
        @if ($infoMatch)
            <div class="flex justify-center">
                <p class="bg-darkSuccess text-white px-3 py-2 rounded-md">{{ $infoMatch }}</p>
            </div>
        @endif
        <div class="my-4 w-11/12 m-auto lg:flex lg:justify-around">
            <div class="m-auto sm:w-10/12 lg:w-8/12">
                @if ($match->live == 'tab' || (count($tabHome) != 0 && count($tabAway) != 0))
                    <div class="my-10">
                        <h3 class="flex justify-center text-2xl px-2 py-1 bg-primary text-white rounded-lg my-2 ">Tirs
                            au but</h3>
                        <div class="p-4 border-2 border-primary rounded-lg mb-2 bg-white">
                            <p class="uppercase text-2xl truncate">{{ $match->homeClub->name }}</p>
                            <div class="flex">
                                @if (count($tabHome) != 0)
                                    @foreach ($tabHome as $tab)
                                        <div
                                            class="h-8 w-8 border border-primary rounded-md m-1 flex justify-center items-center font-bold text-xl {{ $tab->score ? 'bg-success' : 'bg-danger' }}">
                                            @if ($tab->score)
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                            @else
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            @endif
                                        </div>
                                    @endforeach
                                @else
                                    <div
                                        class="h-8 w-8 border border-primary rounded-md m-1 flex justify-center items-center font-bold text-xl">
                                    </div>
                                @endif
                            </div>
                            @auth
                                @if ($match->commentateur->user_id == Auth::user()->id)
                                    @if ($match->live == 'tab')
                                        @if ($tabHome < $tabAway || count($tabHome) == 0)
                                            <div class="flex">
                                                <button type="button" wire:click="tabMarque({{ $match->homeClub }})"
                                                    class="w-1/2 btn btnSuccess">Marqué</button>
                                                <button type="button" wire:click="tabLoupe({{ $match->homeClub }})"
                                                    class="w-1/2 btn btnDanger">Loupé</button>
                                            </div>
                                        @endif
                                    @endif
                                @endif
                            @endauth
                        </div>
                        <div class="p-4 border-2 border-primary rounded-lg bg-white">
                            <p class="uppercase text-2xl truncate">{{ $match->awayClub->name }}</p>
                            <div class="flex">
                                @if (count($tabAway) != 0)
                                    @foreach ($tabAway as $tab)
                                        <div
                                            class="h-8 w-8 border border-primary rounded-md m-1 flex justify-center items-center font-bold text-xl {{ $tab->score ? 'bg-success' : 'bg-danger' }}">
                                            @if ($tab->score)
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                            @else
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            @endif
                                        </div>
                                    @endforeach
                                @else
                                    <div
                                        class="h-8 w-8 border border-primary rounded-md m-1 flex justify-center items-center font-bold text-xl">
                                    </div>
                                @endif
                            </div>
                            @auth
                                @if ($match->commentateur->user_id == Auth::user()->id)
                                    @if ($match->live == 'tab')
                                        @if ($tabAway < $tabHome || count($tabAway) == 0)
                                            <div class="flex">
                                                <button type="button" wire:click="tabMarque({{ $match->awayClub }})"
                                                    class="w-1/2 btn btnSuccess">Marqué</button>
                                                <button type="button" wire:click="tabLoupe({{ $match->awayClub }})"
                                                    class="w-1/2 btn btnDanger">Loupé</button>
                                            </div>
                                        @endif
                                    @endif
                                @endif
                            @endauth
                        </div>
                    </div>
                @endif
                @auth
                    @if ($match->commentateur)
                        @if ($match->commentateur->user_id == Auth::user()->id)
                            <div class="mx-6 my-2">
                                <p class="text-xs cursor-pointer underline" wire:click="needHelp">Besoin d'aide ?</p>
                            </div>
                        @endif
                    @endif
                @endauth
                @foreach ($commentsMatch as $comment)
                    <x-commentaire-match :comment="$comment" :match="$match" :reactions="$reactions">
                    </x-commentaire-match>
                @endforeach
            </div>
        </div>
        <!-- Fin affichage des commentaires -->
    </div>
</div>
