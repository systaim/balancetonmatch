@extends('layout')
@section('content')
<h2 class="titlePage">Liste des matchs</h2>

<div class="flex justify-center">
    <a href="{{ route('matches.create') }}">
        <button class="btn btnPrimary">Créer un match</button>
    </a>
</div>
<div class="my-4 mx-2 relative lg:flex lg:justify-center">
    <div class="lg:w-9/12">
        @foreach($matches as $match)
            @include('match')
        @endforeach
    </div>
</div>
@endsection