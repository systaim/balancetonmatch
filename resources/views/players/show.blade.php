@extends('layout')

@section('content')
    <div>
        <div>
            <img class="h-32 w-full object-cover lg:h-48"
                src="https://images.unsplash.com/photo-1568194157720-8bbe7114ebe8?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=2232&q=80"
                alt="">
        </div>
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="-mt-12 sm:-mt-16 sm:flex sm:items-end sm:space-x-5">
                <div class="flex overflow-hidden rounded-full p-3 bg-white">
                    <img class="object-contain" src="{{ asset($club->logo) }}" alt="Logo de {{ $club->name }}">
                </div>
                <div class="mt-6 sm:flex-1 sm:min-w-0 sm:flex sm:items-center sm:justify-end sm:space-x-6 sm:pb-1">
                    <div class="sm:hidden md:block mt-6 min-w-0 flex-1">
                        <h1 class="text-2xl font-bold text-gray-900 truncate">
                            {{ $player->first_name }} {{ $player->last_name }}
                        </h1>
                    </div>
                    @auth
                        @if (Auth::user()->club_id == $club->id || Auth::user()->role == 'super-admin')
                            <div class="mt-6 flex flex-col justify-stretch space-y-3 sm:flex-row sm:space-y-0 sm:space-x-4">
                                <button type="button" onclick="openMenu()"
                                    class="inline-flex justify-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-green-700 bg-green-50 hover:bg-green-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5 text-green-700"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                    <span>Modifier</span>
                                </button>
                                <button type="button"
                                    class="inline-flex justify-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-red-700 bg-red-50 hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5 text-red-700"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>Supprimer</span>
                                </button>
                            </div>
                        @endif
                    @endauth
                </div>
            </div>
            <div class="hidden sm:block md:hidden mt-6 min-w-0 flex-1">
                <h1 class="text-2xl font-bold text-gray-900 truncate">
                    {{-- Ricardo Cooper --}}
                </h1>
            </div>
        </div>
    </div>
    <div class="flex md:justify-center flex-col md:flex-row items-center">
        <div x-data="{ open: false }"
            class="relative w-72 m-4 bg-primary text-white flex flex-col justify-between rounded-lg shadow-2xl overflow-x-hidden">
            <div class="absolute top-2 left-2 logo h-12 w-12 z-10">
                {{-- <img class="object-contain" src="{{ asset($club->logo) }}" alt="Logo de {{ $club->name }}"> --}}
            </div>
            <div>
                <div class="relative">
                    <div class="absolute top-3 right-2 bg-primary py-1 rounded-lg">
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
                                <input class="inputForm focus:outline-none focus:shadow-outline w-full my-1"
                                    type="text" name="first_name" value="{{ $player->first_name }}" id="first_name">
                                @error('first_name')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- <div class="flex flex-col">
                                <label for="date_of_birth">Date de naissance</label>
                                <input class="inputForm focus:outline-none focus:shadow-outline w-full my-1" type="date"
                                    name="date_of_birth" id="date_of_birth" value="{{ $player->date_of_birth }}">
                            </div> --}}
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
                            <div class="mt-4">
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
        <div class="relative">
            {{-- <img src="{{ asset('images/goalByPlayer.png') }}" alt="" class="absolute -left-8 -top-12"> --}}

            <div class=" bg-white p-2 shadow rounded-lg overflow-hidden pl-36 pr-8 py-10 my-8 md:ml-12 z-10">
                <p class="">Total de buts </p>
                <p class="text-right text-2xl font-bold"> {{ $goals }}</p>

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
