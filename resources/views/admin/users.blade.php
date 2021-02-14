@extends('layout')
@section('content')
<div class="relative w-full py-10 px-4 bg-primary text-white flex justify-center items-center mb-6">
    <h2 class="text-4xl lg:text-6xl">Gestion des utilisateurs</h2>
</div>
<div>
    <table class="table-auto border-2 border-primary m-auto">
        <thead>
            <tr class="border-collapse">
                <th class="p-5 border">Nom prénom</th>
                <th class="p-5 border">role</th>
                <th class="p-5 border">profil</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr class="border-collapse hover:bg-blue-200" onclick="location.href='{{ route('users.show', $user) }}'">
                <td class="p-3 border">{{ $user->last_name }} {{ $user->first_name }}</td>
                <td class="p-3 border">{{ $user->role}}</td>
                <td><a class="text-center btn" href="{{ route('users.show', $user) }}">voir</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $users->links() }}
</div>
@endsection