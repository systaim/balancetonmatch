@extends('layout')
@section('content')
<section>
    <div class="flex flex-col justify-center items-center mb-4">
        <div class="logo h-16 w-16 m-4">
            <img class="object-contain" src="https://android-apiapp.azureedge.net/common/bib_img/logo/{{$club->numAffiliation}}.jpg" alt="logo">
        </div>
        <div class="bg-primary text-secondary">
            <h2 class="mx-2 text-xl">{{ $club->name }}</h2>
        </div>
    </div>
    <div class="bg-primary rounded-lg text-white relative my-2 p-3">
        <form action="{{ route('clubs.staffs.store', $club) }}" method="post">
            @foreach ($errors->all() as $message)
            {{ $message}}
            @endforeach
            @csrf
            <h5 class="text-secondary text-center">Ajouter un membre du staff</h5>
            <div class="m-5">
                <div>
                    <label for="name">Nom de famille</label>
                    <input class="inputForm focus:outline-none focus:shadow-outline w-full my-1" type="text" name="name" id="name" placeholder="DUPONT">
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