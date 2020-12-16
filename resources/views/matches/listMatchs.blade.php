@extends('layout')
@section('content')
<!-- <div class="flex justify-center">
    <a href="{{ route('matches.create') }}">
        <button class="btn btnPrimary">Créer un match</button>
    </a>
</div> -->
<div class="flex flex-col lg:flex-row justify-between bg-primary overflow-hidden rounded-lg my-4 sm:w-11/12 m-auto">
    <div class="h-48 lg:h-auto lg:w-6/12 img-bg-blend-listMatchs">
    </div>
    <div class="text-white p-4 lg:w-6/12 xl:p-10 m-auto">
        <h3 class="text-xs">Envie de de commenter ou de suivre un match ?</h3>
        <h2 class="text-2xl">C'est très facile !</h2>
        <p class="py-4">Si tu ne trouves pas ton match, n'hésite pas à le créer.<br>
            Le match pourra être commenté en <span class="uppercase text-primary font-bold bg-secondary px-2 rounded-full">live</span> le jour J.
        </p>
        <a class="flex justify-end" href="{{ route('matches.create') }}">
            <button class="btn btnSecondary">Je crée un match</button>
        </a>
    </div>
</div>
<div class="flex justify-center">
    <h2 class="titlePage">Liste des matchs</h2>
</div>
<div class="my-4 mx-2 relative lg:flex lg:justify-center">
    <div class="lg:w-9/12">
        @foreach($regions as $region)
        <h2 class="inline-block bg-primary text-secondary px-4 py-2 rounded-md mt-2">{{ $region->name }}</h2>
        @foreach($matches[$region->id] as $match)

        @include('match')
        @endforeach
        @endforeach
    </div>
</div>
@endsection