@extends('layout')
@section('content')
<section>
    @include('clubs.linkPageClub')
    @include('clubs.logo')
    <div class="bg-primary rounded-lg relative text-white my-2 p-3 m-auto w-full sm:w-11/12 md:w-9/12 lg:w-6/12">
        <form action="{{ route('clubs.staffs.store', $club) }}" method="post" enctype="multipart/form-data">
            @foreach ($errors->all() as $message)
            {{ $message}}
            @endforeach
            @csrf
            <h5 class="text-secondary text-center mb-6">Ajouter un dirigeant</h5>
            <div class="m-8">
                <div class="w-10/12 m-auto my-2">
                    <label for="last_name">Nom de famille</label>
                    <input class="inputForm focus:outline-none focus:shadow-outline w-full my-1" type="text" name="last_name" id="last_name" placeholder="DUPONT">
                </div>
                <div class="w-10/12 m-auto my-2">
                    <label for="first_name">Prénom</label>
                    <input class="inputForm focus:outline-none focus:shadow-outline w-full my-1" type="text" name="first_name" placeholder="Jean" id="first_name">
                </div>
                <div class="w-10/12 m-auto my-2">
                    <label for="quality">Qualité</label>
                    <select class="inputForm focus:outline-none focus:shadow-outline w-full my-1" name="quality" id="quality">
                        <option>Quelle fonction ?</option>
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
                <div class="flex flex-col w-10/12 m-auto my-2">
                    <label for="file">Ajoute une photo</label>
                    <input type="file" name="file" id="file" accept="jpeg,png,jpg,gif,svg">
                    @error('file')
                    <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex justify-end w-10/12 m-auto my-2">
                    <input class="btn btnSuccess" type="submit" value="J'enregistre la personne">
                </div>
            </div>
        </form>
</section>
@endsection