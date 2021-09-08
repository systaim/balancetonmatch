@extends('layout')
@section('content')

<div class="relative w-full py-10 px-4 bg-primary text-white flex flex-col lg:flex-col-reverse justify-center items-center mb-6">
    <h2 class="text-4xl lg:text-6xl">{{ $region->name }}</h2>
    <div class="flex flex-wrap justify-center">
        @foreach($region->departements as $departement)
        <h3 class="text-xs mr-2">{{ $departement->name }} </h3>
        @endforeach
    </div>
</div>
<div class="relative lg:flex lg:justify-center">
    <div class="w-11/12 sm:w-9/12 lg:w-8/12 h-auto mb-2 rounded-md mx-auto p-4">
        {{-- @if(count($matchesByRegion) != 0)
        @foreach($matchesByRegion->sortByDesc('date_match') as $match)
        <div class="rounded-b-md rounded-tr-md">
        {{ $match->competition->name }}
            @include('match')
        </div>
        @endforeach
        {{ $matchesByRegion->links() }}
        @else
        <h2 class="text-center text-3xl">Pas de matchs prévus pour l'instant</h2>
        @endif --}}
        @foreach ($region->divisionsRegions as $regionale)
            @dump($regionale)
        @endforeach
    </div>
</div>


@endsection