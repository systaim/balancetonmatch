<div x-data="{ open: false }">
    <div class="">
        <div>
            <div class="relative m-auto text-center p-2">
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
        <div class="flex justify-center items-center">
            @auth
                @if (Auth::user()->role == 'super-admin' ||
                    Auth::user()->role == 'admin' ||
                    ($match->live == 'attente' &&
                        $match->date_match < now() &&
                        ($match->home_score == null && $match->away_score == null)))
                    <button class="bg-secondary p-1 m-1 rounded-lg text-sm px-2" type="button" wire:click="openBtnScore">
                        Quel score ?
                    </button>
                @endif
            @else
                @if ($match->live == 'attente' &&
                    $match->date_match < now() &&
                    ($match->home_score == null && $match->away_score == null))
                    <a href="/login">
                        <button class="bg-secondary p-1 m-1 rounded-lg text-sm px-2" type="button">
                            Quel score ?
                        </button>
                    </a>
                @endif
            @endauth
            <div class="flex px-8 py-2 items-center">
                <div class="flex items-center mr-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path
                            d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                    </svg>
                    <p class="ml-2 font-bold">{{ count($visitors) }}</p>
                </div>
                <div class="col-span-2">
                    <button @click="open = ! open"
                        class="mr-3 border rounded-full text-sm p-2 flex justify-center items-center shadow-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path
                                d="M15 8a3 3 0 10-2.977-2.63l-4.94 2.47a3 3 0 100 4.319l4.94 2.47a3 3 0 10.895-1.789l-4.94-2.47a3.027 3.027 0 000-.74l4.94-2.47C13.456 7.68 14.19 8 15 8z" />
                        </svg>
                        Partager
                    </button>
                    @include('livewire.commentaires._share-match')
                </div>
            </div>
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
        </div>
        <div class="grid grid-cols-12 mb-2">
            <div class="col-span-5 overflow-hidden">
                <a href="{{ route('clubs.show', $match->homeClub->id) }}">
                    <div class="bg-primary p-4 text-secondary flex flex-col lg:items-center lg:rounded-l-md"
                        style="background-color: {{ $match->homeClub->primary_color }}; color:{{ $match->homeClub->secondary_color == $match->homeClub->primary_color ? '#cdfb0a' : $match->homeClub->secondary_color }}">
                        <div class="relative flex justify-center">
                            <div class="logo h-16 w-16 cursor-pointer lg:mr-1 xl:mr-4">
                                <img class="object-contain" src="{{ asset($match->homeClub->logo) }}"
                                    alt="Logo de {{ $match->homeClub->name }}">
                            </div>
                        </div>
                        <div>
                            <p class="truncate text-center sm:font-bold">
                                {{ $match->homeClub->name }}
                            </p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="relative col-span-2 bg-gradient-to-r from-primary to-secondary flex flex-col justify-center items-center"
                style="background: rgb(2,0,36);
                background: linear-gradient(90deg, {{ $match->homeClub->primary_color }} 0%, {{ $match->awayClub->primary_color }} 100%);">
                <div class="flex justify-center mt-2">
                    <div class="z-10">
                        @if (!$open_btn_score)
                            <p
                                class="bg-white rounded-sm mr-1 flex justify-center w-4 text-3xl px-4 sm:text-5xl sm:px-6 font-mono font-bold">
                                {{ $home_score }}
                            </p>
                        @else
                            <input
                                class="bg-white rounded-sm mr-1 flex justify-center w-16 text-3xl sm:text-5xl text-center font-mono font-bold"
                                type="number" wire:model="home_score_corrige">
                        @endif
                    </div>
                    <div class="z-10">
                        @if (!$open_btn_score)
                            <p
                                class="bg-white  rounded-sm ml-1 flex justify-center w-4 text-3xl px-4 sm:text-5xl sm:px-6 font-mono font-bold">
                                {{ $away_score }}
                            </p>
                        @else
                            <input
                                class="bg-white rounded-sm mr-1 flex justify-center w-16 text-3xl sm:text-5xl text-center font-mono font-bold"
                                type="number" wire:model="away_score_corrige">
                        @endif
                    </div>
                </div>
                @if ($open_btn_score)
                    <div class="flex my-1">
                        <div>
                            <button class="px-3 py-2 bg-yellow-200 text-black rounded-sm mr-1 shadow-xl" type="button"
                                wire:click="openBtnScore">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-800" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                                </svg>
                            </button>
                            {{-- <div>
                                @foreach ($match->homeClub->players as $player)
                                <p class="text-white text-xs">{{ $player->first_name }} {{ $player->last_name }}</p>
                                @endforeach
                            </div> --}}
                        </div>
                        <div>
                            <button class="px-3 py-2 bg-green-200 rounded-sm shadow-xl" type="button"
                                wire:click="updateScore">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-800" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                            </button>
                        </div>
                    </div>
                @endif
                @if (count($tabHome) != 0 && count($tabAway) != 0)
                    <div class="text-white flex flex-col items-center justify-center ">
                        <p class="text-xs">Tab</p>
                        <p class="font-bold">{{ $scoreTabHome }} - {{ $scoreTabAway }} </p>
                    </div>
                @endif
            </div>
            <div class="col-span-5 overflow-hidden z-0">
                <a href="{{ route('clubs.show', $match->awayClub->id) }}">
                    <div class="bg-secondary p-4 text-primary flex flex-col-reverse lg:items-center lg:justify-end lg:rounded-r-md"
                        style="background-color: {{ $match->awayClub->primary_color }}; color:{{ $match->awayClub->secondary_color == $match->awayClub->primary_color ? '#cdfb0a' : $match->awayClub->secondary_color }}">
                        <div>
                            <p class="truncate text-center lg:text-left sm:font-bold">
                                {{ $match->awayClub->name }}
                            </p>
                        </div>
                        <div class="flex justify-center">
                            <div class="logo h-16 w-16 cursor-pointer lg:ml-1 xl:ml-4">
                                <img class="object-contain" src="{{ asset($match->awayClub->logo) }}"
                                    alt="Logo de {{ $match->awayClub->name }}">
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
                            <div class="flex flex-row justify-start items-center m-auto overflow-hidden mx-1">
                                <div class="bg-primary text-secondary font-bold px-2 py-1 flex justify-end items-center w-full sm:w-48 rounded-lg mb-1"
                                    style="background-color: {{ $match->homeClub->primary_color }}; color:{{ $match->homeClub->secondary_color == $match->homeClub->primary_color ? '#cdfb0a' : $match->homeClub->secondary_color }}">
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
            <div class="col-span-4 flex flex-col items-center justify-center">
                <div
                    class="text-white font-bold bg-primary flex justify-center items-center w-20 h-20 my-0.5 rounded-full border-2 border-secondary">
                    @if ($match->live != 'attente' && $match->live != 'finDeMatch' && $match->live != 'reporte')
                        <p class="text-2xl">{{ $minute }}</p>
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
                        <div class="flex flex-row justify-end items-center m-auto overflow-hidden mx-1">
                            <div class="bg-secondary text-primary font-bold px-2 py-1 flex flex-row-reverse justify-end items-center w-full sm:w-48 rounded-lg mb-1"
                                style="background-color: {{ $match->awayClub->primary_color }}; color:{{ $match->awayClub->secondary_color == $match->awayClub->primary_color ? '#cdfb0a' : $match->awayClub->secondary_color }}">
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
        <div class="flex flex-col items-center justify-center w-full">
            <div class="flex justify-center items-center">
                @if ($match->live != 'attente' && $match->live != 'finDeMatch' && $match->live != 'reporte')
                    <div class="text-center flex justify-center font-bold">
                        <p class="px-4 bg-primary text-secondary rounded-l-md">
                            {{ $match->date_match->formatLocalized('%d/%m/%y') }}
                        </p>
                        <p class="px-4 bg-primary text-secondary rounded-r-md">
                            {{ $match->date_match->formatLocalized('%H:%M') }}
                        </p>
                    </div>
                @endif
                @if ($match->live == 'attente' && !$match->home_score)
                    <button class="btnSecondary rounded-md mb-2 text-sm">
                        <a href="{{ route('matches.edit', ['match' => $match]) }}" class="p-2">
                            Corriger l'heure
                        </a>
                    </button>
                @endif
            </div>
        </div>
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
</div>
{{-- <div wire:ignore class="text-center">
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7237777700901740"
        crossorigin="anonymous"></script>
    <!-- top banniere -->
    <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-7237777700901740" data-ad-slot="1803015183"
        data-ad-format="auto" data-full-width-responsive="true"></ins>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
    </script>
</div> --}}

