@extends('layout')
@section('content')
<a href="{{route('clubs.show', $club) }}">
    <div class="flex flex-col justify-center items-center mb-4">
        <div class="logo h-16 w-16 m-4">
            <img class="object-contain" src="https://android-apiapp.azureedge.net/common/bib_img/logo/{{$club->numAffiliation}}.jpg" alt="logo">
        </div>
        <div class="bg-primary text-secondary rounded-lg">
            <h2 class="mx-2 text-xl">{{ $club->name }}</h2>
        </div>
        <div>
            <p>← Retour page club</p>
        </div>
    </div>
</a>
<div class="my-8 relative overflow-hidden">
    <h3 class="text-center my-8">Les joueurs</h3>
    @foreach($club->players as $player)
    <div class="bg-primary text-white rounded-lg relative mb-4 flex flex-col p-3 sm:w-10/12 sm:mx-auto md:w-8/12 lg:w-7/12 xl:w-6/12">
        <!-- @livewire('update-player', ['player' => $player]) -->
        <div class="w-20 h-20 items-center logo mr-3" wire:click="clickPhoto">
            <img class="object-contain" src="{{ asset($player->avatar_path)}}" alt="avatar">
        </div>
        <div class="flex flex-col">
            <div>
                <h4 class="capitalize text-secondary">{{ $player->first_name}} <span class="uppercase">{{ $player -> last_name}}</span></h4>
            </div>
            <div>
                <p>{{ $player->position}}</p>
                <p>né le {{ date('d/m/Y',strtotime($player->date_of_birth)) }}</p>
            </div>
            <div class="absolute flex justify-center items-center right-2 top-1">
                <div>
                    <button onclick="openMenu()"><i class="far fa-edit"></i></button>
                </div>
            </div>
        </div>
        <div id="menuPlayer" class="updatePlayer flex justify-center items-center">
            <div class="p-10 bg-white w-1/2 rounded-lg shadow-xl">
                <form action="{{ route('clubs.players.store', $club) }}" method="post">
                    @foreach ($errors->all() as $message)
                    {{ $message}}
                    @endforeach
                    @csrf
                    <h5 class="text-primary text-center">Modifier le joueur</h5>
                    <div>
                        <div>
                            <label class="flex flex-col" for="last_name">Nom de famille</label>
                            <input class="inputForm focus:outline-none focus:shadow-outline w-full my-1" type="text" name="last_name" id="last_name" value="{{ $player -> last_name}}">
                        </div>
                        <div>
                            <label class="flex flex-col" for="first_name">Prénom</label>
                            <input class="inputForm focus:outline-none focus:shadow-outline w-full my-1" type="text" name="first_name" value="{{ $player -> first_name}}" id="first_name">
                        </div>
                        <div class="flex flex-col">
                            <label for="date_of_birth">Date de naissance</label>
                            <input class="inputForm focus:outline-none focus:shadow-outline w-full my-1" type="date" name="date_of_birth" id="date_of_birth" value="{{ $player -> date_of_birth}}">
                        </div>
                        <div>
                            <p>Position</p>
                            <div class="flex flex-col">
                                <select class="inputForm focus:outline-none focus:shadow-outline w-full my-1" name="position" id="position">
                                    <option>Choisissez une position</option>
                                    <option value="Gardien de but">Gardien de but</option>
                                    <option value="Défenseur">Défenseur</option>
                                    <option value="Milieu">Milieu</option>
                                    <option value="Attaquant">Attaquant</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <input class="btn btnPrimary" type="submit" value="J'enregistre le joueur">
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>
<div>
    <a href="{{ route('clubs.players.create', $club) }}">
        <p class="btn btnPrimary">Ajouter un joueur <span>➤</span></p>
    </a>
</div>
<script>
    function openMenu() {
        let player = document.getElementById('menuPlayer');
        player.style.display = "flex";
    }
</script>
@endsection