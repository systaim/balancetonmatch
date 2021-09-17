@extends('layout')
@section('content')

    @livewire('team-cover', ['club' => $club])

    <div id="infos" class="flex flex-col items-center justify-between">
        <div
            class="w-11/12 md:w-8/12 lg:w-6/12 m-auto bg-primary p-2 shadow-lg text-white rounded-lg flex flex-col md:flex-row justify-around items-center">
            @livewire('my-team', ['user' => $user, 'club' => $club])
            @livewire('favori-team', ['user' => $user, 'club' => $club,'nbrFavoris' => $nbrFavoris])
        </div>
    </div>
    <div
        class="bg-primary text-white shadow-lg relative my-2 flex flex-col p-4 w-full m-auto md:w-8/12 lg:w-6/12 rounded-lg">
        <h4 class="text-center text-6xl">{{ $club->abbreviation }}</h4>
        <h3 class="text-center text-secondary mb-4 text-2xl">Infos du club</h3>
        @livewire('update-team',['club' => $club])
        {{-- @cannot('update-club', $club)
            <div class="flex-col justify-center my-4 m-auto">
                <p>Des joueurs ou dirigeants manquent ?</p>
                @auth
                    <form class="flex justify-center" action="{{ route('contacts.askPlayer') }}" method="POST">
                        @csrf
                        <input class="hidden" type="text" name="clubName" value="{{ $club->name }}">
                        <input class="hidden" type="text" name="clubId" value="{{ $club->id }}">
                        <button class="btn btnSecondary" wire:click="askPlayer">Je demande la création</button>
                    </form>
                @else
                    <a href="/login" class="flex justify-center"><button class="btn btnSecondary">Se connecter</button></a>
                @endauth
            </div>
        @endcannot --}}
        <div class="flex flex-col items-center xl:flex-row xl:justify-center mt-3">
            @if ($nbrPlayers == 0)
                {{-- @canany(['update-club', 'isAdmin', 'isSuperAdmin'], $club) --}}
                @auth
                    @if (Auth::user()->club_id == $club->id)
                        <a href="{{ route('clubs.players.create', $club) }}">
                            <button class="btn btnSecondary">
                                Créer un joueur
                            </button>
                        </a>
                    @endif
                @endauth
                {{-- @endcanany --}}
            @else
                <a href="{{ route('clubs.players.index', $club) }}">
                    <button class="btn btnSecondary">
                        @if ($nbrPlayers == 1)
                            Voir le joueur
                        @else
                            Voir les {{ $nbrPlayers }} joueurs
                        @endif
                    </button>
                </a>
            @endif
            @if ($nbrStaffs == 0)
                @auth
                    @if (Auth::user()->club_id == $club->id)
                        <a href="{{ route('clubs.staffs.create', $club) }}">
                            <button class="btn btnSecondary">
                                Créer un dirigeant
                            </button>
                        </a>
                    @endif
                @endauth
            @else
                <a href="{{ route('clubs.staffs.index', $club) }}">
                    <button class="btn btnSecondary">
                        @if ($nbrStaffs == 1)
                            Voir le manager
                        @else
                            Voir les {{ $nbrStaffs }} managers
                        @endif
                    </button>
                </a>
            @endif
        </div>
    </div>
    <!-- devenir referent-club -->
    @auth
        @if (Auth::user()->club && Auth::user()->role == 'guest' && $club->id == Auth::user()->club_id)
            <div class="w-11/12 md:w-8/12 lg:w-6/12 m-auto">
                <div class="flex items-center justify-around my-2 bg-primary p-4 text-white shadow-xl rounded-lg">
                    <p>Je souhaite devenir un des référent du club</p>
                    <form action="{{ route('contacts.becomeManager') }}" method="post" style="display: none;">
                        @csrf
                    </form>
                    <a id="btnDemande" class="btn btnSecondary">Demander</a>
                </div>

                <div id="formDirigeant" class="hidden fixed z-50 inset-0 justify-center items-center"
                    style="background-color: rgba(0,0,0,.5);">
                    <div class="absolute top-10 right-10">
                        <a href="" class="text-4xl text-secondary font-bold">X</a>
                    </div>
                    <div class="p-10 bg-white w-full sm:w-11/12 md:w-9/12 lg:w-6/12 rounded-lg shadow-xl">
                        <form action="{{ route('contacts.becomeManager') }}" method="post">
                            @csrf
                            <h2 class="text-center mb-6">Es-tu sûr de vouloir faire la demande pour <span
                                    class="font-bold">{{ Auth::user()->club->name }}</span> ?</h2>
                            <p>Avant de valider, vérifie bien ton adresse mail pour bien recevoir nos messages</p>
                            <p>On reviendra très vite vers toi !</p>
                            <div class="flex justify-end">
                                <a href="" class="btn mx-8">J'annule</a>
                                <input type="submit" class="btn btnSuccess" value="Je valide"></input>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    @endauth

    <div class="sm:w-11/12 md:w-9/12 xl:w-7/12 mx-auto my-10">
        <h3 class="text-2xl text-center my-4 border-b-2 border-darkGray">Prochain(s) match(s)</h3>
        @if (collect($matchsCF)->isNotEmpty())
            <div class="mt-6">
                <h4 class="inline-block text-xl px-3 text-center bg-secondary text-primary rounded-md shadow-lg ml-2">Coupe de France</h4>
                @foreach ($matchsCF as $match)
                    @if ($match->date_match > now())
                        @include('match')
                    @endif
                @endforeach
            </div>
        @endif
        @if (collect($matchsBZH)->isNotEmpty())
            <div class="mt-6">
                <h4 class="inline-block text-xl px-3 text-center bg-secondary text-primary rounded-md shadow-lg ml-2">Coupe de Bretagne</h4>
                @foreach ($matchsBZH as $match)
                    @if ($match->date_match > now())
                        @include('match')
                    @endif
                @endforeach
            </div>
        @endif
        @if (collect($matchsR1)->isNotEmpty())
            <div class="mt-6">
                <h4 class="inline-block text-xl px-3 text-center bg-secondary text-primary rounded-md shadow-lg ml-2">R1</h4>
                @foreach ($matchsR1 as $match)
                    @if ($match->date_match > now())
                        @include('match')
                    @endif
                @endforeach
            </div>
        @endif
        @if (collect($matchsR2)->isNotEmpty())
            <div class="mt-6">
                <h4 class="inline-block text-xl px-3 text-center bg-secondary text-primary rounded-md shadow-lg ml-2">R2</h4>
                @foreach ($matchsR2 as $match)
                    @if ($match->date_match > now())
                        @include('match')
                    @endif
                @endforeach
            </div>
        @endif
        @if (collect($matchsR3)->isNotEmpty())
            <div class="mt-6">
                <h4 class="inline-block text-xl px-3 text-center bg-secondary text-primary rounded-md shadow-lg ml-2">R3</h4>
                @foreach ($matchsR3 as $match)
                    @if ($match->date_match > now())
                        @include('match')
                    @endif
                @endforeach
            </div>
        @endif
        @if (collect($matchsD1)->isNotEmpty())
            <div class="mt-6">
                <h4 class="inline-block text-xl px-3 text-center bg-secondary text-primary rounded-md shadow-lg ml-2">D1</h4>
                @foreach ($matchsD1 as $match)
                    @if ($match->date_match > now())
                        @include('match')
                    @endif
                @endforeach
            </div>
        @endif
        @if (collect($matchsD2)->isNotEmpty())
            <div class="mt-6">
                <h4 class="inline-block text-xl px-3 text-center bg-secondary text-primary rounded-md shadow-lg ml-2">D2</h4>
                @foreach ($matchsD2 as $match)
                    @if ($match->date_match > now())
                        @include('match')
                    @endif
                @endforeach
            </div>
        @endif
        @if (collect($matchsD3)->isNotEmpty())
            <div class="mt-6">
                <h4 class="inline-block text-xl px-3 text-center bg-secondary text-primary rounded-md shadow-lg ml-2">D3</h4>
                @foreach ($matchsD3 as $match)
                    @if ($match->date_match > now())
                        @include('match')
                    @endif
                @endforeach
            </div>
        @endif
        <a class="flex justify-center" href="{{ route('matches.create') }}">
            <button class="btn btnSecondary">Je crée un match</button>
        </a>
    </div>
    {{-- <div class="sm:w-11/12 md:w-9/12 xl:w-7/12 mx-auto">
        <h3 class="text-2xl text-center my-4 border-b-2 border-darkGray">Historique des matchs</h3>
        @if (count($matchs) != 0)
            @foreach ($matchs->sortByDesc('date_match') as $key => $match)
                @if ($match->date_match < now())
                    <h4 class="inline-block text-xl px-3 text-center bg-secondary text-primary rounded-md shadow-lg ml-2">{{ $match->competition->name }}</h4>
                    @include('match')
                @endif
            @endforeach
        @else
            <p class="pl-2">Pas d'historique de matchs pour le moment</p>
        @endif
    </div> --}}
@endsection

<script>
    let formDirigeant = document.getElementById("formDirigeant");
    let btnDemande = document.getElementById("btnDemande");

    btnDemande.addEventListener("click", function() {
        formDirigeant.classList.add("flex");
        formDirigeant.classList.remove("hidden");
    });
</script>
