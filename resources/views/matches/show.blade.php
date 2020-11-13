@extends('layout')
@section('content')

@livewire('form-commentaires', ['nbrFavoris'=> $nbrFavoris, 'match' =>$match, 'clubHome' => $clubHome, 'clubAway' => $clubAway, 'commentsMatch' => $commentsMatch, 'competitions' => $competitions, 'stats' => $stats])

@endsection