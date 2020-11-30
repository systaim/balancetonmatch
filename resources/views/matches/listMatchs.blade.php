@extends('layout')
@section('content')
<!-- <div class="flex justify-center">
    <a href="{{ route('matches.create') }}">
        <button class="btn btnPrimary">Créer un match</button>
    </a>
</div> -->
<div class="flex justify-between bg-primary overflow-hidden rounded-lg my-4 lg:w-10/12 m-auto">
    <div class="hidden lg:block lg:w-6/12 img-bg-blend">
    </div>
    <div class="text-white p-4 lg:w-6/12 xl:p-10 m-auto">
        <h3 class="text-xs">Envie de de commenter ou de suivre un match ?</h3>
        <h2 class="text-2xl">C'est très facile !</h2>
        <p class="py-4">Si tu ne trouves pas ton match, n'hésite pas à le créer.<br>
            Le match pourra être commenter en <span class="uppercase text-primary font-bold bg-secondary px-2 rounded-full">live</span> le jour J.
        </p>
        <a class="flex justify-end" href="{{ route('matches.create') }}">
            <button class="btn">Je crée un match</button>
        </a>
    </div>
</div>
<h2 class="titlePage">Liste des matchs</h2>
<div class="my-4 mx-2 relative lg:flex lg:justify-center">
    <div class="lg:w-9/12">
        @foreach($matches as $match)
        @include('match')
        @endforeach
    </div>
</div>
@endsection