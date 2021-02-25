@extends('layout')
@section('content')
<!-- <div class="flex justify-center">
    <a href="{{ route('matches.create') }}">
        <button class="btn btnPrimary">Créer un match</button>
    </a>
</div> -->
<section>
    <div class="flex flex-col lg:flex-row justify-between bg-primary rounded-lg my-4 sm:w-11/12 m-auto overflow-hidden">
        <div class="h-48 lg:h-auto lg:w-6/12 img-bg-blend-listMatchs">
        </div>
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
    <div class="flex justify-center">
        <h2 class="titlePage">Prochains matchs</h2>
    </div>
    <div class="relative lg:flex lg:justify-center">
        <div class="lg:w-9/12">

            @livewire('search-match')
            
            @foreach($competitions as $competition)
            <h2 class="text-primary border-b-2 border-primary px-4 py-2 rounded-t-md lg:text-2xl">{{ $competition->name }}</h2>
            @foreach($matchesByCompet[$competition->id] as $match)
            <div class="rounded-b-md rounded-tr-md">
                @include('match')
            </div>
            @endforeach
            @endforeach
        </div>
    </div>
</section>
@endsection