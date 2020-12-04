@extends('layout')
@section('content')
<section>
    @include('clubs.linkPageClub')
    @include('clubs.logo')
    <div class="bg-primary rounded-lg text-white relative my-2 p-3">
        <form action="{{ route('clubs.staffs.store', $club) }}" method="post">
            @foreach ($errors->all() as $message)
            {{ $message}}
            @endforeach
            @csrf
            <h5 class="text-secondary text-center">Ajouter un membre du staff</h5>
            <div class="m-5">
                <div>
                    <label for="last_name">Nom de famille</label>
                    <input class="inputForm focus:outline-none focus:shadow-outline w-full my-1" type="text" name="last_name" id="last_name" placeholder="DUPONT">
                </div>
                <div>
                    <label for="first_name">Prénom</label>
                    <input class="inputForm focus:outline-none focus:shadow-outline w-full my-1" type="text" name="first_name" placeholder="Jean" id="first_name">
                </div>
                <div>
                    <label for="quality">Qualité</label>
                    <select class="inputForm focus:outline-none focus:shadow-outline w-full my-1" name="quality" id="quality">
                        <option>Choisissez une focntion</option>
                        <option value="Coach">Coach</option>
                        <option value="Coach-adjoint">Coach-adjoint</option>
                        <option value="Président">Président</option>
                        <option value="Secrétaire">Secrétaire</option>
                        <option value="Trésorier">Trésorier</option>
                    </select>
                </div>
                @auth
                <input class="btn btnPrimary" type="submit" value="J'enregistre le membre">
        </form>
        @else
        <p>Tu dois être connecté pour pouvoir créer un joueur ou un membre du staff</p>
    </div>
    @endauth
</section>
@endsection