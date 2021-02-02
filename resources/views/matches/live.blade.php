@extends('layout')
@section('content')

<div class="relative w-full py-10 px-4 bg-primary text-white flex justify-center items-center my-6">
    <i class="text-4xl lg:text-4xl fas fa-microphone-alt"></i>
    <h2 class=" ml-4 text-4xl lg:text-6xl bg-secondary text-primary py-1 px-3 rounded-md">LIVE</h2>
</div>
<div class="relative lg:flex lg:justify-center">
    <div class="w-11/12 m-auto lg:w-9/12">
        @if(empty($$liveMatches))
        <div class="flex flex-col items-center text-center">
            <p class="text-xl my-4">OUPS... Pas de match en LIVE commenté en ce moment</p>
            <p>Reviens bientôt ou profites en pour en commenter un</p>
        </div>
        @else
        @foreach($competitions as $competition)
        {{ $competition->name }}
        @foreach($liveMatches[$competition->id]->sortBy('date_match') as $match)
        @include('match')
        @endforeach
        @endforeach
        @endif
    </div>
</div>

@endsection