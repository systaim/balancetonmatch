@extends('layout')
@section('content')

<section class="relative w-11/12 m-auto min-h-screen">
    <div class="absolute top-12 left-12 sm:left-24">
        @livewire('favori-team', ['user' => $user, 'club' => $club,'nbrFavoris' => $nbrFavoris])
    </div>
    @include('clubs.logo')
    <div class="md:w-8/12 lg:w-6/12 m-auto">
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
    <div class=" bg-primary text-white rounded-lg relative my-2 flex flex-col p-6 w-full m-auto md:w-8/12 lg:w-6/12">
        <h3 class="text-center text-secondary mb-4">Infos du club</h3>
        {{--@livewire('update-team',['club' => $club])--}}
        <div class="flex justify-evenly">
            <a href="{{ route('clubs.players.index', $club) }}"><button class="btn btnSecondary">Voir les joueurs</button></a>
            <a href="{{ route('clubs.staffs.index', $club) }}"><button class="btn btnSecondary">Voir le staff</button></a>
        </div>
    </div>
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
        @if($match->date_match < now()) <a href="{{route('matches.show',$match)}}">
            @include('match')
            </a>
            @endif
            @endforeach
    </div>

</section>
@endsection