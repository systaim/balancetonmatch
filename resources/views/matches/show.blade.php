@extends('layout')
@section('content')

@livewire('form-commentaires', ['match' =>$match, 'clubHome' => $clubHome, 'clubAway' => $clubAway, 'commentsMatch' => $commentsMatch, 'competitions' => $competitions, 'stats' => $stats])

@endsection