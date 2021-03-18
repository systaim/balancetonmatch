@extends('layout')
@section('content')

<div id="slideHome" class="flex flex-col md:flex-row justify-between bg-primary overflow-hidden h-96 z-0">
    <div class="h-6/12 sm:h-8/12 md:h-auto md:w-6/12 img-bg-blend-home">
    </div>
    <div id="welcome" class="h-auto text-white py-4 md:w-6/12 px-12 xl:w-4/12 m-auto text-center">
        <div class="flex items-center justify-center">
            <hr class="w-10 border border-secondary">
            <h2 class="text-xl md:text-3xl my-2 mx-6 font-medium">Bienvenue</h2>
            <hr class="w-10 border border-secondary">
        </div>
        <p class="text-sm md:text-base">BalanceTonMatch.com a pour but de rassembler les passionnés du ballon rond AMATEUR.</p>
        <p class="text-sm md:text-base">Vous pourrez suivre les matchs en <span class="uppercase text-primary font-bold bg-secondary px-2 rounded-sm">live</span> soit en tant que commentateur soit en tant que spectateur</p>
    </div>
</div>
<div id="wrong" class="bg-red-600 shadow-xl text-white">
    <div class="container mx-auto flex justify-around px-5 py-6 md:flex-row flex-col items-center">
        <div class="lg:flex-grow md:w-1/2 flex flex-col md:items-start md:text-left items-center text-center">
            <h2 class="sm:text-4xl text-3xl mb-4 font-medium">Le sport amateur est arrêté</h2>
            <p class="mb-8">La crise sanitaire étant, le foot amateur est bloqué jusque nouvel ordre...</p>
            <p class="mb-8">
            En espérant que tout reparte à la normal, pour la saison 2021-2022 vous pourrez créer de nouveau vos matchs.
            En attendant, vous pouvez continuer à créer ou gérer les joueurs de votre club.
            </p>
        </div>
        <div class="lg:max-w-lg lg:w-full md:w-1/2 w-5/6 mb-10 md:mb-0">
            <img class="object-cover object-center rounded" alt="hero" src="{{ asset('images/wrong.jpg') }}">
        </div>
    </div>
</div>
<div class="relative py-4">
    <div class="w-11/12 py-8 m-auto md:w-8/12 xl:w-6/12">
        <form class="w-full shadow-2xl" action="{{ asset('clubs') }}" method="get">
            @csrf
            <label class="relative" for="search">
                <input class="inputForm w-full border-2" type="search" placeholder="Nom du club, de la ville ou code postal" name="search" id="search">
                <i class="absolute text-xl mr-3 top-0 right-0 text-primary fas fa-search"></i>
            </label>
            <input class="sr-only" type="submit">
        </form>
    </div>
    <div class="flex flex-wrap justify-around items-center m-auto xl:w-8/12">
        <a href="/live" class="cursor-pointer">
            <div id="live" class="relative w-80 lg:w-96 bg-primary h-64 lg:h-72 p-2 text-white flex flex-col justify-around items-center m-6 shadow-xl">
                <p class="font-bold uppercase">Les matchs en live</p>
                <i class="relative text-6xl fas fa-microphone-alt my-4">
                    <div class="animate-ping absolute -top-0.5 right-1 bg-red-500 h-3 w-3 rounded-full z-10"></div>
                </i>
                <p class="absolute top-2 left-2 py-1 px-2 text-xl text-primary font-bold bg-secondary">LIVE</p>
                <div class="flex justify-end w-full">
                    <button class="btn btnSecondary">Par ici !</button>
                </div>
                <!-- <p>Tous les matchs en live</p> -->
            </div>
        </a>
        <a href="/matches" class="cursor-ponter">
            <div id="weekend" class="relative w-80 lg:w-96 bg-primary h-64 lg:h-72 px-2 text-white flex flex-col justify-between items-center m-6 shadow-xl py-4">
                <p class="font-bold uppercase">Les prochains matchs</p>
                <!-- <i class="relative text-6xl fas fa-futbol my-4"></i> -->
                <div class="flex justify-end w-full">
                    <button class="btn btnSecondary">Je jette un oeil</button>
                </div>
            </div>
        </a>
    </div>
</div>

