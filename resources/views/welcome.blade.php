@extends('layout')

@section('content')
<section>
    <div class="w-11/12 m-auto">
        <div class="bg-white rounded-lg border-white m-auto my-8 shadow-2xl">
            <div class="bg-primary text-secondary rounded-t-lg">
                <h3 class="text-center py-2"><i class="fas fa-heart text-red-700"></i> Mes teams <i class="fas fa-heart text-red-700"></i></h3>
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
                @endauth
            </div>
        </div>
        <div class="bg-white rounded-lg border-white m-auto my-8 shadow-2xl">
            <div class="bg-primary text-secondary rounded-t-lg">
                <h3 class="text-center py-2"><i class="fas fa-star text-red-700"></i> à suivre <i class="fas fa-star text-red-700"></i></h3>
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
                                <div class="logo h-20 w-20 cursor-pointer">
                                    <img class="object-contain" src="https://android-apiapp.azureedge.net/common/bib_img/logo/{{ $favorimatch->match->homeClub->numAffiliation }}.jpg" alt="logo">
                                </div>
                                <div class="ml-2">
                                    <p class="text-xs truncate">{{$favorimatch->match->homeClub->name}}</p>
                                </div>
                            </div>
                            <div class="flex items-center justify-center text-secondary">
                                <p class="text-6xl p-2 font-bold">VS</p>
                            </div>
                            <div class="flex flex-col items-center justify-center overflow-hidden">
                                <div class="logo h-20 w-20 cursor-pointer">
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
                @endauth
            </div>
        </div>
        <div class="bg-white rounded-lg border-white m-auto my-8 shadow-2xl">
            <div class="bg-primary text-secondary rounded-t-lg">
                <h3 class="text-center py-2">Mes teams <i class="fas fa-heart text-red-700"></i></h3>
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
                @endauth
            </div>
        </div>
    </div>
</section>
@endsection