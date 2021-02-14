@extends('layout')
@section('content')
<div class="relative w-full py-10 px-4 bg-primary text-white flex justify-center items-center mb-24">
    <h2 class="text-4xl lg:text-6xl">{{ $user->first_name }} {{ $user->last_name }}</h2>
</div>
    
    @livewire('update-user', [
        'user' => $user,
    ])
    
<div>
    @foreach($user->commentator as $com)
    <div class="flex">
        <p>{{ $com->match->homeClub->name }}</p>
        <p>VS</p>
        <p>{{ $com->match->awayClub->name }}</p>
    </div>


    @endforeach
</div>

@endsection