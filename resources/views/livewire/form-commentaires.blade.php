<div>
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
                                    <i class="fas fa-plus text-2xl text-white"></i>
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
                        <i class="fas fa-times text-2xl text-white"></i>
                    </div>
                </button>
            </div>
            <div class="fixed bg-white top-0 bottom-0 left-0 right-0 z-40 border border-gray-400">
                <div class="fixed bottom-16 left-2 z-40">
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
                <div class="flex justify-center">
                    <div
                        class="text-white font-bold text-2xl bg-primary flex justify-center items-center w-20 h-20 my-3 rounded-full border-2 border-secondary">
                        <p>{{ $minute }}</p>
                    </div>
                </div>
                <div class="fixed flex justify-center top-28 left-1 right-1 z-50 my-6 w-11/12 m-auto lg:w-8/12">
                    @if ($match->commentateur != null && $match->commentateur->user->id == Auth::user()->id)
                        @if ($match->live == 'attente')
                            <button type="button" wire:click="timeZero" wire:model="commentator">
                                <div
                                    class="bg-primary text-white w-full h-full p-3 flex justify-evenly items-center rounded-lg">
                                    <img src="{{ asset('images/whistle-white.png') }}"" class="   h-12 mr-3">
                                    <p class="font-bold">Démarrer le match</p>
                                </div>
                            </button>
                        @endif
                        @if ($match->live == 'debut')
                            <button type="button" wire:click="timeMitemps" wire:model="type_comments">
                                <div
                                    class="bg-primary text-white w-full h-full p-3 flex justify-evenly items-center rounded-lg">
                                    <img src="{{ asset('images/whistle-white.png') }}" class="h-12 mr-3">
                                    <p class="font-bold">C'est la mi-temps</p>
                                </div>
                            </button>
                        @endif
                        @if ($match->live == 'mitemps')
                            <button type="button" wire:click="timeReprise" wire:model="type_comments">
                                <div
                                    class="bg-primary text-white w-full h-full p-3 flex justify-evenly items-center rounded-lg">
                                    <img src="{{ asset('images/whistle-white.png') }}" class="h-12 mr-3">
                                    <p class="font-bold">C'est la reprise</p>
                                </div>
                            </button>
                        @endif
                        @if ($match->live == 'repriseMT')
                            <button type="button" wire:click="timeFinDuMatch" wire:model="type_comments">
                                <div
                                    class="bg-primary text-white w-full h-full p-3 flex justify-evenly items-center rounded-lg">
                                    <img src="{{ asset('images/whistle-white.png') }}" class="h-12 mr-3">
                                    <div>
                                        <p class="font-bold">Le match est terminé ! ⏱</p>
                                        <p class="text-xs">On valide aux 3 coups de sifflet... <br>pas avant 😉
                                    </div>

                                    </p>
                                </div>
                            </button>
                        @endif
                        @if ($match->live == 'finDeMatch' && !$match->debut_prolongations && $match->competition_id == 3 && $match->home_score == $match->away_score)
                            <button type="button" wire:click="prolongations">
                                <div
                                    class="bg-primary text-white w-full h-full p-3 flex justify-evenly items-center rounded-lg">
                                    <img src="{{ asset('images/whistle-white.png') }}" class="h-12 mr-3">
                                    <p>Début de la 1ère mi-temps des prolongations</p>
                                </div>
                            </button>
                        @endif
                        @if ($match->live == 'prolongations1')
                            <button type="button" wire:click="miTempsProlongations">
                                <div
                                    class="bg-primary text-white w-full h-full p-3 flex justify-evenly items-center rounded-lg">
                                    <img src="{{ asset('images/whistle-white.png') }}" class="h-12 mr-3">
                                    <p>Mi-temps de prolongations</p>
                                </div>
                            </button>
                        @endif
                        @if ($match->live == 'MTProlongations')
                            <button type="button" wire:click="secondeProlongation">
                                <div
                                    class="bg-primary text-white w-full h-full p-3 flex justify-evenly items-center rounded-lg">
                                    <img src="{{ asset('images/whistle-white.png') }}" class="h-12 mr-3">
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
                        @endif
                        @if ($match->live == 'finProlongations' && $match->home_score == $match->away_score)
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
            </div>
        @endif
    </div>
    <div {{ $match->live != 'reporte' ? 'wire:poll.5000ms' : '' }}>
        <form wire:submit.prevent="saveComment">
            @csrf
            <!-- affichage bannière du match -->
            <div class="backMatch">
                <div class="py-6">
                    <div class="relative bg-primary text-white m-auto text-center shadow-2xl p-2 max-w-md">
                        @if ($match->region_id)
                            <h2>{{ $match->region->name }}</h2>
                        @endif
                        <h3 class="text-sm">{{ $match->competition->name }}</h3>
                        <div class="flex flex-row justify-center">
                            @if ($match->divisionRegion)
                                <p class="text-xs mr-1">{{ $match->divisionRegion->name }}</p>
                            @endif
                            @if ($match->divisionDepartment)
                                <p class="text-xs mr-1">{{ $match->divisionDepartment->name }}</p>
                            @endif
                            @if ($match->group)
                                <p class="text-xs ml-1">{{ $match->group->name }}</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-12 lg:mx-16 xl:mx-24 mb-2">
                    <div class="col-span-5 overflow-hidden">
                        <a href="{{ route('clubs.show', $match->homeClub->id) }}">
                            <div
                                class="bg-primary p-2 text-secondary flex flex-col lg:flex-row lg:items-center lg:rounded-l-full">

                                <div class="relative flex justify-center">
                                    <div
                                        class="logo h-16 w-16 sm:h-20 sm:w-20 lg:h-32 lg:w-32 cursor-pointer lg:mr-1 xl:mr-4">
                                        @if ($match->id == 0)
                                            <img class="object-contain w-full" src="{{ asset('images/100000.jpg') }}"
                                                alt="logo">
                                        @else
                                            @if ($match->homeClub->logo_path)
                                                <img class="object-contain"
                                                    src="{{ asset($match->homeClub->logo_path) }}"
                                                    alt="Logo de {{ $match->homeClub->name }}">
                                            @else
                                                <img class="object-contain"
                                                    src="https://android-apiapp.azureedge.net/common/bib_img/logo/{{ $match->homeClub->numAffiliation }}.jpg"
                                                    alt="Logo de {{ $match->homeClub->name }}">
                                            @endif
                                        @endif
                                    </div>
                                </div>
                                <div>
                                    <p class="truncate text-center sm:font-bold lg:text-2xl">
                                        {{ $match->homeClub->name }}
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div
                        class="relative col-span-2 bg-gradient-to-r from-primary to-secondary flex flex-col justify-center items-center">
                        <div class="flex justify-center mt-2">
                            <div class="z-10">
                                <p
                                    class="bg-white rounded-sm mr-1 flex justify-center w-4 text-3xl px-4 sm:text-5xl sm:px-6 font-bold">
                                    {{ $home_score }}
                                </p>
                                @if ($btnScore)
                                    <div class="flex justify-evenly items-center mt-1 z-10">
                                        <button type="button" wire:click="decrementHomeScore"
                                            class="focus:outline-none">
                                            <span
                                                class="h-4 w-4 flex items-center justify-center text-black bg-danger font-bold">-</span>
                                        </button>
                                        <button type="button" wire:click="incrementHomeScore"
                                            class="focus:outline-none">
                                            <span
                                                class="h-4 w-4 flex items-center justify-center bg-success text-black font-bold">+</span>
                                        </button>
                                    </div>
                                @endif
                            </div>
                            <div class="z-10">
                                <p
                                    class="bg-white rounded-sm ml-1 flex justify-center w-4 text-3xl px-4 sm:text-5xl sm:px-6 font-bold">
                                    {{ $away_score }}
                                </p>
                                @if ($btnScore)
                                    <div class="flex justify-evenly items-center mt-1 z-10">
                                        <button type="button" wire:click="decrementAwayScore"
                                            class="focus:outline-none">
                                            <span
                                                class="h-4 w-4 flex items-center justify-center text-black bg-danger font-bold">-</span>
                                        </button>
                                        <button type="button" wire:click="incrementAwayScore"
                                            class="focus:outline-none">
                                            <span
                                                class="h-4 w-4 flex items-center justify-center bg-success text-black font-bold">+</span>
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </div>
                        {{-- @auth
                            @if ((Auth::user()->role == 'super-admin' || $match->commentateur) && $match->live != 'attente')
                                @if (!$btnScore)
                                    <div class="mt-2">
                                        <button type="button" wire:click="clickBtnScore" class="text-white text-xs">Corriger
                                            le score</button>
                                    </div>
                                @endif
                            @endif
                        @endauth --}}
                        @if (count($tabHome) != 0 && count($tabAway) != 0)
                            <div class="text-white flex flex-col items-center justify-center ">
                                <p class="text-xs">Tab</p>
                                <p class="font-bold">{{ $scoreTabHome }} - {{ $scoreTabAway }} </p>
                            </div>
                        @endif
                    </div>
                    <div class="col-span-5 overflow-hidden z-0">
                        <a href="{{ route('clubs.show', $match->awayClub->id) }}">
                            <div
                                class="bg-secondary p-2 text-primary flex flex-col-reverse lg:flex-row lg:items-center lg:justify-end lg:rounded-r-full">
                                <div>
                                    <p class="truncate text-center lg:text-left sm:font-bold lg:text-2xl">
                                        {{ $match->awayClub->name }}
                                    </p>
                                </div>
                                <div class="flex justify-center">
                                    <div
                                        class="logo h-16 w-16 sm:h-20 sm:w-20 lg:h-32 lg:w-32 cursor-pointer lg:ml-1 xl:ml-4">
                                        @if ($match->id == 0)
                                            <img class="object-contain w-full"
                                                src="{{ asset('images/200000.jpg') }}" alt="logo">
                                        @else
                                            @if ($match->awayClub->logo_path)
                                                <img class="object-contain"
                                                    src="{{ asset($match->awayClub->logo_path) }}"
                                                    alt="Logo de {{ $match->awayClub->name }}">
                                            @else
                                                <img class="object-contain"
                                                    src="https://android-apiapp.azureedge.net/common/bib_img/logo/{{ $match->awayClub->numAffiliation }}.jpg"
                                                    alt="Logo de {{ $match->awayClub->name }}">
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="grid grid-cols-12">
                    <div class="col-span-4">
                        @foreach ($commentsMatch->sortBy('minute') as $comment)
                            @if ($comment->statistic)
                                @if ($comment->team_action == 'home' && $comment->type_action == 'goal')
                                    <div class="flex flex-row justify-end items-center m-auto overflow-hidden mx-1">
                                        <div
                                            class="bg-primary text-secondary font-bold px-2 py-1 flex justify-end items-center w-full sm:w-48 rounded-lg mb-1">
                                            <p class="text-xs md:text-sm px-2 truncate">
                                                {{ substr($comment->statistic->player->first_name, 0, 1) }}.
                                                {{ $comment->statistic->player->last_name }}
                                            </p>
                                            <p class="text-xs w-8 text-right px-2">{{ $comment->minute }}'</p>
                                            <p class="text-xs">⚽</p>
                                        </div>
                                    </div>
                                @endif
                            @endif
                        @endforeach
                    </div>
                    <div class="col-span-4 flex justify-center" wire:click="clickTpsDeJeu">
                        <div
                            class="text-white font-bold text-2xl bg-primary flex justify-center items-center w-20 h-20 my-3 rounded-full border-2 border-secondary">
                            @if ($match->live != 'attente' && $match->live != 'finDeMatch' && $match->live != 'reporte')
                                <p>{{ $minute }}</p>
                            @else
                                <div class="flex flex-col text-sm items-center justify-center">
                                    <p>{{ $match->date_match->formatLocalized('%H:%M') }}</p>
                                    <p>{{ $match->date_match->formatLocalized('%d/%m/%y') }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-span-4">
                        @foreach ($commentsMatch->sortBy('minute') as $comment)
                            @if ($comment->team_action == 'away' && $comment->type_action == 'goal')
                                <div class="flex flex-row justify-start items-center m-auto overflow-hidden mx-1">
                                    <div
                                        class="bg-secondary text-primary font-bold px-2 py-1 flex flex-row-reverse justify-end items-center w-full sm:w-48 rounded-lg mb-1">
                                        <p class="text-xs md:text-sm px-2 truncate">
                                            {{ substr($comment->statistic->player->first_name, 0, 1) }}.
                                            {{ $comment->statistic->player->last_name }}
                                        </p>
                                        <p class="text-xs w-8 text-right px-2">{{ $comment->minute }}'</p>
                                        <p class="text-xs">⚽</p>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                {{-- @if ($btnTpsDejeu)
                    <div class="flex flex-col items-center justify-center">
                        <div class="bg-primary rounded-lg p-4 w-60 flex flex-col items-center mb-3">
                            <label class="sr-only" for="minuteModifiee">Modifier</label>
                        <input class="bg-transparent text-white border border-white text-center font-bold px-2 py-1 text-xl" min="0" max="125" type="number" name="minuteModifiee" id="minuteModifiee" wire:model="minuteModifiee" autofocus placeholder="{{$minute}}" >
                        <button class="btn btnSuccess" type="button" wire:click="corrigerTpsDeJeu">Valider</button>
                        </div>
                    </div>
                @endif --}}
                <div class="flex flex-col items-center justify-center w-full">
                    <div class="flex justify-center">
                        @if ($match->live != 'reporte' && $match->live != 'attente' && $match->live != 'finDeMatch')
                            <div
                                class="relative uppercase inline-block text-primary font-bold bg-secondary px-2 rounded-sm text-xl">
                                <div class="animate-ping absolute -top-0.5 -right-0.5 bg-red-500 h-3 w-3 rounded-full">
                                </div>
                                LIVE
                            </div>
                        @endif
                    </div>
                    <div class="flex justify-center items-center">
                        @if ($match->live != 'attente' && $match->live != 'finDeMatch' && $match->live != 'reporte')
                            <div class="text-center flex justify-center font-bold">
                                <p class="px-4 bg-primary text-secondary rounded-tl-md">
                                    {{ $match->date_match->formatLocalized('%d/%m/%y') }}
                                </p>
                                <p class="px-4 bg-primary text-secondary rounded-tr-md">
                                    {{ $match->date_match->formatLocalized('%H:%M') }}
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="bg-gray-900 px-8 py-2 text-white text-center flex justify-center items-center">
                <p>Spectateurs : <span class="ml-2 font-bold">{{ count($visitors) }}</span></p>
            </div>
            @if ($nbrFavoris > 0 && $match->live == 'attente')
                <div class="bg-secondary text-primary rounded-lg relative flex justify-center p-1 shadow-lg m-2">
                    @if ($nbrFavoris == 1)
                        <p>{{ $nbrFavoris }} personne aimerait un direct LIVE</p>
                    @else
                        <p>{{ $nbrFavoris }} personnes aimeraient un direct LIVE</p>
                    @endif
                </div>
            @endif

            <!-- fin affichage bannière du match -->

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
                    {{-- <div class="flex items-center text-white m-auto my-4">
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
                        </div> --}}
                    @error('type_comments')
                        <span class="error">{{ $message }}</span>
                    @enderror
                    {{-- @if ($file)
                            <div class="flex flex-col items-center">
                                Aperçu de l'image :
                                <img class="w-36" src="{{ $file->temporaryUrl() }}">
                            </div>
                        @endif
                        @error('file')
                            <span class="alert alert-danger">{{ $message }}</span>
                        @enderror --}}
                    <div class="flex flex-row justify-center items-center mt-4">
                        <label class="___class_+?188___" for="minuteCom">Temps de jeu</label>
                        <input class="border border-black mx-2 py-1 text-center outline-none" type="number"
                            name="minuteCom" wire:model="minuteCom" min="1" max="125">
                        @error('minuteCom')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mt-6 flex items-center justify-center">
                        <label for="exit" class="mr-6 cursor-pointer" wire:click="retour">Retour</label>
                        <button wire:loading.attr="disabled" wire:loading.class.remove="btnPrimary" wire:target="file"
                            class="btn btnPrimary" type="submit">Je commente</button>
                        <input class="hidden" type="radio" id="exit" wire:model="team_action"
                            name="team_action" value="">
                    </div>
                </div>
            </div>
            <!----------------------
                Options commentaires "match"
                    ------------------------->
            @auth
                @if (!Auth::user()->isFavoriMatch($match) && $match->x == 'attente')
                    <div>
                        <div
                            class="flex justify-start items-center bg-primary text-white px-1 py-2 rounded-lg w-full border-2 border-white my-2">
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
            @else
                <a href="/login">
                    <div
                        class="flex justify-start items-center bg-primary text-white px-1 py-2 rounded-lg w-full border-2 border-white my-2">
                        <div class="h-12 w-12 shadow-2xl border-2 bg-white flex justify-center items-center rounded-full">
                            <i class="far fa-star cursor-pointer text-red-700 text-2xl"></i>
                        </div>
                        <div>
                            <p class="px-3 text-xs">Toi aussi tu veux que ce match soit commenté ?</p>
                            <p class="text-xs px-3 font-semibold">Connecte toi</p>
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
                                            <i class="fas fa-plus text-2xl text-white"></i>
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
                                            src="{{ asset('images/ball.png') }}" width="50px" height="50px" alt="But">
                                    </figure>
                                    <figure class="flex flex-col items-center justify-center">
                                        <figcaption>
                                            Carton !
                                        </figcaption>
                                        <img class="border-2 border-secondary rounded-full shadow-xl bg-white m-2 p-2"
                                            src="{{ asset('images/cards.png') }}" width="50px" height="50px" alt="Arret">
                                    </figure>
                                    <figure class="flex flex-col items-center justify-center">
                                        <figcaption>
                                            Arrêt !
                                        </figcaption>
                                        <img class="border-2 border-secondary rounded-full shadow-xl bg-white m-2 p-2"
                                            src="{{ asset('images/gants.png') }}" width="50px" height="50px" alt="Arret">
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
                <div class="mt-6 mx-auto sm:w-11/12 md:w-9/12">
                    @if ($match->live == 'reporte')
                        <div class="flex justify-center items-center my-6">
                            <p class="bg-danger font-bold py-2 px-3">Le match est reporté à une date ultérieure</p>
                        </div>
                    @endif
                    @if ($match->commentateur)
                        {{-- <div class="my-6 w-11/12 m-auto lg:w-8/12">
                            @if ($match->commentateur != null && $match->commentateur->user->id == Auth::user()->id)
                                @if ($match->live == 'attente')
                                    <button type="button"
                                        class="relative commentaires h-24 bg-white commandeMatch items-stretch w-full focus:outline-none rounded-lg"
                                        wire:click="timeZero" wire:model="commentator">
                                        <div
                                            class="minuteCommentaires w-24 commandeMatch flex flex-col justify-center items-center">
                                            <img src="{{ asset('images/whistle-white.png') }}">
                                        </div>
                                        <div class="bg-white w-full h-full p-3 flex flex-col justify-center items-center">
                                            <p class="font-bold">Démarrer le match</p>
                                        </div>
                                    </button>
                                @endif
                                @if ($match->live == 'debut')
                                    <button type="button"
                                        class="relative commentaires h-24 bg-white commandeMatch items-stretch w-full focus:outline-none rounded-lg"
                                        wire:click="timeMitemps" wire:model="type_comments">
                                        <div
                                            class="minuteCommentaires w-24 commandeMatch flex flex-col justify-center items-center">
                                            <img src="{{ asset('images/whistle-white.png') }}">
                                        </div>
                                        <div class="bg-white w-full h-full p-3 flex flex-col justify-center items-center">
                                            <p class="font-bold">C'est la mi-temps</p>
                                        </div>
                                    </button>
                                @endif
                                @if ($match->live == 'mitemps')
                                    <button type="button"
                                        class="relative commentaires h-24 bg-white commandeMatch items-stretch w-full focus:outline-none rounded-lg"
                                        wire:click="timeReprise" wire:model="type_comments">
                                        <div
                                            class="minuteCommentaires w-24 commandeMatch flex flex-col justify-center items-center">
                                            <img src="{{ asset('images/whistle-white.png') }}">
                                        </div>
                                        <div class="bg-white w-full h-full p-3 flex flex-col justify-center">
                                            <p class="font-bold">C'est la reprise</p>
                                        </div>
                                    </button>
                                @endif
                                @if ($match->live == 'repriseMT')
                                    <button type="button"
                                        class="relative commentaires h-24 bg-white commandeMatch items-stretch w-full focus:outline-none rounded-lg"
                                        wire:click="timeFinDuMatch" wire:model="type_comments">
                                        <div
                                            class="minuteCommentaires w-24 commandeMatch flex flex-col justify-center items-center">
                                            <img src="{{ asset('images/whistle-white.png') }}">
                                        </div>
                                        <div class="bg-white w-full h-full p-3 flex flex-col justify-center">
                                            <p class="font-bold">Le match est terminé ! ⏱</p>
                                            <p class="text-xs">On valide aux 3 coups de sifflet... <br>pas avant 😉
                                            </p>
                                        </div>
                                    </button>
                                @endif
                                @if ($match->live == 'finDeMatch' && !$match->debut_prolongations && $match->competition_id == 3 && $match->home_score == $match->away_score)
                                    <button type="button"
                                        class="relative commentaires h-24 bg-white commandeMatch items-stretch w-full focus:outline-none minHeight16"
                                        wire:click="prolongations">
                                        <div
                                            class="minuteCommentaires w-24 commandeMatch flex flex-col justify-center items-center">
                                            <img src="{{ asset('images/whistle-white.png') }}">
                                        </div>
                                        <div class="bg-white w-full h-full p-3 flex flex-col justify-center items-center">
                                            <p class="">Début de la 1ère mi-temps des prolongations</p>
                                        </div>
                                    </button>
                                @endif
                                @if ($match->live == 'prolongations1')
                                    <button type="button"
                                        class="relative commentaires h-24 bg-white commandeMatch items-stretch w-full focus:outline-none minHeight16"
                                        wire:click="miTempsProlongations">
                                        <div
                                            class="minuteCommentaires w-24 commandeMatch flex flex-col justify-center items-center">
                                            <img src="{{ asset('images/whistle-white.png') }}">
                                        </div>
                                        <div class="bg-white w-full h-full p-3 flex flex-col justify-center items-center">
                                            <p class="">Mi-temps de prolongations</p>
                                        </div>
                                    </button>
                                @endif
                                @if ($match->live == 'MTProlongations')
                                    <button type="button"
                                        class="relative commentaires h-24 bg-white commandeMatch items-stretch w-full focus:outline-none minHeight16"
                                        wire:click="secondeProlongation">
                                        <div
                                            class="minuteCommentaires w-24 commandeMatch flex flex-col justify-center items-center">
                                            <img src="{{ asset('images/whistle-white.png') }}">
                                        </div>
                                        <div class="bg-white w-full h-full p-3 flex flex-col justify-center items-center">
                                            <p class="">Reprise de la seconde mi-temps des prolongations
                                            </p>
                                        </div>
                                    </button>
                                @endif
                                @if ($match->live == 'prolongations2')
                                    <button type="button"
                                        class="relative commentaires h-24 bg-white commandeMatch items-stretch w-full focus:outline-none minHeight16"
                                        wire:click="finProlongations">
                                        <div
                                            class="minuteCommentaires w-24 commandeMatch flex flex-col justify-center items-center">
                                            <img src="{{ asset('images/whistle-white.png') }}">
                                        </div>
                                        <div class="bg-white w-full h-full p-3 flex flex-col justify-center items-center">
                                            <p class="">Fin des prolongations</p>
                                        </div>
                                    </button>
                                @endif
                                @if ($match->live == 'finProlongations' && $match->home_score == $match->away_score)
                                    <button type="button"
                                        class="relative commentaires h-24 bg-white commandeMatch items-stretch w-full focus:outline-none minHeight16"
                                        wire:click="tirsAuBut">
                                        <div
                                            class="minuteCommentaires w-24 commandeMatch flex flex-col justify-center items-center">
                                            <img src="{{ asset('images/whistle-white.png') }}">
                                        </div>
                                        <div class="bg-white w-full h-full p-3 flex flex-col justify-center items-center">
                                            <p class="">Tirs au but !!!</p>
                                        </div>
                                    </button>
                                @endif
                            @endif
                        </div> --}}
                    @endif
                </div>
                @if (empty($match->commentateur) && $match->live != 'finDeMatch')
                    <div class="flex justify-center items-center my-2">
                        <p class="py-2 px-3 underline">En attente d'un commentateur</p>
                    </div>
                    <button type="button"
                        class="relative commentaires h-24 bg-white commandeMatch items-stretch w-full focus:outline-none minHeight16"
                        wire:click="becomeCommentator" wire:model="commentator">
                        <div class="minuteCommentaires w-24 commandeMatch flex flex-col justify-center items-center">
                            <img src="{{ asset('images/whistle-white.png') }}">
                        </div>
                        <div class="bg-white w-full h-full p-3 flex flex-col justify-center items-center">
                            <p>Je souhaite commenter ⏱</p>
                            @if (\Session::has('warning'))
                                <div class="message-alert warning">
                                    <i
                                        class="fas fa-exclamation-circle text-5xl text-white rounded-full shadow-xl m-4"></i>
                                    <p> {!! \Session::get('warning') !!}</p>
                                </div>
                            @endif
                        </div>
                    </button>
                @endif
            @else
                @if (empty($match->commentateur) && $match->live != 'finDeMatch')
                    <div class="flex justify-center items-center my-6">
                        <p class="bg-primary text-white py-2 px-3">En attente d'un commentateur</p>
                    </div>
                    <a href="/login">
                        <div
                            class="relative commentaires h-24 bg-white commandeMatch items-stretch w-full focus:outline-none">
                            <div class="minuteCommentaires w-24 commandeMatch flex flex-col justify-center items-center">
                                <img src="{{ asset('images/login.png') }}" alt="">
                            </div>
                            <div class="bg-white w-full h-full p-3 flex flex-col justify-center">
                                <p class="font-bold">Tu souhaites commenter le match ?</p>
                                <p>Connecte toi →</p>
                            </div>
                        </div>
                    </a>
                @endif
            @endauth
        </form>
        <!-- fin option commentaires "match" -->

        <!-- Affichage des commentaires -->
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
        <div class="my-10 w-11/12 m-auto lg:flex lg:justify-around">
            <div class="m-auto sm:w-10/12 lg:w-8/12">
                @if (($match->fin_prolongations && $match->live == 'tab') || (count($tabHome) != 0 && count($tabAway) != 0))
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
                                            <i class="{{ $tab->score ? 'fas fa-check' : 'fas fa-times' }}"></i>
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
                                            <i class="{{ $tab->score ? 'fas fa-check' : 'fas fa-times' }}"></i>
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
                    <div class="relative commentaires minHeight16 h-auto {{ $comment->team_action }}"
                        x-data="{ open: false }">
                        <div
                            class="minuteCommentaires w-24 sm:w-32 {{ $comment->team_action }} p-4 flex flex-col items-center">
                            <div>
                                <p class="text-lg mb-4">{{ $comment->minute }}'</p>
                            </div>
                            @if ($comment->team_action == 'home')
                                <div class="logo h-12 w-12 cursor-pointer">
                                    @if ($match->homeClub->logo_path)
                                        <img class="object-contain" src="{{ asset($match->homeClub->logo_path) }}"
                                            alt="Logo de {{ $match->homeClub->name }}">
                                    @else
                                        <img class="object-contain"
                                            src="https://android-apiapp.azureedge.net/common/bib_img/logo/{{ $match->homeClub->numAffiliation }}.jpg"
                                            alt="Logo de {{ $match->homeClub->name }}">
                                    @endif
                                </div>
                            @endif
                            @if ($comment->team_action == 'away')
                                <div class="logo h-12 w-12 cursor-pointer">
                                    @if ($match->awayClub->logo_path)
                                        <img class="object-contain" src="{{ asset($match->awayClub->logo_path) }}"
                                            alt="Logo de {{ $match->awayClub->name }}">
                                    @else
                                        <img class="object-contain"
                                            src="https://android-apiapp.azureedge.net/common/bib_img/logo/{{ $match->awayClub->numAffiliation }}.jpg"
                                            alt="Logo de {{ $match->awayClub->name }}">
                                    @endif
                                </div>
                            @endif
                        </div>
                        <div class="relative bg-white w-full p-4 flex flex-col">
                            <div class="flex flex-col justify-between">
                                <div class="mb-4">
                                    <p class="text-lg font-bold">{{ $comment->type_comments }}</p>
                                    {{-- @if ($comment->type_comments == 'Publicité')
                                        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js">
                                        </script>
                                        <ins class="adsbygoogle" style="display:block; text-align:center;"
                                            data-ad-layout="in-article" data-ad-format="fluid"
                                            data-ad-client="ca-pub-7237777700901740" data-ad-slot="5934879385"></ins>
                                        <script>
                                            (adsbygoogle = window.adsbygoogle || []).push({});

                                        </script>
                                    @endif --}}
                                    <p>{{ $comment->comments }}</p>
                                    <div class="flex items-center">
                                        @if ($comment->statistic)
                                            @if ($comment->team_action == 'away' || $comment->team_action == 'home')
                                                @if ($comment->statistic->player)
                                                    <p class="font-bold mr-4">
                                                        {{ $comment->statistic->player->first_name }}
                                                        {{ $comment->statistic->player->last_name }}
                                                    </p>
                                                @endif
                                                @if ($comment->statistic->player->id >= 1 && $comment->statistic->player->id <= 16 && $match->id != 0)
                                                    <button type="button"
                                                        class="text-xs px-2 bg-primary text-white rounded-md"
                                                        @click="open = true">
                                                        Qui est ce ?
                                                    </button>
                                                @endif
                                            @endif
                                        @endif
                                    </div>
                                </div>
                                <!-- Menu ajout d'un joueur par utilisateur -->
                                <div class="border-t-2 pt-4 flex flex-col justify-center items-center" x-show="open"
                                    @click.away="open = false">
                                    <h3 class="text-sm">Tu connais ce joueur ?</h3>
                                    <div class="flex flex-col">
                                        @auth
                                            <div class="flex justify-center">
                                                <select
                                                    class="focus:outline-none focus:shadow-outline my-1 border-2 m-1 p-1"
                                                    name="playerMatch" id="playerMatch" wire:model="playerMatch">
                                                    <option value="">Choisis un joueur</option>
                                                    @foreach ($comment->team_action == 'home' ? $match->homeClub->players->sortBy('first_name') : $match->awayClub->players->sortBy('first_name') as $player)
                                                        <option value="{{ $player->id }}">{{ $player->first_name }}
                                                            {{ $player->last_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <button type="button"
                                                class="border rounded-lg py-1 shadow-xl hover:shadow-inner m-2"
                                                wire:click="miseAJourJoueur('{{ $comment->team_action }}' ,  {{ $comment->statistic }})">
                                                Je valide
                                            </button>
                                            <div class="flex flex-col justify-center items-center ">
                                                <p>Ou</p>
                                                <a class="border rounded-lg py-1 shadow-xl hover:shadow-inner m-2 px-2"
                                                    href="{{ route('clubs.players.index', [$comment->team_action == 'home' ? $match->homeClub->id : $match->awayClub->id]) }}">
                                                    Je crée le joueur ici
                                                </a>
                                                {{-- <p class="text-sm">Ou crée le ici</p>
                                                <a href="{{route(players.index, [])}}"></a> --}}
                                                {{-- <input
                                                    {{ $playerMatch != '' && $playerMatch != null ? 'disabled' : '' }}
                                                    wire:model="playerPrenom" name="playerPrenom"
                                                    class="{{ $playerMatch != '' && $playerMatch == null ? 'cursor-not-allowed' : '' }} text-primary border-b border-primary focus:outline-none w-2/3 sm:m-1 p-1"
                                                    type="text" placeholder="prénom">
                                                <input
                                                    {{ $playerMatch != '' && $playerMatch != null ? 'disabled' : '' }}
                                                    wire:model="playerNom" name="playerNom"
                                                    class="{{ $playerMatch != '' && $playerMatch != null ? 'cursor-not-allowed' : '' }} text-primary border-b border-primary focus:outline-none w-2/3 m-1 p-1"
                                                    type="text" placeholder="nom"> --}}
                                            </div>
                                        @else
                                            <div class="my-2 text-center">
                                                <p class="text-xs">pour pouvoir renseigner ce joueur</p>
                                                <a href="/login" class="text-xs px-2 py-1 bg-primary text-secondary">
                                                    Connecte toi
                                                </a>
                                            </div>
                                        @endauth
                                    </div>
                                </div>
                                <!-- FIN menu ajout d'un joueur par utilisateur -->
                                <div>
                                    @if ($comment->images != null)
                                        @if (pathinfo($comment->images)['extension'] == 'mp4' || pathinfo($comment->images)['extension'] == 'mov')
                                            <div class="flex justify-end pr-8">
                                                <video autoplay controls class="max-h-48 w-auto rounded-md shadow-xl">
                                                    <source src="{{ asset($comment->images) }}" type="video/mp4">
                                                    <source src="{{ asset($comment->images) }}" type="video/mov">
                                                    Your browser does not support the video tag.
                                                </video>
                                            </div>
                                        @else
                                            <div class="flex justify-end pr-8">
                                                <a href="{{ asset($comment->images) }}">
                                                    <img class="max-h-48 rounded-md shadow-xl"
                                                        src="{{ asset($comment->images) }}" alt="action">
                                                </a>
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            </div>
                            <div class="flex justify-end items-end mt-4 mx-1">
                                <p class="text-xs">Commenté par {{ $match->commentateur->user->pseudo }}</p>
                            </div>
                        </div>
                        @auth
                            @if (($match->commentateur->user_id == Auth::user()->id && $match->live != 'finDeMatch') || Auth::user()->role == 'super-admin' || Auth::user()->role == 'admin')
                                <div class="absolute flex justify-center items-center right-1 top-0">
                                    <div>
                                        <a class="text-lg text-danger"
                                            href="{{ route('supprimer', ['id' => $comment->id]) }}"
                                            onclick="return confirm('Etes vous sûr de vouloir supprimer ce commentaire ?')"><i
                                                class="far fa-times-circle"></i></a>
                                    </div>
                                </div>
                            @endif
                        @endauth
                    </div>
                @endforeach
            </div>
            @if ($match->commentateur)
                <div>
                    <div
                        class="bg-white rounded-lg border-white w-11/12 m-auto my-8 shadow-2xl lg:my-0 lg:w-auto max-w-sm">
                        <div class="bg-primary text-secondary rounded-t-lg">
                            <h3 class="text-center p-2">Le "Thierry Roland" du jour</h3>
                        </div>
                        <div class="flex flex-wrap justify-evenly items-center p-4">
                            <img class="rounded-full h-8 w-8 object-cover mr-4 mb-2"
                                src="{{ $match->commentateur->user->profile_photo_url }}">
                            <div>
                                <p class="font-bold">{{ $match->commentateur->user->pseudo }}</p>
                            </div>
                            <!-- <div class="flex items-center justify-center bg-secondary h-12 w-12 rounded-full m-2">
                            <p>{{ $match->commentateur->user->note }}</p>
                        </div> -->
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <!-- Fin affichage des commentaires -->
    </div>
</div>
