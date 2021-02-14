@extends('layout')
@section('content')

<div class="relative w-full py-10 px-4 bg-primary text-white flex flex-col lg:flex-col-reverse justify-center items-center mb-6">
    <h2 class="text-4xl lg:text-6xl">{{ $region->name }}</h2>
    <div class="flex flex-wrap justify-center">
        @foreach($region->districts as $district)
        <h3 class="text-xs mr-2">{{ $district->name }}</h3>
        @endforeach
    </div>
</div>
<div class="flex flex-col lg:flex-row justify-between bg-primary rounded-lg my-4 sm:w-11/12 m-auto overflow-hidden">
    <div class="h-48 lg:h-auto lg:w-6/12"></div>
    <div class="text-white p-4 lg:w-6/12 xl:p-10 m-auto text-center">
        <h3 class="text-xs">Envie de suivre un match ?</h3>
        <h2 class="text-2xl">C'est très facile !</h2>
        <p class="py-4">Recherche ton équipe et si tu ne trouves pas son match, n'hésite pas à le créer.<br>
            Il pourra être commenté en <span class="uppercase text-primary font-bold bg-secondary px-2 rounded-sm">live</span> le jour J soit par toi soit par un autre spectateur.
        </p>
        <a class="flex justify-center" href="{{ route('matches.create') }}">
            <button class="btn btnSecondary">Je crée un match</button>
        </a>
    </div>
</div>
<div class="relative lg:flex lg:justify-center">
    <div class="w-11/12 sm:w-9/12 lg:w-5/12 h-auto mb-2 rounded-md mx-auto p-4">
        @foreach($matchesByRegion->sortByDesc('date_match') as $match)
        <div class="rounded-b-md rounded-tr-md">
            @include('match')
        </div>
        @endforeach
        {{ $matchesByRegion->links() }}

    </div>
</div>


@endsection