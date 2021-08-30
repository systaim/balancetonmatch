@extends('layout')
@section('content')

    @foreach ($competitions as $competition)

        <p>{{ $competition->name }}</p>

    @endforeach

    @foreach ($matchsR1 as $match)
        @include('match')
    @endforeach



@endsection
