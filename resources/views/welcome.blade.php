@extends('layout')
@section('content')
<section class="min-h-screen">
    <div class="flex flex-col md:flex-row justify-between bg-primary overflow-hidden h-96 mb-2">
        <div class="h-6/12 sm:h-8/12 md:h-auto md:w-6/12 img-bg-blend-home">
        </div>
        <div class="h-auto text-white py-4 md:w-6/12 px-12 lg:px-24 2xl:px-64 m-auto text-center">
            <div class="flex items-center justify-center">
                <hr class="w-10 border border-secondary">
                <h2 class="text-xl md:text-3xl my-2 mx-6">Bienvenue</h2>
                <hr class="w-10 border border-secondary">
            </div>
            <p class="text-sm md:text-base">BalanceTonMatch.com a pour but de rassembler les passionnés du ballon rond AMATEUR.</p>
            <p class="text-sm md:text-base">Il est possible de gérer ton club mais surtout de commenter et de suivre les matchs en <span class="uppercase text-primary font-bold bg-secondary px-2 rounded-sm">live</span></p>
        </div>
    </div>
    <div class="mb-2 rounded-md mx-2">
        <form class="w-11/12 m-auto sm:w-8/12 md:w-6/12 lg:w-4/12" action="{{ asset('clubs') }}" method="get">
            <H3 class="pl-2">Rechercher un club</H3>
            @csrf
            <label class="relative" for="search">
                <input class="inputForm w-full" type="search" placeholder="F.C. Recherche" name="search" id="search">
                <span class=" z-10"><i class="far fa-search"></i></span>
            </label>
            <input class="sr-only" type="submit">
        </form>
    </div>
    <div class="flex flex-col">
        <div class="bg-white p-4 rounded-md text-primary w-11/12 m-auto mb-2 sm:w-9/12 md:w-8/12 lg:w-6/12 xl:w-4/12">
            <h3 class="text-center mb-6">Quelques statistiques... </h3>
            <hr>
            @if(count($futurMatches) == 1)
            <p class="text-center mt-6">{{ count($futurMatches) }} match à venir</p>
            @else
            <p class="text-center mt-6">{{ count($futurMatches) }} matchs à venir</p>
            @endif
            <p class="text-center">{{ count($matches) }} matchs créés</p>
            <p class="text-center">{{ count($clubs) }} clubs créés</p>
            <p class="text-center">{{ count($players) }} joueurs et {{ count($staffs) }} membres de staff</p>
            <p class="text-center">{{ count($goals) }} buts marqués</p>
        </div>
        <div class="w-11/12 m-auto sm:w-9/12">
            <h3 class="pl-2">Les matchs du week-end</h3>
            @foreach($matches->sortBy('date_match') as $match)
            @if($match->date_match->formatLocalized('%V') == now()->week() && $match->date_match->formatLocalized('%Y') == '2021')
            @if($match->date_match->formatLocalized('%A') == "vendredi" || $match->date_match->formatLocalized('%A') == "samedi" || $match->date_match->formatLocalized('%A') == "dimanche")
            @include('match')
            @endif
            @endif
            @endforeach
        </div>
    </div>
    @auth
    <div class="flex flex-col w-11/12 lg:w-10/12 lg:flex-row justify-between m-auto">
        <div class="w-full m-2">
            <div>
                <h3>Mes teams préférées</h3>
            </div>
            <div class="py-4">
                @auth
                @if(count($user->favoristeams) > 0 )
                @foreach($user->favoristeams->shuffle() as $favoriteam)
                <a href="{{ route('clubs.show', $favoriteam->club->id) }}">
                    <div class="flex flex-col mb-3 w-full">
                        <div class="relative flex flex-row items-center bg-primary rounded-lg overflow-hidden">
                            <div class="w-16 m-2 z-10">
                                <div class="logo h-12 w-12">
                                    <img class="object-contain" src="https://android-apiapp.azureedge.net/common/bib_img/logo/{{ $favoriteam->club->numAffiliation }}.jpg">
                                </div>
                            </div>
                            <div class=" py-2 w-full text-secondary overflow-hidden ml-2 z-10">
                                <p class="truncate font-bold">{{ $favoriteam->club->name}}</p>
                            </div>
                            <div class="absolute -bottom-7 -right-7 transform -rotate-45 z-0">
                                <div class="h-2 w-36 mb-1" style="background-color: {{ $favoriteam->club->primary_color }};"></div>
                                <div class="h-2 w-36" style="background-color: {{ $favoriteam->club->secondary_color }};"></div>
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach
                @endif
                @else
                <p>Connecte toi pour ajouter des équipes</p>
                @endauth
            </div>
        </div>
        <div class="w-full ml-2">
            <div class="">
                <h3 class=""><i class="fas fa-star text-red-700"></i> Mes matchs favoris <i class="fas fa-star text-red-700"></i></h3>
            </div>
            <div class="py-4">
                @auth
                @if(count($user->favorismatches) > 0 )
                @foreach($user->favorismatches as $favorimatch)
                @if($favorimatch->match->date_match > $today)
                <a href="{{route('matches.show',$favorimatch->match)}}">
                    <div class="my-2 p-2 bg-primary text-white rounded-lg">
                        <div class="text-center flex justify-center font-bold">
                            <p class="px-4 bg-primary text-secondary rounded-tl-md">{{ $favorimatch->match->date_match->formatLocalized('%d/%m/%y')}}</p>
                            <p class="px-4 bg-primary text-secondary rounded-tr-md">{{ $favorimatch->match->date_match->formatLocalized('%H:%M')}}</p>
                        </div>
                        <div class="grid grid-cols-3">
                            <div class="flex flex-col items-center justify-center overflow-hidden">
                                <div class="logo h-14 w-14 cursor-pointer">
                                    <img class="object-contain" src="https://android-apiapp.azureedge.net/common/bib_img/logo/{{ $favorimatch->match->homeClub->numAffiliation }}.jpg" alt="logo">
                                </div>
                                <div class="ml-2">
                                    <p class="text-xs truncate">{{$favorimatch->match->homeClub->name}}</p>
                                </div>
                            </div>
                            <div class="flex items-center justify-center text-secondary">
                                <p class="text-3xl p-2 font-bold">VS</p>
                            </div>
                            <div class="flex flex-col items-center justify-center overflow-hidden">
                                <div class="logo h-14 w-14 cursor-pointer">
                                    <img class="object-contain" src="https://android-apiapp.azureedge.net/common/bib_img/logo/{{ $favorimatch->match->awayClub->numAffiliation }}.jpg" alt="logo">
                                </div>
                                <div class="ml-2">
                                    <p class="text-xs truncate">{{$favorimatch->match->awayClub->name}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                @endif
                @endforeach
                @else
                <div>
                    <div class="my-2">
                        <p class="text-center font-bold">Envie de suivre un match ?</p>
                    </div>
                    <div class="flex justify-between items-center px-3 rounded-lg bg-secondary">
                        <p>La liste est ici </p>
                        <a class="btn btnPrimary m-2" href="{{ route('matches.index') }}">Go !</a>
                    </div>
                </div>
                @endif
                @else
                <p>Connecte toi pour ajouter des matchs</p>
                @endauth
            </div>
        </div>
    </div>
    @endauth
</section>
@endsection