@extends('layout')
@section('content')
<section class="w-11/12 m-auto">
    <div class="flex flex-col items-center mt-4 relative">
        <div class="logo h-24 w-24">
            <img class="object-contain" src="https://android-apiapp.azureedge.net/common/bib_img/logo/{{$club->numAffiliation}}.jpg" alt="logo">
        </div>
        @livewire('favori-team', ['user' => $user, 'club' => $club,'nbrFavoris' => $nbrFavoris])
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
    <div>
        <h3 class="text-center my-4 border-b-2 border-darkGray">Prochain match</h3>
        @foreach($matchs as $match)
        @if($match->date_match > now())
        <a href="{{route('matches.show',$match)}}">
            @include('match')
        </a>
        @endif
        @endforeach
    </div>
    <div>
        <h3 class="text-center my-4 border-b-2 border-darkGray">Historique des matchs</h3>
        @foreach($matchs as $match)
        @if($match->date_match < now()) 
        <a href="{{route('matches.show',$match)}}">
            @include('match')
        </a>
            @endif
            @endforeach
    </div>

</section>
@endsection