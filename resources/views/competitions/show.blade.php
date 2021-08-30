@extends('layout')
@section('content')

    
@foreach ($journees as $journee)
    <div>
        <p class="text-xl m-5">Journée {{ $journee->name }} </p>
    </div>
        
        @foreach ($matchs[$journee->id] as $match)
            @include('match')
        @endforeach
    @endforeach

@endsection
