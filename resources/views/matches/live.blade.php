@extends('layout')
@section('content')

<div class="relative w-full py-1 bg-white flex justify-center items-center mb-6">
    <img alt="favoris" src="{{ asset('images/micro.png') }}" class="h-36">
    <h2 class="-ml-20 text-6xl lg:text-6xl text-primary py-1 px-3 rounded-md">LIVE</h2>
</div>
<div class="relative lg:flex lg:justify-center h-screen">
    <div class="w-11/12 m-auto lg:w-9/12">
        @if(count($liveMatches) == 0)
        <div class="flex flex-col items-center text-center">
            <p class="text-xl my-4">OUPS... Pas de match en LIVE commenté en ce moment</p>
            <p>Reviens bientôt ou profites en pour en commenter un</p>
        </div>
        @else
        @foreach($liveMatches->sortBy('date_match') as $match)
        @include('match')
        @endforeach
        @endif
    </div>
</div>

@endsection