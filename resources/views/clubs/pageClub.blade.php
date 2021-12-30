@extends('layout')
@section('content')

    @livewire('team-cover', ['club' => $club])

    <div class="max-w-3xl mx-auto sm:px-6 lg:max-w-7xl lg:px-8 lg:grid lg:grid-cols-12 lg:gap-8">
        <aside class="hidden xl:block xl:col-span-4 mt-4 lg:mt-0">
            <div class="sticky top-4 space-y-4">
                <section>
                    <div class="bg-primary text-white rounded-lg shadow max-h-96 overflow-scroll">
                        <div class="p-6">
                            <h2 class="text-base font-medium ">
                                Derniers évènements
                            </h2>
                            <div class="flow-root mt-6">
                                <ul role="list" class="-my-5 divide-y divide-gray-200">
                                    @foreach ($activities as $activite)
                                        <li class="py-4">
                                            <div class="flex items-center space-x-4">
                                                <div class="flex-1 min-w-0">
                                                    <div class="flex items-end">
                                                        <p class="text-sm font-medium">
                                                            {{ $activite->user->pseudo }}
                                                        </p>
                                                        <p class="text-xs ml-2">
                                                            {{ Carbon\Carbon::create($activite->created_at)->diffForHumans() }}
                                                        </p>
                                                    </div>
                                                    <p class="text-sm ">
                                                        {{ $activite->description }}
                                                    </p>
                                                </div>
                                                {{-- <div>
                                                    <a href="#"
                                                        class="inline-flex items-center shadow-sm px-2.5 py-0.5 border border-gray-300 text-xs leading-5 font-medium rounded-full text-gray-700 bg-white hover:bg-gray-50">
                                                        Lu
                                                    </a>
                                                </div> --}}
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </aside>
        <main class="lg:col-span-9 xl:col-span-8">
            <div id="infos" class="flex flex-col items-center justify-between">
                <div
                    class="my-2 w-full m-auto bg-primary p-6 shadow-lg rounded-lg flex flex-col md:flex-row justify-around items-center">
                    @livewire('my-team', ['user' => $user, 'club' => $club])
                    @livewire('favori-team', ['user' => $user, 'club' => $club,'nbrFavoris' => $nbrFavoris])
                </div>

                {{-- <div
                    class="my-2 w-full m-auto bg-primary text-white p-6 shadow-lg rounded-lg flex flex-col md:flex-row justify-around items-center">
                    <div>
                        <p>Il manque un joueur ?</p>
                        <button type="button" class="btn btnSecondary">Je le créé</button>
                    </div>
                </div> --}}
            </div>
            <!-- devenir referent-club -->
            @auth
                @if (Auth::user()->club && Auth::user()->role == 'guest' && $club->id == Auth::user()->club_id)
                    <div class="m-auto">
                        <div class="flex items-center justify-around my-2 bg-primary p-4 text-white shadow-xl rounded-lg">
                            <div>
                                <p>Devenir un des référent du club</p>
                                <p class="text-xs">Cela permettra de mettre à jour les infos du club.</p>
                                <p class="text-xs">Comme les intiales, les couleurs ou encore le logo</p>
                            </div>

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
                                        <input type="submit" class="btn btnSuccess" value="Je valide" />
                                    </div>
                                </form>
                            </div>
                        </div>
                        <script>
                            let formDirigeant = document.getElementById("formDirigeant");
                            let btnDemande = document.getElementById("btnDemande");

                            btnDemande.addEventListener("click", function() {
                                formDirigeant.classList.add("flex");
                                formDirigeant.classList.remove("hidden");
                            });
                        </script>
                    </div>
                @endif
            @endauth

            <div class="bg-primary text-white shadow-lg relative my-2 flex flex-col p-4 w-full m-auto rounded-lg">
                <h4 class="text-center text-6xl">{{ $club->abbreviation }}</h4>
                <h3 class="text-center text-secondary mb-4 text-2xl">Infos du club</h3>
                @livewire('update-team',['club' => $club])

                <div>
                    @foreach ($teams as $team)
                        <p>{{ $team->category->name }} {{ $team->category->type }}</p>
                    @endforeach
                </div>
                <div class="flex flex-col items-center xl:flex-row xl:justify-center mt-3">
                    @if ($nbrPlayers == 0)
                        @auth
                            @if (Auth::user()->club_id == $club->id)
                                <a href="{{ route('clubs.players.create', $club) }}">
                                    <button class="btn btnSecondary">
                                        Créer un joueur
                                    </button>
                                </a>
                            @endif
                        @endauth
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
        </main>
    </div>



    <div class="sm:w-11/12 md:w-9/12 xl:w-7/12 mx-auto my-10">
        <h3 class="text-2xl text-center my-4 border-b-2 border-darkGray">Prochain(s) match(s)</h3>
        @if (collect($matchsCF)->isNotEmpty())
            <div class="mt-6">
                <h4 class="inline-block text-xl px-3 text-center bg-secondary text-primary rounded-md shadow-lg ml-2">Coupe
                    de France</h4>
                @foreach ($matchsCF as $match)
                    @include('match')
                @endforeach
            </div>
        @endif
        @if (collect($matchsBZH)->isNotEmpty())
            <div class="mt-6">
                <h4 class="inline-block text-xl px-3 text-center bg-secondary text-primary rounded-md shadow-lg ml-2">Coupe
                    de Bretagne</h4>
                @foreach ($matchsBZH as $match)
                    @include('match')
                @endforeach
            </div>
        @endif
        @if (collect($matchsCoupeDep)->isNotEmpty())
            <div class="mt-6">
                <h4 class="inline-block text-xl px-3 text-center bg-secondary text-primary rounded-md shadow-lg ml-2">Coupe
                    Ange Lemée</h4>
                @foreach ($matchsCoupeDep as $match)
                    @include('match')
                @endforeach
            </div>
        @endif
        @if (collect($matchsR1)->isNotEmpty())
            <div class="mt-6">
                <h4 class="inline-block text-xl px-3 text-center bg-secondary text-primary rounded-md shadow-lg ml-2">R1
                </h4>
                @foreach ($matchsR1 as $match)
                    @include('match')
                @endforeach
            </div>
        @endif
        @if (collect($matchsR2)->isNotEmpty())
            <div class="mt-6">
                <h4 class="inline-block text-xl px-3 text-center bg-secondary text-primary rounded-md shadow-lg ml-2">R2
                </h4>
                @foreach ($matchsR2 as $match)
                    @include('match')
                @endforeach
            </div>
        @endif
        @if (collect($matchsR3)->isNotEmpty())
            <div class="mt-6">
                <h4 class="inline-block text-xl px-3 text-center bg-secondary text-primary rounded-md shadow-lg ml-2">R3
                </h4>
                @foreach ($matchsR3 as $match)
                    @include('match')
                @endforeach
            </div>
        @endif
        @if (collect($matchsD1)->isNotEmpty())
            <div class="mt-6">
                <h4 class="inline-block text-xl px-3 text-center bg-secondary text-primary rounded-md shadow-lg ml-2">D1
                </h4>
                @foreach ($matchsD1 as $match)
                    @include('match')
                @endforeach
            </div>
        @endif
        @if (collect($matchsD2)->isNotEmpty())
            <div class="mt-6">
                <h4 class="inline-block text-xl px-3 text-center bg-secondary text-primary rounded-md shadow-lg ml-2">D2
                </h4>
                @foreach ($matchsD2 as $match)
                    @include('match')
                @endforeach
            </div>
        @endif
        @if (collect($matchsD3)->isNotEmpty())
            <div class="mt-6">
                <h4 class="inline-block text-xl px-3 text-center bg-secondary text-primary rounded-md shadow-lg ml-2">D3
                </h4>
                @foreach ($matchsD3 as $match)
                    @include('match')
                @endforeach
            </div>
        @endif
        @if (collect($matchsD4)->isNotEmpty())
            <div class="mt-6">
                <h4 class="inline-block text-xl px-3 text-center bg-secondary text-primary rounded-md shadow-lg ml-2">D4
                </h4>
                @foreach ($matchsD4 as $match)
                    @include('match')
                @endforeach
            </div>
        @endif
        <a class="flex justify-center" href="{{ route('matches.create') }}">
            <button class="btn btnSecondary">Je crée un match</button>
        </a>
    </div>
    <div class="sm:w-11/12 md:w-9/12 xl:w-7/12 mx-auto">
        <h3 class="text-2xl text-center my-4 border-b-2 border-darkGray">Historique des matchs</h3>
        @if (count($matchs) != 0)
            @foreach ($matchs->sortByDesc('date_match') as $key => $match)
                @if ($match->date_match < now()->subHours(12))
                    {{-- <h4 class="inline-block text-xl px-3 text-center bg-secondary text-primary rounded-md shadow-lg ml-2">{{ $match->competition->name }}</h4> --}}
                    @include('match')
                @endif
            @endforeach
        @else
            <p class="pl-2">Pas d'historique de matchs pour le moment</p>
        @endif
        {{-- {{ $matchs->links() }} --}}
    </div>

@endsection
