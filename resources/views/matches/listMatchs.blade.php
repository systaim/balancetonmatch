@extends('layout')
@section('content')
<h2 class="titlePage">Liste des matchs</h2>

<div class="flex justify-center">
    <a href="{{ route('matches.create') }}">
        <button class="btn btnPrimary">Créer un match</button>
    </a>
</div>
<div class="my-4">
    @foreach($matches as $match)
    <div class="text-center flex justify-center font-bold">
        <p class="px-4 bg-primary text-secondary rounded-tl-md">{{ $match->date_match->formatLocalized('%d/%m/%y')}}</p>
        <p class="px-4 bg-primary text-secondary rounded-tr-md">{{ $match->date_match->formatLocalized('%H:%M')}}</p>
    </div>
    <a href="{{route('matches.show',$match)}}">
        @include('match')
    </a>
    @livewire('favori-match', ['user' =>$user, 'match'=>$match])
    @endforeach
</div>
@endsection