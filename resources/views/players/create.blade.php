@extends('layout')
@section('content')
<section>
    @include('clubs.linkPageClub')
    @include('clubs.logo')
    <div class="bg-primary relative text-white my-2 p-3 m-auto w-full sm:w-11/12 md:w-9/12 lg:w-6/12">
        <form action="{{ route('clubs.players.store', $club) }}" enctype="multipart/form-data" method="post" onsubmit="document.querySelector('[type=Submit]').disabled=1">
            @foreach ($errors->all() as $message)
            {{ $message}}
            @endforeach
            @csrf
            <h5 class="text-secondary text-center mb-6">Ajouter un joueur</h5>
            <div class="m-8">
                <div class="w-10/12 m-auto my-2">
                    <label for="last_name">Nom de famille</label>
                    <input class="inputForm focus:outline-none focus:shadow-outline w-full my-1" type="text" name="last_name" id="last_name" placeholder="DUPONT" :value="old('last_name')">
                </div>
                <div class="w-10/12 m-auto my-2">
                    <label for="first_name">Prénom</label>
                    <input class="inputForm focus:outline-none focus:shadow-outline w-full my-1" type="text" name="first_name" placeholder="Jean" id="first_name" :value="old('first_name')">
                </div>
                <div class="w-10/12 m-auto my-2">
                    <label for="date_of_birth">Date de naissance</label>
                    <input class="inputForm focus:outline-none focus:shadow-outline w-full my-1" type="date" name="date_of_birth" id="date_of_birth" :value="old('date_of_birth')">
                </div>
                <div class="w-10/12 m-auto my-2">
                    <p>Position</p>
                    <div>
                        <select class="inputForm focus:outline-none focus:shadow-outline w-full my-1" name="position" id="position" :value="old('position')">
                            <option>Choisissez une position</option>
                            <option value="Gardien de but">Gardien de but</option>
                            <option value="Défenseur">Défenseur</option>
                            <option value="Milieu">Milieu</option>
                            <option value="Attaquant">Attaquant</option>
                        </select>
                    </div>
                </div>
                <div class="flex flex-col w-10/12 m-auto my-2">
                    <label for="file">Ajoute une photo</label>
                    <input type="file" name="file" id="file" accept="jpeg,png,jpg,gif">
                    @error('file')
                    <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="flex justify-end w-10/12 m-auto my-2">
                <input class="btn btnSuccess" type="submit" value="J'enregistre le joueur">
            </div>
        </form>
    </div>
</section>


@endsection