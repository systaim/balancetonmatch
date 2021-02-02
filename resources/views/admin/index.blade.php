@extends('layout')
@section('content')
<div class="relative w-full py-10 px-4 bg-primary text-white flex justify-center items-center my-6">
    <h2 class="text-4xl lg:text-6xl">Administration</h2>
</div>
<table class="table-auto border m-auto">
    <thead>
        <tr class="border-collapse">
            <th class="p-5 border">Nom prénom</th>
            <th class="p-5 border">team</th>
            <th class="p-5 border">Role</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr class="border-collapse hover:bg-orange-300">
            <td class="p-3 border">{{ $user->last_name }} {{ $user->first_name }}</td>
            <td class="p-3 border">{{ $user->club ? $user->club->name : ""}}</td>
            <td class="p-3 border"><select name="role" id="role">
                    <option value="">Quel role ?</option>
                    <option value="super-admin">super-admin</option>
                    <option value="admin">admin</option>
                    <option value="guest">guest</option>
                </select></td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $users->links() }}



@endsection