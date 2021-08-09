@extends('layout')
@section('content')
    <div class="relative w-full py-10 px-4 bg-primary text-white flex justify-center items-center mb-6">
        <h2 class="text-4xl lg:text-6xl">Administration</h2>
    </div>
    <div class="flex flex-col md:flex-row justify-center items-center">
        <div class="m-3">
            <a class="btn btnSuccess" href="/admin/users">Liste des utilisateurs</a>
        </div>
        <div class="m-3">
            <a class="btn btnSuccess" href="/admin/addClub">Ajouter un club</a>
        </div>
    </div>
    
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        @livewire('api.api-token-manager')
    </div>
    <p class="m-4">Jeton systaimAdmin : qexgLizuIRSyCUKLAIorg36xYvswAw9q8c1rXA2X</p>





@endsection
