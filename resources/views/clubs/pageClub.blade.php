@extends('layout')
@section('content')

<section class="relative m-auto min-h-screen">

    @livewire('team-cover', ['club' => $club])

    <div id="infos" class="flex flex-col items-center justify-between p-4">
        <div class="w-11/12 md:w-8/12 lg:w-6/12 m-auto bg-primary p-2 rounded-lg text-white">
            @livewire('favori-team', ['user' => $user, 'club' => $club,'nbrFavoris' => $nbrFavoris])
        </div>
        <div class="bg-primary text-white rounded-lg relative my-2 flex flex-col p-6 w-full m-auto md:w-8/12 lg:w-6/12">
            <h3 class="text-center text-secondary mb-4">Infos du club</h3>
            @livewire('update-team',['club' => $club])
            <div class="flex flex-col items-center xl:flex-row xl:justify-center">
                @if($nbrPlayers == 0)
                <a href="{{ route('clubs.players.create', $club) }}">
                    <button class="btn btnSecondary">
                        Créer un joueur
                    </button>
                </a>
                @else
                <a href="{{ route('clubs.players.index', $club) }}">
                    <button class="btn btnSecondary">
                        @if($nbrPlayers == 1)
                        Voir le joueur
                        @else
                        Voir les {{ $nbrPlayers }} joueurs
                        @endif
                    </button>
                </a>
                @endif
                @if($nbrStaffs == 0)
                <a href="{{ route('clubs.staffs.create', $club) }}">
                    <button class="btn btnSecondary">
                        Créer un membre du staff
                    </button>
                </a>
                @else
                <a href="{{ route('clubs.staffs.index', $club) }}">
                    <button class="btn btnSecondary">
                        @if($nbrStaffs == 1)
                        Voir le membre du staff
                        @else
                        Voir les {{ $nbrStaffs }} membres du staff
                        @endif
                    </button>
                </a>
                @endif
            </div>
        </div>
    </div>
    <div class="sm:w-11/12 md:w-9/12 xl:w-7/12 mx-auto">
        <h3 class="text-center my-4 border-b-2 border-darkGray">Prochain match</h3>
        @if(count($matchs) != 0)
        @foreach($matchs as $match)
        @if($match->date_match > now())
        <a href="{{route('matches.show',$match)}}">
            @include('match')
        </a>
        @endif
        @endforeach
        @else
        <p>Pas de match à venir</p>
        @endif
    </div>
    <div class="sm:w-11/12 md:w-9/12 xl:w-7/12 mx-auto">
        <h3 class="text-center my-4 border-b-2 border-darkGray">Historique des matchs</h3>
        @if(count($matchs) != 0)
        @foreach($matchs as $match)
        @if($match->date_match < now()) <a href="{{route('matches.show',$match)}}">
            @include('match')
            </a>
            @endif
            @endforeach
            @else
            <p>Pas d'historique de matchs pour le moment</p>
            @endif
    </div>

</section>
@endsection