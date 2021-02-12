@extends('layout')
@section('content')
<div class="relative w-full py-10 px-4 bg-primary text-white flex justify-center items-center mb-24">
    <h2 class="text-4xl lg:text-6xl">{{ $user->first_name }} {{ $user->last_name }}</h2>
</div>
<div class="relative h-96 w-96 bg-primary shadow-xl mx-auto py-20 px-4 text-white">
    <figure class="absolute -top-16 left-32">
        <img class="rounded-full h-32 w-32 object-cover border-2 border-white" src="{{ $user->profile_photo_url }}" alt="image de profil">
    </figure>
    <h3>{{ $user->role }}</h3>
</div>
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