@extends('layout')
@section('content')

    @foreach ($competitions as $competition)

        <p>{{ $competition->name }}</p>

    @endforeach

    @foreach ($R1->divisions as $r1)
        <p>{{ $r1->name }}</p>
    @endforeach



@endsection
