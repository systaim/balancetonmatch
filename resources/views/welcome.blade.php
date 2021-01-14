@extends('layout')
@section('content')
<section class="min-h-screen">
    <div>
        <div class="flex flex-col md:flex-row justify-between bg-primary overflow-hidden h-96 mb-2">
            <div class="h-6/12 sm:h-8/12 md:h-auto md:w-6/12 img-bg-blend-home">
            </div>
            <div class="h-auto text-white py-4 md:w-6/12 px-12 lg:px-24 xl:px-32 m-auto text-center">
                <div class="flex items-center justify-center">
                    <hr class="w-10 border border-secondary">
                    <h2 class="text-xl md:text-3xl my-2 mx-6">Bienvenue</h2>
                    <hr class="w-10 border border-secondary">
                </div>
                <p class="text-sm md:text-base">BalanceTonMatch.com a pour but de rassembler les passionnés du ballon rond AMATEUR.</p>
                <p class="text-sm md:text-base">Il est possible de gérer ton club mais surtout de commenter et de suivre les matchs.</p>
            </div>
        </div>
    </div>
    <div class="mb-2 rounded-md mx-2">
        @if(isset($_SERVER['REMOTE_ADDR']))
            {{ $_SERVER['REMOTE_ADDR'] }}
        @endif
        <!-- <H3 class="py-2">Rechercher un club</H3> -->
        <form class="py-4" action="{{ asset('clubs') }}" method="get">
            @csrf
            <h3>Recherche d'un club</h3>
            <label class="relative" for="search">
                <input class="inputForm w-full" type="search" placeholder="F.C. Recherche" name="search" id="search">
                <span class=" z-10"><i class="far fa-search"></i></span>
            </label>
            <input class="sr-only" type="submit">
        </form>
    </div>
    <div class="bg-white p-4 rounded-md text-primary w-11/12 m-auto mb-2">
        <h3 class="text-center mb-6">Quelques statistiques... </h3>
        <hr>
        <p class="text-center mt-6">{{ count($futurMatches) }} matchs sont à venir</p>
        <p class="text-center">{{ count($matches) }} matchs ont été créés</p>
        <p class="text-center">{{ count($clubs) }} clubs créés</p>
        <p class="text-center">{{ count($players) }} joueurs et {{ count($staffs) }} membres de staff</p>
        <p class="text-center">{{ count($goals) }} buts marqués</p>
    </div>
    @auth
    <div class="w-11/12 m-auto md:flex">
        <div class="bg-white rounded-lg border-white m-auto my-4 shadow-2xl lg:w-5/12">
            <div class="bg-primary text-secondary rounded-t-lg">
                <h3 class="text-center py-2"><i class="fas fa-heart text-red-700"></i> Mes teams favorites <i class="fas fa-heart text-red-700"></i></h3>
            </div>
            <div class="p-2 height-mini-10">
                @auth
                @if(count($user->favoristeams) > 0 )
                @foreach($user->favoristeams as $favoriteam)
                <a href="{{ route('clubs.show', $favoriteam->club->id) }}">
                    <div class="flex items-center my-2 px-4">
                        <div class="logo h-10 w-10 cursor-pointer">
                            <img class="object-contain" src="https://android-apiapp.azureedge.net/common/bib_img/logo/{{ $favoriteam->club->numAffiliation }}.jpg" alt="logo">
                        </div>
                        <div class="ml-2">
                            <p class="font-bold">{{ $favoriteam->club->name }}</p>
                        </div>
                    </div>
                </a>
                @endforeach
                @else
                <div>
                    <div class="my-2">
                        <p class="text-center font-bold">Tu n'as pas encore de clubs en favoris</p>
                    </div>
                    <div class="flex justify-between items-center px-3 rounded-lg bg-secondary">
                        <p>Fais ta recherche ici</p>
                        <a class="btn btnPrimary m-2" href="{{ route('clubs.index') }}">Go !</a>
                    </div>
                </div>
                @endif
                @else
                <p>Connecte toi pour ajouter des équipes</p>
                @endauth
            </div>
        </div>
        <div class="bg-white rounded-lg border-white m-auto my-4 shadow-2xl lg:w-5/12">
            <div class="bg-primary text-secondary rounded-t-lg">
                <h3 class="text-center py-2"><i class="fas fa-star text-red-700"></i> Mes matchs en favoris <i class="fas fa-star text-red-700"></i></h3>
            </div>
            <div class="p-2 height-mini-10">
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