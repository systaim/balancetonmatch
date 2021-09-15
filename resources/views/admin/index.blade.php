@extends('layout')
@section('content')
    <div class="relative w-full py-10 px-4 bg-primary text-white flex justify-center items-center mb-6">
        <h2 class="text-4xl lg:text-6xl">Administration</h2>
    </div>
    <div class="flex flex-col md:flex-row justify-center items-center">
        {{-- <div class="m-3">
            <a class="btn btnSuccess" href="/admin/users">Liste des utilisateurs</a>
        </div> --}}
        <div class="m-3">
            <a class="btn btnSuccess" href="/admin/addClub">Ajouter un club</a>
        </div>
    </div>
    <div>
    <table class="table-auto border-2 border-primary m-auto">
        <thead>
            <tr class="border-collapse">
                <th class="p-5 border">Nom prénom</th>
                <th class="p-5 border">role</th>
                <th class="p-5 border">Club</th>
                <th class="p-5 border">profil</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr class="border-collapse hover:bg-blue-200 cursor-pointer" onclick="location.href=''">
                <td class="p-3 border">{{ $user->last_name }} {{ $user->first_name }}</td>
                <td class="p-3 border">{{ $user->role}}</td>
                <td class="p-3 border">{{ $user->club ? $user->club->name : "Pas de club"}}</td>
                <td><a class="text-center btn" href="">voir</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        @livewire('api.api-token-manager')
    </div>
    <p class="m-4">Jeton systaimAdmin : RMr02HExR2KxxlZAOXyIXyjCkc0NJhvZnx8gw2cD</p>





@endsection
