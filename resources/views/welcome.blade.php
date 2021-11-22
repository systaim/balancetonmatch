@extends('layout')
@section('content')
    <section>
        <div id="slideHome" class="hidden md:flex flex-col md:flex-row justify-between bg-primary overflow-hidden h-96 z-0">
            <div class="h-6/12 sm:h-8/12 md:h-auto md:w-6/12 img-bg-blend-home">
            </div>
            <div id="welcome" class="h-auto text-white py-4 md:w-6/12 px-12 xl:w-4/12 m-auto text-center">
                <div class="flex items-center justify-center">
                    <hr class="w-10 border border-secondary">
                    <h2 class="text-xl md:text-3xl my-2 mx-6 font-medium">Bienvenue</h2>
                    <hr class="w-10 border border-secondary">
                </div>
                <p class="text-sm md:text-base text-justify">BalanceTonMatch.com a pour but de rassembler les passionnés du
                    ballon rond AMATEUR.</p>
                <p class="text-sm md:text-base text-justify">Vous pourrez suivre les matchs en <span
                        class="uppercase text-primary font-bold bg-secondary px-2 rounded-sm">live</span> soit en tant que
                    commentateur soit en tant que spectateur</p>
            </div>
        </div>
    </section>

    {{-- affichage mobile --}}
    <section class="py-11 flex bg-primary flex-col-reverse md:flex-row items-center">
        <aside class="bg-white rounded-lg m-4 py-4 shadow-white-xl overflow-y-scroll max-h-96 md:w-1/3">
            <h3 class="px-4">Dernières actus</h3>
            {{-- <div>
                @if ($stats)
                    @foreach ($stats as $stat)
                        <a href="{{ route('clubs.players.show', [$stat->player->club->id, $stat->player->id]) }}">
                            <p>{{ $stat->player->first_name }} {{ $stat->player->last_name }}</p>
                        </a>
                    @endforeach
                @endif
            </div> --}}
            <div>
                @if ($activities)
                    <ul role="list" class="divide-y divide-gray-200">
                        @foreach ($activities as $activite)
                            @switch($activite->type)
                                @case('update_score')
                                    @if ($activite->match)
                                        <a href="{{ route('matches.show', [$activite->match->id]) }}">
                                            <li class="py-4 hover:bg-gray-50 px-4">
                                                <div class="flex space-x-3 ">
                                                    <div class="flex-1 space-y-1 ">
                                                        <div class="flex items-center justify-between">
                                                            <p class="text-sm font-medium">
                                                                <span
                                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                                    Match
                                                                </span>
                                                                par {{ $activite->user->pseudo }}
                                                            </p>
                                                            <p class="text-xs text-gray-500">
                                                                {{ Carbon\Carbon::create($activite->created_at)->diffForHumans() }}
                                                            </p>
                                                        </div>
                                                        <div class="flex">
                                                            <div>
                                                                <p class="text-sm text-gray-500">
                                                                    Le score est mis à jour
                                                                </p>
                                                                <p class="text-sm text-gray-500">
                                                                    {{ $activite->match->homeClub->name }} -
                                                                    {{ $activite->match->awayClub->name }}
                                                                </p>
                                                            </div>

                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                class="h-5 w-5 ml-3 text-gray-500" fill="none"
                                                                viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                            </svg>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </a>
                                    @endif
                                @break
                                @case('create_match')
                                    @if ($activite->match)
                                        <a href="{{ route('matches.show', [$activite->match->id]) }}">
                                            <li class="py-4 hover:bg-gray-50 px-4">
                                                <div class="flex space-x-3 ">
                                                    <div class="flex-1 space-y-1 ">
                                                        <div class="flex items-center justify-between">
                                                            <p class="text-sm font-medium">
                                                                <span
                                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                                    Match
                                                                </span>
                                                                par {{ $activite->user->pseudo }}
                                                            </p>
                                                            <p class="text-xs text-gray-500">
                                                                {{ Carbon\Carbon::create($activite->created_at)->diffForHumans() }}
                                                            </p>
                                                        </div>
                                                        <div class="flex">
                                                            <div>
                                                                <p class="text-sm text-gray-500">
                                                                    Le match est créé
                                                                </p>
                                                                <p class="text-sm text-gray-500">
                                                                    {{ $activite->match->homeClub->name }} -
                                                                    {{ $activite->match->awayClub->name }}
                                                                </p>
                                                            </div>

                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                class="h-5 w-5 ml-3 text-gray-500" fill="none"
                                                                viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                            </svg>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </a>
                                    @endif
                                @break
                                @case('create_commentator')
                                    @if ($activite->match)
                                        <a href="{{ route('matches.show', [$activite->match->id]) }}">
                                            <li class="py-4 hover:bg-gray-50 px-4">
                                                <div class="flex space-x-3 ">
                                                    <div class="flex-1 space-y-1 ">
                                                        <div class="flex items-center justify-between">
                                                            <p class="text-sm font-medium">
                                                                <span
                                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                                    Match
                                                                </span>
                                                                par {{ $activite->user->pseudo }}
                                                            </p>
                                                            <p class="text-xs text-gray-500">
                                                                {{ Carbon\Carbon::create($activite->created_at)->diffForHumans() }}
                                                            </p>
                                                        </div>
                                                        <div class="flex items-center">
                                                            <p class="text-sm text-gray-500"> commente<br>
                                                                {{ $activite->match->homeClub->name }} -
                                                                {{ $activite->match->awayClub->name }}
                                                            </p>
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                class="h-5 w-5 ml-3 text-gray-500" fill="none"
                                                                viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                            </svg>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </a>
                                    @endif
                                @break
                                @case('update_cover')
                                    @if ($activite->club)
                                        <a href="{{ route('clubs.show', [$activite->club->id]) }}">
                                            <li class="py-4 hover:bg-gray-50 px-4">
                                                <div class="flex space-x-3 ">
                                                    <div class="flex-1 space-y-1 ">
                                                        <div class="flex items-center justify-between">
                                                            <p class="text-sm font-medium">
                                                                <span
                                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                                    Club
                                                                </span>
                                                                par {{ $activite->user->pseudo }}
                                                            </p>
                                                            <p class="text-xs text-gray-500">
                                                                {{ Carbon\Carbon::create($activite->created_at)->diffForHumans() }}
                                                            </p>
                                                        </div>
                                                        <div class="flex items-center">
                                                            <p class="text-sm text-gray-500">Couverture mise à jour<br>
                                                                {{ $activite->club->name }}
                                                            </p>
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                class="h-5 w-5 ml-3 text-gray-500" fill="none"
                                                                viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                            </svg>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </a>
                                    @endif
                                @break
                                @case('create_player')
                                    @if ($activite->player)
                                        <a href="{{ route('clubs.players.show', [$activite->club->id, $activite->player->id]) }}">
                                            <li class="py-4 hover:bg-gray-50 px-4">
                                                <div class="flex space-x-3 ">
                                                    <div class="flex-1 space-y-1 ">
                                                        <div class="flex items-center justify-between">
                                                            <p class="text-sm font-medium">
                                                                <span
                                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                                    Joueur
                                                                </span>
                                                                par {{ $activite->user->pseudo }}
                                                            </p>
                                                            <p class="text-xs text-gray-500">
                                                                {{ Carbon\Carbon::create($activite->created_at)->diffForHumans() }}
                                                            </p>
                                                        </div>
                                                        <div class="flex items-center">
                                                            <p class="text-sm text-gray-500">Joueur créé<br>
                                                                {{ $activite->player->first_name }}
                                                                {{ $activite->player->last_name }}
                                                            </p>
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                class="h-5 w-5 ml-3 text-gray-500" fill="none"
                                                                viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                            </svg>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </a>
                                    @endif
                                @break
                                @default

                            @endswitch
                        @endforeach
                    </ul>
                    {{-- @if (!empty($activities))
                        <div class="p-4">
                            <p class="text-sm text-gray-500">Aucune actualité récente...</p>
                        </div>
                    @endif --}}
                @endif
            </div>
        </aside>
        <div class="flex-1 w-full">
            <a href="{{ route('competitions.index') }}">
                <div class="shadow-white-xl rounded-2xl w-5/6 p-4 bg-white relative overflow-hidden mx-auto">
                    <img alt="competitions" src="{{ asset('images/ball-fire-water.png') }}"
                        class="absolute -right-16 -bottom-8 h-40 w-40 mb-4" />
                    <div class="w-5/6">
                        <p class="text-gray-800 text-lg font-medium mb-2">
                            Compétitions
                        </p>
                        <p class="text-gray-400 text-xs">
                            Vous y trouverez les matchs à venir
                        </p>
                        <p class="text-primary text-lg font-medium flex items-center mt-2">
                            J'y vais
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" class="w-5 h-5 mx-2" viewBox="0 0 24 24">
                                <path d="M5 12h14M12 5l7 7-7 7"></path>
                            </svg>
                        </p>
                    </div>
                </div>
            </a>
            <a href="/mon-espace/mes-favoris">
                <div class="shadow-white-xl rounded-2xl w-5/6 p-4 bg-white relative overflow-hidden mx-auto mt-6">
                    <img alt="favoris" src="{{ asset('images/favoris-mobile.png') }}"
                        class="absolute -right-14 -bottom-8 h-32 w-32 mb-4" />
                    <div class="w-5/6">
                        <p class="text-gray-800 text-lg font-medium mb-2">
                            Mes favoris
                        </p>
                        <p class="text-gray-400 text-xs">
                            Vos matchs et équipes en favoris
                        </p>
                        <p class="text-primary text-lg font-medium flex items-center mt-2">
                            J'y vais
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" class="w-5 h-5 mx-2" viewBox="0 0 24 24">
                                <path d="M5 12h14M12 5l7 7-7 7"></path>
                            </svg>
                        </p>
                    </div>
                </div>
            </a>
            <a href="/live">
                <div class="shadow-white-xl rounded-2xl w-5/6 p-4 bg-white relative overflow-hidden mx-auto mt-6">
                    <img alt="live" src="{{ asset('images/micro.png') }}"
                        class="absolute -right-24 -bottom-16 h-48 w-48 mb-4" />
                    <div class="w-5/6">
                        <p class="text-gray-800 text-lg font-medium mb-2">
                            Les lives
                        </p>
                        @if (count($liveMatches) == 0)
                            <p class="text-gray-400 text-xs">Pas de matchs en ce moment</p>
                        @else
                            <div class="flex">
                                <p
                                    class="mr-1 text-xs flex items-center justify-center rounded-full text-primary h-5 w-5 bg-secondary">
                                    {{ count($liveMatches) }}
                                </p>
                                <p class="text-gray-400 text-xs">
                                    {{ count($liveMatches) == 1 ? 'match' : 'matchs' }} en cours
                                </p>
                            </div>

                        @endif
                        <p class="text-primary text-lg font-medium flex items-center mt-2">
                            J'y vais
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" class="w-5 h-5 mx-2" viewBox="0 0 24 24">
                                <path d="M5 12h14M12 5l7 7-7 7"></path>
                            </svg>
                        </p>
                    </div>
                </div>
            </a>
        </div>

    </section>

    {{-- affichage desktop --}}
    {{-- <section class="hidden md:block">
        <div class="container mx-auto">
            <div class="flex flex-wrap justify-evenly mx-4 mb-10 text-center text-white">
                <div class="relative w-11/12 md:w-2/5 my-5 bg-primary rounded-lg shadow-2xl">
                    <a href="{{ route('competitions.index') }}">
                        <div class="rounded-lg h-48 overflow-hidden">
                            <img alt="tous les matchs" class="object-cover object-center h-full w-full"
                                src="{{ asset('images/ballon-feu.jpg') }}">
                        </div>
                        <h2 class="text-2xl font-medium mt-6 mb-3">Les matchs à venir</h2>
                        {
                        <div class="flex justify-end">
                            <button class="btn btnSecondary">
                                <p class="flex items-center">
                                    J'y vais
                                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">
                                        <path d="M5 12h14M12 5l7 7-7 7"></path>
                                    </svg>
                                </p>
                            </button>
                        </div>
                    </a>
                </div>
                <div class="relative w-11/12 md:w-2/5 my-5 bg-primary rounded-lg shadow-2xl">
                    <a href="/mon-espace/mes-favoris">
                        <div class="rounded-lg h-48 overflow-hidden">
                            <img alt="mes favoris" class="object-cover object-center h-full w-full"
                                src="{{ asset('images/fav.jpg') }}">
                        </div>
                        <h2 class="text-2xl font-medium mt-6 mb-3">Mes favoris</h2>
                        <div class="flex justify-end">
                            <button class="btn btnSecondary">
                                <p class="flex items-center">
                                    J'y vais
                                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">
                                        <path d="M5 12h14M12 5l7 7-7 7"></path>
                                    </svg>
                                </p>
                            </button>
                        </div>
                    </a>
                </div>
                <div class="relative w-11/12 md:w-2/5 my-5 bg-primary rounded-lg shadow-2xl">
                    <a href="/live">
                        <div class="rounded-lg h-48 overflow-hidden">
                            <img alt="les matchs en live" class="object-cover object-center h-full w-full"
                                src="{{ asset('images/on-air.jpg') }}">
                        </div>
                        <h2 class="text-2xl font-medium mt-6">Les matchs en Live</h2>
                        @if (count($liveMatches) == 0)
                            <p class="leading-relaxed text-base">Pas de matchs en ce moment</p>
                        @else
                            <p class="leading-relaxed text-base">En ce moment <span
                                    class="bg-secondary text-primary py-1 px-2 rounded-lg">{{ count($liveMatches) }}</span>
                                {{ count($liveMatches) == 1 ? 'match' : 'matchs' }} en cours</p>
                        @endif
                        <div class="flex justify-end">
                            <button class="btn btnSecondary">
                                <p class="flex items-center">
                                    J'y vais
                                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">
                                        <path d="M5 12h14M12 5l7 7-7 7"></path>
                                    </svg>
                                </p>
                            </button>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section> --}}
    @if ($commentators)
        <section>
            <div class="bg-gray-50 overflow-hidden">
                <div class="relative max-w-7xl mx-auto py-2 px-4 sm:px-6 lg:px-8">
                    <svg class="absolute top-0 left-full transform -translate-x-1/2 -translate-y-3/4 lg:left-auto lg:right-full lg:translate-x-2/3 lg:translate-y-1/4"
                        width="404" height="784" fill="none" viewBox="0 0 404 784" aria-hidden="true">
                        <defs>
                            <pattern id="8b1b5f72-e944-4457-af67-0c6d15a99f38" x="0" y="0" width="20" height="20"
                                patternUnits="userSpaceOnUse">
                                <rect x="0" y="0" width="4" height="4" class="text-gray-200" fill="currentColor" />
                            </pattern>
                        </defs>
                        <rect width="404" height="784" fill="url(#8b1b5f72-e944-4457-af67-0c6d15a99f38)" />
                    </svg>

                    <div class="relative flex-col flex md:flex-row py-6 ">
                        <div class="">
                            <h2 class="text-xl tracking-tight text-gray-900 sm:text-4xl">
                                Les commentateurs du dimanche
                            </h2>
                        </div>
                        <div class="mt-10 flex flex-wrap w-full">
                            @foreach ($commentators->unique('user_id') as $com)
                            
                                <div class="relative bg-primary rounded-md shadow-xl overflow-hidden text-white w-72 m-2">
                                    {{-- <a href="{{ route('matches.show', [$com->match->id]) }}"> --}}
                                        <div class="absolute -top-3 -left-3 logo h-20 w-20 transform -rotate-12">
                                            @if ($com->match->homeClub->logo_path != null)
                                                <img class="object-contain"
                                                    src="{{ asset($com->match->homeClub->logo_path) }}"
                                                    alt="Logo de {{ $com->match->homeClub->name }}">
                                            @else
                                                <img class="object-contain"
                                                    src="https://android-apiapp.azureedge.net/common/bib_img/logo/{{ $com->match->homeClub->numAffiliation }}.jpg"
                                                    alt="Logo de {{ $com->match->homeClub->name }}">
                                            @endif
                                        </div>
                                        <div class="absolute -top-3 -right-3 logo h-20 w-20 transform rotate-12">
                                            @if ($com->match->awayClub->logo_path != null)
                                                <img class="object-contain"
                                                    src="{{ asset($com->match->awayClub->logo_path) }}"
                                                    alt="Logo de {{ $com->match->awayClub->name }}">
                                            @else
                                                <img class="object-contain"
                                                    src="https://android-apiapp.azureedge.net/common/bib_img/logo/{{ $com->match->awayClub->numAffiliation }}.jpg"
                                                    alt="Logo de {{ $com->match->awayClub->name }}">
                                            @endif
                                        </div>
                                        <div class="flex justify-center items-start py-3">
                                            <p class="text-sm leading-6 font-medium mr-3">
                                                {{ $com->user->pseudo }}
                                            </p>
                                            <span
                                                class=" flex items-center justify-center h-6 w-6 text-xs bg-orange-600 rounded-full">
                                                {{ $com->merci }}
                                            </span>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

        </section>
    @endif

    {{-- <section class="relative bg-secondary py-8 overflow-x-hidden">
        <div class="-my-4 absolute top-1/2 left-1 z-20">
            <i class="fas fa-arrow-circle-left text-3xl"></i>
        </div>
        <div class="-my-4 absolute top-1/2 right-1 z-20">
            <i class="fas fa-arrow-circle-right text-3xl"></i>
        </div>
        <div class="flex flex-no-wrap justify-start mx-5">
            @foreach ($comOfTheWeek as $com)
                <a href="{{ route('matches.show', [$com->matchs->id]) }}">
                    <div class="border-gray-400 flex flex-row mb-2">
                        <div class="shadow border select-none cursor-pointer bg-white dark:bg-gray-800 rounded-md flex flex-1 items-center p-4">
                            <div class="flex flex-col w-10 h-10 justify-center items-center mr-4">
                                <a href="#" class="block relative">
                                    <img alt="profil" src="/images/person/6.jpg" class="mx-auto object-cover rounded-full h-10 w-10 "/>
                                </a>
                            </div>
                            <div class="flex-1 pl-1 md:mr-16">
                                <div class="font-medium dark:text-white">
                                    Jean Marc
                                </div>
                                <div class="text-gray-600 dark:text-gray-200 text-sm">
                                    Developer
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white h-52 w-40 rounded-lg shadow-2xl m-2 overflow-hidden p-2">
                        <div class="relative flex flex-col items-center justify-between h-full pt-3 pb-6">
                            <div>
                                <div
                                    class="absolute top-2 right-2 h-5 w-5 rounded-full bg-success flex justify-center items-center">
                                    <span class=" text-xs  text-gray-900">{{ $com->matchs->commentateur->merci }}</span>
                                </div>
                                <div
                                    class="h-16 w-16 rounded-full overflow-hidden flex items-center justify-center border bg-fixed m-2">
                                    <img class="object-contain h-full" src="{{ $com->user->profile_photo_path }}" alt="">
                                </div>
                                <p class="text-xs text-center">{{ $com->user->pseudo }}</p>
                            </div>
                            <div class="flex flex-col items-center">
                                <p class="text-xs text-center">{{ $com->matchs->homeClub->name }}</p>
                                <img class="h-4 text-center" src="{{ asset('images/vs-primary.jpg') }}" alt="contre">
                                <p class="text-xs text-center">{{ $com->matchs->awayClub->name }}</p>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </section> --}}
    <section class="relative">
        <div class="text-gray-200 bg-primary body-font shadow-2xl">
            <div class="container px-5 py-10 lg:py-20 mx-auto moveToLeft">
                <div
                    class="lg:w-2/3 flex flex-col lg:flex-row items-start lg:items-center justify-center lg:justify-start mx-auto">
                    <h3 class="text-sm lg:text-xl font-medium text-white ml-2">
                        Un match en démo
                    </h3>
                    <a href="matches/0" class="z-30">
                        <button class="btn btnSecondary flex items-center text-sm lg:text-base">
                            Go !
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">
                                <path d="M5 12h14M12 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    </a>
                </div>
            </div>
        </div>
        <div class="absolute -top-18 lg:-top-20 right-0 lg:right-48 z-10">
            <img src="{{ asset('images/demo2-min.png') }}" alt="demo" class="h-72 lg:h-96">
        </div>
    </section>

    {{-- <div class="py-6">
        <div class="flex justify-center">
            <h3 class="p-2 text-primary text-2xl">La saison 2020/2021 c'est : </h3>
        </div>
        <div class="flex flex-wrap justify-center">
            <div class="flex justify-between">
                <div
                    class="flex flex-col items-center justify-center text-primary w-20 h-20 md:w-28 md:h-28 lg:w-40 lg:h-40 md:bg-primary md:text-white my-2 mx-1 rounded-lg shadow-lg">
                    <p class="compteur text-xl lg:text-5xl font-bold">{{ count($matches) + 300 }}</p>
                    <p class="text-xs lg:text-base">{{ count($matches) <= 1 ? 'matchs' : 'matchs' }}</p>
                </div>
                <div
                    class="flex flex-col items-center justify-center text-primary w-20 h-20 md:w-28 md:h-28 lg:w-40 lg:h-40 md:bg-primary md:text-white my-2 mx-1 rounded-lg shadow-lg">
                    <p class="compteur text-xl lg:text-5xl font-bold">{{ count($clubs) }}</p>
                    <p class="text-xs lg:text-base">clubs</p>
                </div>
                <div
                    class="flex flex-col items-center justify-center text-primary w-20 h-20 md:w-28 md:h-28 lg:w-40 lg:h-40 md:bg-primary md:text-white my-2 mx-1 rounded-lg shadow-lg">
                    <p class="compteur text-xl lg:text-5xl font-bold">{{ count($players) + count($staffs) + 2450 }}</p>
                    <p class="text-xs lg:text-base">licenciés</p>
                </div>
            </div>
            <div class="flex justify-between">
                <div
                    class="flex flex-col items-center justify-center text-primary w-20 h-20 md:w-28 md:h-28 lg:w-40 lg:h-40 md:bg-primary md:text-white my-2 mx-1 rounded-lg shadow-lg">
                    <p class="compteur text-xl lg:text-5xl font-bold">{{ count($goals) + 580 }}</p>
                    <p class="text-xs lg:text-base">{{ count($goals) <= 1 ? 'but' : 'buts' }}</p>
                </div>
                <div
                    class="flex flex-col items-center justify-center text-primary w-20 h-20 md:w-28 md:h-28 lg:w-40 lg:h-40 md:bg-primary md:text-white my-2 mx-1 rounded-lg shadow-lg">
                    <p class="compteur text-xl lg:text-5xl font-bold">{{ count($commentators) + 90 }}</p>
                    <p class="text-xxs lg:text-base">{{ count($commentators) <= 1 ? 'commentateurs' : 'commentateurs' }}
                    </p>
                </div>
                <div
                    class="flex flex-col items-center justify-center text-primary w-20 h-20 md:w-28 md:h-28 lg:w-40 lg:h-40 md:bg-primary md:text-white my-2 mx-1 rounded-lg shadow-lg">
                    <p class="compteur text-xl lg:text-5xl font-bold">{{ count($yellowCards) + count($redCards) + 359 }}
                    </p>
                    <p class="text-xs lg:text-base">
                        {{ count($yellowCards) + count($redCards) <= 1 ? 'cartons' : 'cartons' }}</p>
                </div>
            </div>
        </div>
    </div> --}}

@endsection
