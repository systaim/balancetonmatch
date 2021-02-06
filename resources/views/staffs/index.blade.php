@extends('layout')
@section('content')
<section>
    @include('clubs.linkPageClub')
    @include('clubs.logo')
    <div class="flex justify-center">
        @error('last_name')
        <span class="error">{{ $message }}</span>
        @enderror
        @error('first_name')
        <span class="error">{{ $message }}</span>
        @enderror
    </div>
    <div class="my-8 m-auto w-11/12 xl:w-8/12">
        <div class="flex justify-center">
            <h3 class="titlePage">Le staff</h3>
        </div>
        <div class="flex flex-row flex-wrap justify-center">
            @foreach($club->staffs->sortBy('last_name') as $key => $staff)
            <div x-data="{ open: false }" class="relative w-72 m-4 bg-primary text-white flex flex-col justify-between rounded-lg shadow-2xl overflow-x-hidden">
                <div class="absolute top-2 left-2 logo h-12 w-12 z-10">
                    <img class="object-contain" src="https://android-apiapp.azureedge.net/common/bib_img/logo/{{$club->numAffiliation}}.jpg" alt="logo">
                </div>
                <div class="flex justify-between">
                    <div class="relative">
                        <img class="object-cover h-80 w-full rounded-br-lg" src="{{ asset($staff->avatar_path)}}" alt="photo de {{ $staff->first_name }} {{ $staff->last_name }}">
                        <p class="absolute bottom-1 right-1 bg-primary text-secondary font-bold py-1 px-2 rounded-lg">{{ $staff->quality }}</p>
                    </div>
                    <div class="text-lg flex justify-center items-start p-2">
                        <p class="capitalize vertical mx-2 font-semibold">{{ $staff->first_name}} <span class="uppercase">{{ $staff -> last_name}}</span></p>
                    </div>
                </div>
                <div class="relative flex justify-between items-end p-2 h-12">
                    <div class="flex flex-col">
                        <p class="font-bold">né le {{ date('d/m/Y',strtotime($staff->date_of_birth)) }}</p>
                    </div>
                    @can('update-club', $club)
                    <div>
                        <button onclick="openMenu({{$staff->id}})" class="mr-1"><i class="far fa-edit"></i></button>
                        <button id="{{ $key }}" @click="open = true"><i class="far fa-times-circle"></i></button>
                    </div>
                    @endcan
                </div>
                <!-- ***********************
                    Formulaire suppression d'un dirigeant
                    ************************** -->
                <div id="" class="absolute bg-white top-0 left-0 right-0 bottom-0 text-primary z-20 flex flex-col justify-between items-center " x-show="open" @click.away="open = false">
                    <div class="mt-3">
                        <h3 class="text-xl text-center my-2 text-darkGray">{{ $staff->first_name}} <span class="uppercase">{{ $staff -> last_name}}</span></h3>
                        <div class="mt-12">
                            <p class="text-lg text-center leading-5 text-gray-800">
                                Etes vous sûr de vouloir supprimer ce dirigeant ?
                            </p>
                        </div>
                    </div>
                    <div class="flex justify-center items-center">
                        <form action="{{ route('clubs.staffs.destroy', [$club, $staff]) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="button" @click="open = false" class="btn">Annuler</button>
                            <input class="btn btnDanger" type="submit" value="Confirmer">
                        </form>
                    </div>
                </div>

                <!-- ***********************
                    Formulaire modification d'un dirigeant
                    ************************** -->

                <div id="{{$staff->id}}" class="hidden fixed z-50 inset-0 justify-center items-center" style="background-color: rgba(0,0,0,.5);">
                    <div class="absolute top-10 right-10">
                        <a href=""><button class="text-4xl text-primary">X</button></a>
                    </div>
                    <div class="p-10 bg-white w-full sm:w-11/12 md:w-9/12 lg:w-6/12 rounded-lg shadow-xl">
                        <form action="{{ route('clubs.staffs.update', [$club, $staff]) }}" method="post" enctype="multipart/form-data">
                            @foreach ($errors->all() as $message)
                            {{ $message}}
                            @endforeach
                            @method('PUT')
                            @csrf
                            <h5 class="text-primary text-center">Modifier le dirigeant</h5>
                            <div class="text-primary">
                                <div>
                                    <label class="flex flex-col" for="last_name">Nom de famille</label>
                                    <input class="inputForm focus:outline-none focus:shadow-outline w-full my-1" type="text" name="last_name" id="last_name" value="{{ $staff -> last_name}}">
                                    @error('last_name')
                                    <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div>
                                    <label class="flex flex-col" for="first_name">Prénom</label>
                                    <input class="inputForm focus:outline-none focus:shadow-outline w-full my-1" type="text" name="first_name" value="{{ $staff -> first_name}}" id="first_name">
                                    @error('first_name')
                                    <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="flex flex-col">
                                    <label for="date_of_birth">Date de naissance</label>
                                    <input class="inputForm focus:outline-none focus:shadow-outline w-full my-1" type="date" name="date_of_birth" id="date_of_birth" value="{{ $staff -> date_of_birth}}">
                                </div>
                                <div>
                                    <p>Qualité</p>
                                    <div class="flex flex-col">
                                        <select class="inputForm focus:outline-none focus:shadow-outline w-full my-1" name="quality" id="quality" value="{{ $staff->quality }}">
                                            <option value="{{ $staff->quality }}">{{ $staff->quality }}</option>
                                            <option value="president">Président</option>
                                            <option value="vice-president">Vice-président</option>
                                            <option value="tresorier">Trésorier</option>
                                            <option value="tresorier-adj">Trésorier-adjoint</option>
                                            <option value="secretaire">Secrétaire</option>
                                            <option value="secretaire-adj">Secrétaire-adjoint</option>
                                            <option value="coach">Coach</option>
                                            <option value="coach-adj">Coach-adjoint</option>
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
                                <input class="btn btnSuccess" type="submit" value="Je modifie le dirigeant">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="relative w-72 m-4 bg-success text-darkGray flex flex-col justify-between rounded-lg overflow-hidden shadow-2xl">
                <a href="{{ route('clubs.staffs.create', $club) }}">
                    <div class="flex justify-between">
                        <div class="flex justify-center items-center h-80 w-full bg-gray-400 rounded-br-lg">
                            <p class="giant-text text-gray-500">+</p>
                        </div>
                        <div class="text-lg flex justify-center items-start p-2">
                            <p class="vertical mx-2 font-semibold">Ajouter un dirigeant</p>
                        </div>
                    </div>
                    <div class="relative flex p-2">
                        <p class="font-semibold">Ajouter un dirigeant</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>
@endsection

<script>
    function openMenu(id) {
        let staffs = <?php echo json_encode($club->staffs); ?>;
        staffs.forEach(player => {
            if (player.id == id) {
                let form = document.getElementById(id)
                form.style.display = "flex"
            }
        });
    }
</script>