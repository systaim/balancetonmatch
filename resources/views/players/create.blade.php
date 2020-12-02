@extends('layout')
@section('content')
<div class="flex flex-col justify-center items-center mb-4">
    <div class="logo h-16 w-16 m-4">
        <img class="object-contain" src="https://android-apiapp.azureedge.net/common/bib_img/logo/{{$club->numAffiliation}}.jpg" alt="logo">
    </div>
    <div class="bg-primary text-secondary">
        <h2 class="mx-2 text-xl">{{ $club->name }}</h2>
    </div>
</div>
<div>
    <div class="bg-primary rounded-lg relative text-white my-2 p-3">
        <form action="{{ route('clubs.players.store', $club) }}" method="post">
            @foreach ($errors->all() as $message)
            {{ $message}}
            @endforeach
            @csrf
            <h5 class="text-secondary text-center">Ajouter un joueur</h5>
            <div>
                <div>
                    <label class="flex flex-col" for="last_name">Nom de famille</label>
                    <input class="inputForm focus:outline-none focus:shadow-outline w-full my-1" type="text" name="last_name" id="last_name" placeholder="DUPONT">
                </div>
                <div>
                    <label class="flex flex-col" for="first_name">Prénom</label>
                    <input class="inputForm focus:outline-none focus:shadow-outline w-full my-1" type="text" name="first_name" placeholder="Jean" id="first_name">
                </div>
                <div class="flex flex-col">
                    <label for="date_of_birth">Date de naissance</label>
                    <input class="inputForm focus:outline-none focus:shadow-outline w-full my-1" type="date" name="date_of_birth" id="date_of_birth">
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

@endsection