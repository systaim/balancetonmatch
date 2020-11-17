@extends('layout')
@section('content')
<section>
    <div class=" h-auto p-4">
        <!-- <h3 class="text-center text-3xl">Le site pour suivre le foot amateur de n'importe où !</h3> -->
        <p class=" bg-primary text-white rounded-lg relative my-2 flex flex-col p-3 w-full">Pas dispo pour aller encourager ton équipe favorite ?</p>
        <p class=" bg-primary text-white rounded-lg relative my-2 flex flex-col p-3 w-full">Tu souhaites connaitre l'évolution d'un match ?</p>
        <p class=" bg-primary text-white rounded-lg relative my-2 flex flex-col p-3 w-full">Tu peux le suivre en direct LIVE</p>
    </div>
</section>
<section>
    <div class="w-11/12 m-auto">
        <div class="bg-white rounded-lg border-white m-auto my-4 shadow-2xl">
            <div class="bg-primary text-secondary rounded-t-lg">
                <h3 class="text-center py-2"><i class="fas fa-heart text-red-700"></i> Mes teams favorites <i class="fas fa-heart text-red-700"></i></h3>
            </div>
            <div class="p-2 height-mini-10">
                @auth
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
                <p>Connecte toi pour ajouter des équipes</p>
                @endauth
            </div>
        </div>
        <div class="bg-white rounded-lg border-white m-auto my-8 shadow-2xl">
            <div class="bg-primary text-secondary rounded-t-lg">
                <h3 class="text-center py-2"><i class="fas fa-star text-red-700"></i> Mes matchs en favoris <i class="fas fa-star text-red-700"></i></h3>
            </div>
            <div class="p-2 height-mini-10">
                @auth
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
                <p>Connecte toi pour ajouter des matchs</p>
                @endauth
            </div>
        </div>
    </div>
</section>
@endsection