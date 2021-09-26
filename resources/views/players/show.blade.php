@extends('layout')

@section('content')
    <div class="flex justify-center">
        <div x-data="{ open: false }"
            class="relative w-72 m-4 bg-primary text-white flex flex-col justify-between rounded-lg shadow-2xl overflow-x-hidden">
            <div class="absolute top-2 left-2 logo h-12 w-12 z-10">
                @if ($club->logo_path)
                    <img class="object-contain" src="{{ asset($club->logo_path) }}" alt="Logo de {{ $club->name }}">
                @else
                    <img class="object-contain"
                        src="https://android-apiapp.azureedge.net/common/bib_img/logo/{{ $club->numAffiliation }}.jpg"
                        alt="logo">
                @endif
            </div>
            <div>
                <div class="relative">
                    <div class="absolute top-3 right-2 bg-primary py-1 rounded-lg">
                        <p class="capitalize mx-2 font-semibold truncate">
                            {{ $player->first_name }} <span class="uppercase">{{ $player->last_name }}</span>
                        </p>
                    </div>
                    <img class="object-cover h-80 w-full rounded-b-lg" src="{{ asset($player->avatar_path) }}"
                        alt="photo de {{ $player->first_name }} {{ $player->last_name }}">
                    @switch($player->position)
                        @case('Gardien de but')
                            <p class="absolute bottom-1 right-1 bg-primary text-secondary font-bold py-1 px-2 rounded-lg">
                                GB</p>
                        @break
                        @case('Défenseur')
                            <p class="absolute bottom-1 right-1 bg-primary text-secondary font-bold py-1 px-2 rounded-lg">
                                DEF</p>
                        @break
                        @case('Milieu')
                            <p class="absolute bottom-1 right-1 bg-primary text-secondary font-bold py-1 px-2 rounded-lg">
                                MIL</p>
                        @break
                        @case('Attaquant')
                            <p class="absolute bottom-1 right-1 bg-primary text-secondary font-bold py-1 px-2 rounded-lg">
                                ATT</p>
                        @break
                    @endswitch
                </div>
            </div>
            <div class="relative flex justify-between items-end p-2 h-12">
                @if ($player->date_of_birth)
                    <div>
                        <p class="font-bold">né le {{ date('d/m/Y', strtotime($player->date_of_birth)) }}</p>
                    </div>
                @else
                    <p class="font-bold">né le : <span class="text-xs">non renseigné</span></p>

                @endif
                @if (Auth::user()->club_id == $club->id)
                    <div>
                        <button onclick="openMenu()" class="mr-1"><i class="far fa-edit"></i></button>
                        <button id="{{ $player->id }}" @click="open = true"><i class="far fa-times-circle"></i></button>
                    </div>
                @endif
            </div>
            <!-- ***********************
                                                            Formulaire suppression d'un joueur
                                                            ************************** -->
            <div id="{{ $player->id }}"
                class="absolute bg-white top-0 left-0 right-0 bottom-0 text-primary z-20 flex flex-col justify-between items-center "
                x-show="open" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform scale-90"
                x-transition:enter-end="opacity-100 transform scale-100"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100 transform scale-100"
                x-transition:leave-end="opacity-0 transform scale-90" @click.away="open = false">
                <div class="mt-3">
                    <h3 class="text-xl text-center my-2 text-darkGray">{{ $player->first_name }} <span
                            class="uppercase">{{ $player->last_name }}</span></h3>
                    <div class="mt-12">
                        <p class="text-lg text-center leading-5 text-gray-800">
                            Etes vous sûr de vouloir supprimer ce joueur ?
                        </p>
                    </div>
                </div>
                <div class="flex justify-center items-center">
                    <form action="{{ route('clubs.players.destroy', [$club, $player]) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="button" @click="open = false" class="btn">Annuler</button>
                        <input class="btn btnDanger" type="submit" value="Confirmer">
                    </form>
                </div>
            </div>

            <!-- ***********************
                                                            Formulaire modification d'un joueur
                                                            ************************** -->

            <div id="edition" class="hidden fixed z-50 inset-0 justify-center items-center"
                style="background-color: rgba(0,0,0,.5);">
                <div class="absolute top-10 right-10">
                    <a href=""><button class="text-4xl text-primary">X</button></a>
                </div>
                <div class="p-10 bg-white w-full sm:w-11/12 md:w-9/12 lg:w-6/12 rounded-lg shadow-xl">
                    <form action="{{ route('clubs.players.update', [$club, $player]) }}" method="post"
                        enctype="multipart/form-data">
                        @foreach ($errors->all() as $message)
                            {{ $message }}
                        @endforeach
                        @method('PUT')
                        @csrf
                        <h5 class="text-primary text-center">Modifier le joueur</h5>
                        <div class="text-primary">
                            <div>
                                <label class="flex flex-col" for="last_name">Nom de famille</label>
                                <input class="inputForm focus:outline-none focus:shadow-outline w-full my-1" type="text"
                                    name="last_name" id="last_name" value="{{ $player->last_name }}">
                                @error('last_name')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label class="flex flex-col" for="first_name">Prénom</label>
                                <input class="inputForm focus:outline-none focus:shadow-outline w-full my-1" type="text"
                                    name="first_name" value="{{ $player->first_name }}" id="first_name">
                                @error('first_name')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="flex flex-col">
                                <label for="date_of_birth">Date de naissance</label>
                                <input class="inputForm focus:outline-none focus:shadow-outline w-full my-1" type="date"
                                    name="date_of_birth" id="date_of_birth" value="{{ $player->date_of_birth }}">
                            </div>
                            <div>
                                <p>Position</p>
                                <div class="flex flex-col">
                                    <select class="inputForm focus:outline-none focus:shadow-outline w-full my-1"
                                        name="position" id="position" value="{{ $player->position }}">
                                        <option value="{{ $player->position }}">{{ $player->position }}
                                        </option>
                                        <option value="Gardien de but">Gardien de but</option>
                                        <option value="Défenseur">Défenseur</option>
                                        <option value="Milieu">Milieu</option>
                                        <option value="Attaquant">Attaquant</option>
                                    </select>
                                </div>
                            </div>
                            <div>
                                <label for="file">Ajoute une photo</label>
                                <input type="file" name="file" id="file" accept="jpeg,png,jpg,gif,svg">
                                @error('file')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="mt-6 flex flex-col items-center justify-center sm:flex-row">
                            <a href="">
                                <button type="button" class="btn text-primary">J'annule</button>
                            </a>
                            <input class="btn btnSuccess" type="submit" value="Je modifie le joueur">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
<script>
    function openMenu() {
        // let players = <?php echo json_encode($club->players); ?>;
        let player = document.getElementById('player')
        let form = document.getElementById('edition')
        form.style.display = "flex"
        // players.forEach(player => {
        //     if (player.id == id) {
        //         let form = document.getElementById(id)
        //         form.style.display = "flex"
        //     }
        // });
    }
</script>
