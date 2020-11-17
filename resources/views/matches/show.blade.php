@extends('layout')
@section('content')

@livewire('form-commentaires', [
    'commentators'=> $commentators, 
    'nbrFavoris'=> $nbrFavoris, 
    'match' =>$match, 
    'clubHome' => $clubHome, 
    'clubAway' => $clubAway, 
    'commentsMatch' => $commentsMatch, 
    'competitions' => $competitions, 
    'stats' => $stats,
    'users' => $users
    ])

@endsection