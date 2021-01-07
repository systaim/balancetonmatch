@extends('layout')
@section('content')
<section class="min-h-screen">
    <div class="p-4 lg:p-12 lg:h-96 back-hero-home flex sm:justify-center lg:justify-end">
        <div class="lg:w-1/2 flex items-center">
            <div class="bg-white p-4 rounded-md text-primary">
                <h2 class="text-3xl text-primary my-2">Bienvenue</h2>
                <p>Ce site a pour but de rassembler les passionnés du ballon rond AMATEUR</p>
                <p>Tout est possible ici ! Et surtout la possibilité de commenter ou de suivre les matchs en live de ton équipe favorite</p>
            </div>
        </div>
    </div>
    <div class="py-4">
        <div class="flex flex-col lg:flex-row justify-between bg-primary overflow-hidden rounded-b-lg w-11/12 m-auto rounded-lg">
            <div class="w-full sm:h-72 lg:w-6/12 lg:h-auto img-bg-blend-home"></div>
            <div class="text-white p-4 lg:w-6/12 xl:p-10 m-auto">
                <h3 class="text-center mb-6">Quelques statistiques... </h3>
                <hr>
                <p class="text-center mt-6">{{ count($futurMatches) }} matchs sont à venir</p>
                <p class="text-center">{{ count($matches) }} matchs ont été créés</p>
                <p class="text-center">{{ count($clubs) }} clubs créés</p>
                <p class="text-center">{{ count($players) }} joueurs et {{ count($staffs) }} membres de staff</p>
                <p class="text-center">{{ count($goals) }} buts marqués</p>
                <a class="m-auto flex justify-center" href="{{ route('clubs.index') }}">
                    <button class="btn btnSecondary">Je vais voir</button>
                </a>
            </div>
        </div>
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