<div class="py-6">
    <div class="flex justify-center">
        <h3 class="p-2 text-primary text-2xl">La saison 2020/2021 c'est : </h3>
    </div>
    <div class="flex flex-wrap justify-center">
        <div class="flex justify-between">
            <div class="flex flex-col items-center justify-center text-primary w-20 h-20 md:w-28 md:h-28 lg:w-40 lg:h-40 md:bg-primary md:text-white my-2 mx-1 rounded-lg shadow-lg">
                <p class="compteur text-xl lg:text-5xl font-bold">{{ count($matches) + 300}}</p>
                <p class="text-xs lg:text-base">{{ count($matches) <= 1 ? "matchs" : "matchs"}}</p>
            </div>
            <div class="flex flex-col items-center justify-center text-primary w-20 h-20 md:w-28 md:h-28 lg:w-40 lg:h-40 md:bg-primary md:text-white my-2 mx-1 rounded-lg shadow-lg">
                <p class="compteur text-xl lg:text-5xl font-bold">{{ count($clubs) }}</p>
                <p class="text-xs lg:text-base">clubs</p>
            </div>
            <div class="flex flex-col items-center justify-center text-primary w-20 h-20 md:w-28 md:h-28 lg:w-40 lg:h-40 md:bg-primary md:text-white my-2 mx-1 rounded-lg shadow-lg">
                <p class="compteur text-xl lg:text-5xl font-bold">{{ count($players) + count($staffs) + 2450}}</p>
                <p class="text-xs lg:text-base">licenciés</p>
            </div>
        </div>
        <div class="flex justify-between">
            <div class="flex flex-col items-center justify-center text-primary w-20 h-20 md:w-28 md:h-28 lg:w-40 lg:h-40 md:bg-primary md:text-white my-2 mx-1 rounded-lg shadow-lg">
                <p class="compteur text-xl lg:text-5xl font-bold">{{ count($goals) + 580}}</p>
                <p class="text-xs lg:text-base">{{ count($goals) <= 1 ? "buts" : "buts"}}</p>
            </div>
            <div class="flex flex-col items-center justify-center text-primary w-20 h-20 md:w-28 md:h-28 lg:w-40 lg:h-40 md:bg-primary md:text-white my-2 mx-1 rounded-lg shadow-lg">
                <p class="compteur text-xl lg:text-5xl font-bold">{{ count($commentators) + 90}}</p>
                <p class="text-xxs lg:text-base">{{ count($commentators) <= 1 ? "commentateurs" : "commentateurs"}} </p>
            </div>
            <div class="flex flex-col items-center justify-center text-primary w-20 h-20 md:w-28 md:h-28 lg:w-40 lg:h-40 md:bg-primary md:text-white my-2 mx-1 rounded-lg shadow-lg">
                <p class="compteur text-xl lg:text-5xl font-bold">{{ count($yellowCards)  +  count($redCards) + 359}}</p>
                <p class="text-xs lg:text-base">{{ count($yellowCards)  +  count($redCards) <= 1 ? "cartons" : "cartons"}}</p>
            </div>
        </div>
    </div>
</div>

@auth
<div class="flex flex-col w-full lg:flex-row justify-around py-8">

    @if(count($user->favoristeams) > 0 )
    <div class="lg:w-5/12">
        <div>
            <h3><i class="fas fa-heart text-red-700"></i> Mes teams préférées <i class="fas fa-heart text-red-700"></i></h3>
        </div>
        <div class="py-4">
            @foreach($user->favoristeams->shuffle() as $favoriteam)
            <a href="{{ route('clubs.show', $favoriteam->club->id) }}">
                <div class="flex flex-col mb-3">
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
        </div>
    </div>
    @endif


    @if(count($user->favorismatches) > 0 )
    <div class="lg:w-5/12">
        <div class="">
            <h3 class=""><i class="fas fa-star text-red-700"></i> Mes matchs favoris <i class="fas fa-star text-red-700"></i></h3>
        </div>
        <div class="py-4">
            @foreach($user->favorismatches as $favorimatch)
            @if($favorimatch->match->date_match > $today)
            <a href="{{route('matches.show',$favorimatch->match)}}">
                <div class="p-2 bg-primary text-white rounded-lg">
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
        </div>
    </div>
    @endif
</div>
@endauth

@endsection