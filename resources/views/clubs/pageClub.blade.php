@extends('layout')
@section('content')

    @livewire('team-cover', ['club' => $club])

    <div id="infos" class="flex flex-col items-center justify-between">
        <div class="w-11/12 md:w-8/12 lg:w-6/12 m-auto bg-primary p-2 shadow-lg text-white">
            @livewire('favori-team', ['user' => $user, 'club' => $club,'nbrFavoris' => $nbrFavoris])
        </div>
    </div>
    <div class="bg-primary text-white shadow-lg relative my-2 flex flex-col p-4 w-full m-auto md:w-8/12 lg:w-6/12">
        <h4 class="text-center text-6xl">{{ $club->abbreviation }}</h4>
        <h3 class="text-center text-secondary mb-4">Infos du club</h3>
        @livewire('update-team',['club' => $club])
        <!-- <form class="my-4 m-auto" action="{{ route('contacts.askPlayer') }}" method="POST">
            @csrf
            <input class="hidden" type="text" name="clubName" value="{{ $club->name }}">
            <input class="hidden" type="text" name="clubId" value="{{ $club->id }}">
            <button class="btn btnSecondary" wire:click="askPlayer">Demander</button>
        </form> -->
        <div class="flex flex-col items-center xl:flex-row xl:justify-center mt-3">
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
                    Créer un dirigeant
                </button>
            </a>
            @else
            <a href="{{ route('clubs.staffs.index', $club) }}">
                <button class="btn btnSecondary">
                    @if($nbrStaffs == 1)
                    Voir le manager
                    @else
                    Voir les {{ $nbrStaffs }} managers
                    @endif
                </button>
            </a>
            @endif
            <!-- <form action="{{ route('contacts.askPlayer') }}" method="post">
                @csrf
                <p>Pas encore de joueurs pour créer</p>
                <p>Demande la création aux dirigeants</p>
                <input type="text" class="hidden" value="{{ $club->id}}">
                <input class="btn" type="submit" value="Je demande">
            </form> -->

        </div>
    </div>
    <div class="sm:w-11/12 md:w-9/12 xl:w-7/12 mx-auto">
        <h3 class="text-center my-4 border-b-2 border-darkGray">Prochain(s) match(s)</h3>
        @foreach($matchs as $match)
        @if($match->date_match > now())
        <h3>{{ $match->competition->name }}</h3>
        <a href="{{route('matches.show',$match)}}">
            @include('match')
        </a>
        @endif
        @endforeach
        @if($matchs == "" || $matchs == null)
        <p class="pl-2">Pas de match à venir</p>
        @endif
        <a class="flex justify-center" href="{{ route('matches.create') }}">
            <button class="btn btnSecondary">Je crée un match</button>
        </a>

    </div>
    <div class="sm:w-11/12 md:w-9/12 xl:w-7/12 mx-auto">
        <h3 class="text-center my-4 border-b-2 border-darkGray">Historique des matchs</h3>
        @if(count($matchs) != 0)
        @foreach($matchs as $match)
        @if($match->date_match < now()) <h3>{{ $match->competition->name }}</h3>
            <a href="{{route('matches.show',$match)}}">
                @include('match')
            </a>
            @endif
            @endforeach
            @else
            <p class="pl-2">Pas d'historique de matchs pour le moment</p>
            @endif
    </div>
@endsection