@extends('layout')

@section('content')
<h2>{{ $player->first_name }} {{ $player->name }}</h2>

<p>{{ $player->date_of_birth }}</p>
<p>{{ $player->position }}</p>

@endsection