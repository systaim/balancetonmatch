@extends('layout')
@section('content')
<div class="relative w-full py-10 px-4 bg-primary text-white flex justify-center items-center mb-6">
    <h2 class="text-4xl lg:text-6xl">Ajouter un club</h2>
</div>
<form class="text-primary flex flex-col w-11/12 lg:w-6/12 m-auto" action="{{ route('clubs.store') }}" method="post">
    @csrf
    <div class="flex flex-col mt-4">
        <label for="name">Nom du club</label>
        <input class="inputForm" type="text" name="name" id="name" required>
    </div>
    <div class="flex flex-col mt-4">
        <label for="numAffiliation">Numéro d'affiliation</label>
        <input class="inputForm" type="text" name="numAffiliation" id="numAffiliation" maxlength="6" required>
    </div>
    <div class="flex flex-col mt-4">
        <label for="primary_color">Couleur 1</label>
        <input class="inputForm" type="text" name="primary_color" id="primary_color">
    </div>
    <div class="flex flex-col mt-4">
        <label for="secondary_color">Couleur 2</label>
        <input class="inputForm" type="text" name="secondary_color" id="secondary_color">
    </div>
    <div class="flex flex-col mt-4">
        <label for="zip_code">Code postal</label>
        <input class="inputForm" type="number" name="zip_code" id="zip_code" maxlength="5" required>
    </div>
    <div class="flex flex-col mt-4">
        <label for="city">Ville</label>
        <input class="inputForm" type="text" name="city" id="city" required>
    </div>
    <div class="flex flex-col mt-4">
        <label for="region_id">Région</label>
        <select class="inputForm" name="region_id" id="region_id">
        <option value="">Une région à choisir</option>
        @foreach($regions as $region)
        <option value="{{ $region->name }}">{{ $region->name }}</option>
        @endforeach
        </select>
    </div>
    @foreach ($errors->all() as $message)
    {{ $message}}
    @endforeach

    <input class="btn btnPrimary" type="submit" value="Créer le club">
</form>
@endsection