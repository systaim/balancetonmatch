@extends('layout')
@section('content')
<div class="relative w-full py-10 px-4 bg-primary text-white flex justify-center items-center mb-6">
    <h2 class="text-4xl lg:text-6xl">Administration</h2>
</div>
<div class="flex justify-center">
    <div class="m-6">
        <a class="flex justify-center items-center bg-primary text-white h-48 w-48 rounded-md hover:shadow-2xl" href="/admin/users">Liste des utilisateurs</a>
    </div>
    <div class="m-6">
        <a class="flex justify-center items-center bg-primary text-white h-48 w-48 rounded-md hover:shadow-2xl" href="/admin/addClub">Ajouter un club</a>
    </div>
</div>





@endsection