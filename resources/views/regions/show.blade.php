@extends('layout')
@section('content')

    <div class="relative bg-gray-800">
        <div class="absolute inset-0">
            @if ($region->background)
                <img class="w-full h-full object-cover" src="{{ $region->background }}" alt="">
            @endif
            <div class="absolute inset-0 bg-gray-800 mix-blend-multiply" aria-hidden="true"></div>
        </div>
        <div class="relative max-w-7xl mx-auto py-24 px-4 sm:py-32 sm:px-6 lg:px-8 text-white">
            <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-6xl">{{ $region->name }}</h1>
            <div>
                @foreach ($region->departements as $departement)
                    <span class="text-xs mr-2 uppercase">{{ $departement->name }} </span>
                @endforeach
            </div>
        </div>
    </div>
    <div class="relative lg:flex lg:justify-center">
        <div class="w-11/12 sm:w-9/12 lg:w-8/12 h-auto mb-2 rounded-md mx-auto p-4">
            {{-- @if (count($matchesByRegion) != 0)
        @foreach ($matchesByRegion->sortByDesc('date_match') as $match)
        <div class="rounded-b-md rounded-tr-md">
        {{ $match->competition->name }}
            @include('match')
        </div>
        @endforeach
        {{ $matchesByRegion->links() }}
        @else
        <h2 class="text-center text-3xl">Pas de matchs prévus pour l'instant</h2>
        @endif --}}
        </div>
    </div>


@endsection