{{-- @if ($match->home_score && $match->live == 'finDuMatch')
    <div class="relative sm:py-8 py-4">
        <div class="mx-auto max-w-md px-4 sm:max-w-3xl sm:px-6 lg:max-w-7xl lg:px-8">
            <div class="relative rounded-2xl px-6 py-10 bg-primary overflow-hidden shadow-xl text-white">
                <div class="relative">
                    <div class="text-center">
                        @if ($match->home_score == count($buteurs_domicile) && $match->away_score == count($buteurs_exterieur))
                            <h2 class="text-3xl font-extrabold tracking-tight sm:text-4xl">
                                Les <span class="bg-secondary px-1 text-primary">buteurs</span> du match
                            </h2>
                        @else
                            <h2 class="text-3xl font-extrabold tracking-tight sm:text-4xl">
                                Tu connais les <span class="bg-secondary px-1 text-primary">buteurs</span> ?
                            </h2>
                            <p class="mt-2 mx-auto max-w-2xl">
                                Tu peux les ajouter
                            </p>
                            <p class="mt-2 mx-auto max-w-2xl">
                                Si un joueur n'est pas dans la liste, pense a le créer
                            </p>
                        @endif
                    </div>
                </div>
                <div class="flex flex-col lg:flex-row lg:justify-around">
                    @auth
                        <div class="mt-4">
                            <h3 class="m-3 text-2xl truncate">{{ $match->homeClub->name }}</h3>
                            @for ($i = 1; $i <= $match->home_score; $i++)
                                <div class="m-3">
                                    <label for="player_dom{{ $i }}" class="block text-sm font-medium">Buteur
                                        n°{{ $i }}</label>
                                    @if (!isset($buteurs_domicile[$i - 1]))
                                        <select id="player_dom{{ $i }}" name="player_dom{{ $i }}"
                                            wire:model="input_buteur_dom.{{ $i }}"
                                            class="mt-1 block pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none text-black sm:text-sm rounded-md">
                                            <option>Sélectionne un joueur</option>
                                            @foreach ($match->homeClub->players->sortBy('first_name') as $player)
                                                <option value="{{ $player->id }}">
                                                    {{ ucfirst($player->first_name) }}
                                                    {{ strtoupper($player->last_name) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    @else
                                        @foreach ($match->homeClub->players as $player)
                                            @if ($player->id == $buteurs_domicile[$i - 1])
                                                <p class="text-lg">{{ ucfirst($player->first_name) }}
                                                    {{ strtoupper($player->last_name) }}</p>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            @endfor

                        </div>
                        <div class="mt-4">
                            <h3 class="m-3 text-2xl truncate">{{ $match->awayClub->name }}</h3>
                            @for ($i = 1; $i <= $match->away_score; $i++)
                                <div class="m-3">
                                    <label for="player_ext{{ $i }}" class="block text-sm font-medium">Buteur
                                        n°{{ $i }}</label>
                                    @if (!isset($buteurs_exterieur[$i - 1]))
                                        <select id="player_ext{{ $i }}" name="player_ext{{ $i }}"
                                            wire:model="input_buteur_ext.{{ $i }}"
                                            class="mt-1 block pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none text-black sm:text-sm rounded-md">
                                            <option>Sélectionne un joueur</option>
                                            @foreach ($match->awayClub->players as $player)
                                                <option value="{{ $player->id }}">
                                                    {{ ucfirst($player->first_name) }}
                                                    {{ strtoupper($player->last_name) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    @else
                                        @foreach ($match->awayClub->players as $player)
                                            @if ($player->id == $buteurs_exterieur[$i - 1])
                                                <p class="text-lg">{{ ucfirst($player->first_name) }}
                                                    {{ strtoupper($player->last_name) }}</p>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                                @if ($input_buteur_ext == 'no_player_ext')
                                    ok
                                @endif
                            @endfor
                        </div>
                    </div>
                    <div class="mt-4 text-center">
                        <button type="button" class="btn btnSecondary" wire:click="storeButeursDuMatch">
                            Valider
                        </button>
                    </div>
                @else
                    <a href="/login">
                        <button type="button" class="btn btnSecondary">Connecte toi</button>
                    </a>
                @endauth
            </div>
        </div>
    </div>
@endif --}}
