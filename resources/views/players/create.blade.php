@extends('layout')
@section('content')
<section>
    @include('clubs.linkPageClub')
    @include('clubs.logo')
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
</section>


@endsection