@extends('layout')
@section('content')
<section>
    @include('clubs.linkPageClub')
    @include('clubs.logo')
    <div class="my-8 relative overflow-hidden">

        <h3 class="titlePage">Les joueurs</h3>
        @foreach($players as $player)
        <div class="pt-20 mx-auto bg-primary text-white rounded-lg relative mt-20 flex flex-col items-center text-center p-3 w-11/12 sm:w-10/12 sm:mx-auto md:w-8/12 lg:w-7/12 xl:w-6/12">
            <!-- @livewire('update-player', ['player' => $player]) -->
            <div class="absolute top--4 w-32 h-32 items-center logo" wire:click="clickPhoto">
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
                        <button onclick="openMenu({{$player->id}})"><i class="far fa-edit"></i></button>
                    </div>
                </div>
            </div>
            <div id="{{$player->id}}" class="updatePlayer fixed z-50 bg-gray-200 inset-0 justify-center items-center">
                <div class=" absolute top-10 right-10">
                    <p class="text-4xl text-primary">X</p>
                </div>
                <div class="p-10 bg-white w-full sm:w-11/12 md:w-9/12 lg:w-6/12 rounded-lg shadow-xl">
                    <form action="{{ route('clubs.players.update', [$club, $player]) }}" method="post">
                        @foreach ($errors->all() as $message)
                        {{ $message}}
                        @endforeach
                        @method('PUT')
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
                        <div class="mt-6 flex flex-col items-center justify-center sm:flex-row">
                            <a href="">
                                <button type="button" class="btn text-primary">J'annule</button>
                            </a>
                            <input class="btn btnSuccess" type="submit" value="Je modifie le joueur">
                        </div>
                    </form>
                    <div class="flex justify-end mt-12">
                        <form action="{{ route('clubs.players.destroy', [$club, $player]) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <input class="btn btnDanger" type="submit" value="Supprimer ce joueur">
                        </form>
                    </div>

                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="flex justify-end">
        <a href="{{ route('clubs.players.create', $club) }}">
            <button class="btn btnPrimary">J'ajoute un joueur <span>➤</span></button>
        </a>
    </div>
</section>

<script>
    function openMenu(id) {
        let players = <?php echo json_encode($club->players); ?>;
        players.forEach(player => {
            if (player.id == id) {
                let form = document.getElementById(id)
                form.style.display = "flex"
            }
        });
    }
</script>
@endsection