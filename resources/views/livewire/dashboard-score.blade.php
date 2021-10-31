<div wire:poll.5s>
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
        <div class="flex justify-center">
            @if ((Auth::user()->role == 'super-admin' || Auth::user()->role == 'admin' || $match->commentateur->user_id == Auth::user()->id ) 
            || ($match->live == 'attente' && $match->date_match < now() 
            && ($match->home_score == null && $match->away_score == null)))
                <button class="bg-secondary p-1 m-1 rounded-lg text-sm" type="button" wire:click="openBtnScore">
                    Quel score ?
                </button>
            @endif
        </div>
        <div class="grid grid-cols-12 lg:mx-16 xl:mx-24 mb-2">
            <div class="col-span-5 overflow-hidden">
                <a href="{{ route('clubs.show', $match->homeClub->id) }}">
                    <div
                        class="bg-primary p-2 text-secondary flex flex-col lg:flex-row lg:items-center lg:rounded-l-full">

                        <div class="relative flex justify-center">
                            <div class="logo h-16 w-16 sm:h-20 sm:w-20 lg:h-32 lg:w-32 cursor-pointer lg:mr-1 xl:mr-4">
                                @if ($match->id == 0)
                                    <img class="object-contain w-full" src="{{ asset('images/100000.jpg') }}"
                                        alt="logo">
                                @else
                                    @if ($match->homeClub->logo_path)
                                        <img class="object-contain" src="{{ asset($match->homeClub->logo_path) }}"
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
                        @if (!$open_btn_score)
                            <p
                                class="bg-white rounded-sm mr-1 flex justify-center w-4 text-3xl px-4 sm:text-5xl sm:px-6 font-mono font-bold">
                                {{ $home_score }}
                            </p>
                        @else
                            <input
                                class="bg-white rounded-sm mr-1 flex justify-center w-12 text-3xl px-4 sm:text-5xl sm:px-6 font-mono font-bold"
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
                                class="bg-white rounded-sm mr-1 flex justify-center w-12 text-3xl px-4 sm:text-5xl sm:px-6 font-mono font-bold"
                                type="number" wire:model="away_score_corrige">

                        @endif
                    </div>
                </div>
                @if ($open_btn_score)
            <div class="flex my-1">
                <button class="px-1 bg-yellow-100 text-black rounded-md mr-1 shadow-xl" type="button"
                    wire:click="openBtnScore">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                    </svg>
                </button>
                <button class="px-1 bg-green-100 text-black rounded-md ml-1 shadow-xl" type="button" wire:click="updateScore">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 13l4 4L19 7" />
                    </svg>
                </button>
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
                    <div
                        class="bg-secondary p-2 text-primary flex flex-col-reverse lg:flex-row lg:items-center lg:justify-end lg:rounded-r-full">
                        <div>
                            <p class="truncate text-center lg:text-left sm:font-bold lg:text-2xl">
                                {{ $match->awayClub->name }}
                            </p>
                        </div>
                        <div class="flex justify-center">
                            <div class="logo h-16 w-16 sm:h-20 sm:w-20 lg:h-32 lg:w-32 cursor-pointer lg:ml-1 xl:ml-4">
                                @if ($match->id == 0)
                                    <img class="object-contain w-full" src="{{ asset('images/200000.jpg') }}"
                                        alt="logo">
                                @else
                                    @if ($match->awayClub->logo_path)
                                        <img class="object-contain" src="{{ asset($match->awayClub->logo_path) }}"
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
            <div class="col-span-4 flex flex-col items-center justify-center">
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
                @if ($match->live == 'attente')
                    <button class="btnSecondary rounded-md mb-2 text-sm">
                        <a href="{{ route('matches.edit', ['match' => $match]) }}" class="p-2">
                            Corriger l'heure
                        </a>
                    </button>
                @endif
            </div>
        </div>
    </div>
    <div class="bg-gray-900 px-8 py-2 text-white text-center flex justify-center items-center">
        <div wire:ignore id="fb-root"></div>
        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v11.0"
                nonce="tGIyRgh0">
        </script>
        <a target="_blank"
            href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fbalancetonmatch.com/%2Fmatches%2F{{ $match->id }}&amp;src=sdkpreparse"
            class="fb-xfbml-parse-ignore">
            <div class=" rounded-lg bg-blue-600 text-white mr-3 py-1 px-2">
                <div data-href="{{ route('matches.show', [$match, Str::slug($match->slug, '-')]) }}"
                    data-layout="button" data-size="large">
                    <div class="flex justify-center items-center">
                        <i class="fab fa-facebook text-2xl text-white"></i>
                        <p class="font-sans text-xs text-center mx-1">Partager le match</p>
                    </div>
                </div>
            </div>
        </a>
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
</div>
