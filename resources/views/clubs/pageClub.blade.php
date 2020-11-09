@extends('layout')
@section('content')
<section class="w-11/12 m-auto">
    <div class="flex flex-col items-center mt-4 relative">
        <div class="logo h-24 w-24">
            <img class="object-contain" src="https://android-apiapp.azureedge.net/common/bib_img/logo/{{$club->numAffiliation}}.jpg" alt="logo">
        </div>
        @livewire('favori-team', ['user' =>$user, 'club'=>$club,'nbrFavoris'=> $nbrFavoris])
        <div class="text-xl my-4 w-full">
            <div class="flex">
                <div class="h-2 w-full" style="background-color:{{ $club->primary_color }}"></div>
                <div class="h-2 w-full" style="background-color:{{ $club->secondary_color }}"></div>
            </div>
            <h2 class="text-center py-1">{{ $club->name }}</h2>
            <div class="flex">
                <div class="h-2 w-full" style="background-color:{{ $club -> primary_color }}"></div>
                <div class="h-2 w-full" style="background-color:{{ $club -> secondary_color }}"></div>
            </div>
        </div>
    </div>
    <div>
        @if($nbrFavoris > 0)
        <div class=" bg-primary text-white rounded-lg relative my-2 flex flex-col p-3 w-full">
            @if($nbrFavoris == 1)
            <p>Suivi par {{ $nbrFavoris }} fan</p>
            @else
            <p>Suivi par {{ $nbrFavoris }} fans</p>
            @endif
        </div>
        @endif
        <div>
        <h3 class="text-center mt-4">Bientôt</h3>
            @foreach($matchs as $match)
            @if($match->date_match > now())
            <div class="text-center flex justify-center font-bold">
                <p class="px-4 bg-primary text-secondary rounded-tl-md">{{ $match->date_match->formatLocalized('%d/%m/%y')}}</p>
                <p class="px-4 bg-primary text-secondary rounded-tr-md">{{ date('H:i', strtotime($match->time))}}</p>
            </div>
            <a href="{{route('matches.show',$match)}}">
                @include('match')
            </a>
            @endif
            @endforeach
        </div>
    </div>
    <div class=" bg-primary text-white rounded-lg relative my-2 flex flex-col p-3 w-full">
        <h3 class="text-center text-secondary">Infos du club</h3>
        @livewire('update-team',['club' => $club])
        <div class="flex justify-evenly">
            <a class="font-bold bg-secondary text-primary px-2 border-2 border-primary rounded-lg shadow-lg" href="{{ route('clubs.players.index', $club) }}">Voir les joueurs</a>
            <a class="font-bold bg-secondary text-primary px-2 border-2 border-primary rounded-lg shadow-lg" href="{{ route('clubs.staffs.index', $club) }}">Voir le staff</a>
        </div>
    </div>

</section>
<section class="w-11/12 m-auto">
    <h3 class="text-center mt-4">Historique de la saison</h3>
    <div>
        @foreach($matchs as $match)
        @if($match->date_match < now()) <div class="text-center flex justify-center font-bold">
            <p class="px-4 bg-primary text-secondary rounded-tl-md">{{ $match->date_match->formatLocalized('%d/%m/%y')}}</p>
            <p class="px-4 bg-primary text-secondary rounded-tr-md">{{ date('H:i', strtotime($match->time))}}</p>
    </div>
    <a href="{{route('matches.show',$match)}}">
        <div class="grid grid-cols-12 pb-4">
            <div class="col-span-5 overflow-hidden">
                <div class="bg-primary p-2 text-secondary flex flex-col rounded-l-lg">
                    <div class="flex justify-center">
                        <div class="logo h-8 w-8">
                            <img class="object-contain" src="https://android-apiapp.azureedge.net/common/bib_img/logo/{{ $match->homeClub->numAffiliation }}.jpg" alt="logo">
                        </div>
                    </div>
                    <div>
                        <p class="truncate text-center">{{ $match->homeClub->name }}</p>
                    </div>
                </div>
            </div>
            <div class="col-span-2 bg-gradient-to-r from-primary to-secondary flex flex-col justify-center items-center">
                <div class="flex justify-center">
                    <div class="bg-white rounded-sm mr-1">
                        <p class="flex justify-center w-4 text-3xl px-4 font-bold">{{$match->home_score}}</p>
                    </div>
                    <div class="bg-white rounded-sm ml-1 z-10">
                        <p class="flex justify-center w-4 text-3xl px-4 font-bold">{{$match->away_score}}</p>
                    </div>
                </div>
            </div>
            <div class="col-span-5 overflow-hidden z-0">
                <div class="bg-secondary p-2 text-primary flex flex-col rounded-r-lg">
                    <div class="flex justify-center">
                        <div class="logo h-8 w-8 cursor-pointer">
                            <img class="object-contain" src="https://android-apiapp.azureedge.net/common/bib_img/logo/{{ $match->awayClub->numAffiliation }}.jpg" alt="logo">
                        </div>
                    </div>
                    <div>
                        <p class="truncate text-center">{{ $match->awayClub->name }}</p>
                    </div>
                </div>
            </div>
        </div>
    </a>
    @endif
    @endforeach
    </div>
</section>
@endsection