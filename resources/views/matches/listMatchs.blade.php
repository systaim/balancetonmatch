@extends('layout')
@section('content')
<h2 class="titlePage">Liste des matchs</h2>

<div class="flex justify-center">
    <a href="{{ route('matches.create') }}">
        <button class="btn btnPrimary">Créer un match</button>
    </a>
</div>
<div class="my-4 relative">
    @foreach($matches as $match)
    @livewire('favori-match', ['user' => $user, 'match' => $match])
    @include('match')
    @endforeach
</div>
@endsection