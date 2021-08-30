@extends('layout')
@section('content')
    <!-- <div class="flex justify-center">
            <a href="{{ route('matches.create') }}">
                <button class="btn btnPrimary">Créer un match</button>
            </a>
        </div> -->
    <section class="body-font">
        <div class="container px-5 py-24 mx-auto text-white">
            <div class="flex flex-wrap -m-4 justify-center">
                <div class="p-4 md:w-1/3">
                    <a href="matches/coupe-de-france-2021-2022">
                        <div
                            class="h-full border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden bg-primary shadow-2xl">
                            <img class="lg:h-48 md:h-36 w-full object-cover object-center"
                                src="{{ asset('images/Coupe-de-france.jpg') }}" alt="Coupe de France">
                            <div class="p-6">
                                <h1 class="title-font text-lg font-medium mb-3">COUPE DE FRANCE 2021</h1>
                                <p class="leading-relaxed mb-3">Début de la compétition le 29/08/2021 avec le 1er tour qui
                                    accueille les équipes de D4 à R3</p>
                            </div>
                        </div>
                    </a>
                </div>
                {{-- <div class="p-4 md:w-1/3">
                    <div class="h-full border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden bg-primary">
                        <img class="lg:h-48 md:h-36 w-full object-cover object-center" src="{{ asset('images/Coupe-de-france.jpg') }}"
                            alt="blog">
                        <div class="p-6">
                            <h1 class="title-font text-lg font-medium mb-3">CHAMPIONNAT DE DISTRICT</h1>
                            <p class="leading-relaxed mb-3">Début de la compétition le 29/08/2021 avec le 1er tour qui accueille les équipes de D4 à R3</p>
                        </div>
                    </div>
                </div>
                <div class="p-4 md:w-1/3">
                    <div class="h-full border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden bg-primary">
                        <img class="lg:h-48 md:h-36 w-full object-cover object-center" src="{{ asset('images/Coupe-de-france.jpg') }}"
                            alt="blog">
                        <div class="p-6">
                            <h1 class="title-font text-lg font-medium mb-3">COUPE DE FRANCE 2021</h1>
                            <p class="leading-relaxed mb-3">Début de la compétition le 29/08/2021 avec le 1er tour qui accueille les équipes de D4 à R3</p>
                        </div>
                    </div>
                </div> --}}
                <div class="p-4 md:w-1/3">
                    <a href="matches/amicaux-2021-2022">
                        <div
                            class="h-full border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden bg-primary shadow-2xl">
                            <img class="lg:h-48 md:h-36 w-full object-cover object-center"
                                src="{{ asset('images/amicaux.jpg') }}" alt="Coupe de France">
                            <div class="p-6">
                                <h1 class="title-font text-lg font-medium mb-3">Matchs amicaux</h1>
                                <p class="leading-relaxed mb-3">Matchs de préparation pour la saison 2021-2022</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
    {{-- <section>
    <div class="flex flex-col lg:flex-row justify-between bg-primary rounded-lg my-4 sm:w-11/12 m-auto overflow-hidden">
        <div class="h-48 lg:h-auto lg:w-6/12 img-bg-blend-listMatchs">
        </div>
        <div class="text-white px-4 m-8 lg:m-20 lg:w-6/12 text-center">
            <h3 class="text-xs">Envie de suivre un match ?</h3>
            <h2 class="text-2xl">C'est très facile !</h2>
            <p class="py-4">Recherche ton équipe et si tu ne trouves pas son match, n'hésite pas à le créer.<br>
                Il pourra être commenté en <span class="uppercase text-primary font-bold bg-secondary px-2 rounded-sm">live</span> le jour J soit par toi soit par un autre spectateur.
            </p>
        </div>
    </div>
    <div class="flex justify-center">
        <h2 class="titlePage">Prochains matchs</h2>
    </div>
    <div class="relative lg:flex lg:justify-center">
        <div class="lg:w-9/12">

            @livewire('search-match')
            
            @foreach ($competitions as $competition)
            <h2 class="text-primary border-b-2 border-primary px-4 py-2 rounded-t-md lg:text-2xl">{{ $competition->name }}</h2>
            @foreach ($matchesByCompet[$competition->id] as $match)
            <div class="rounded-b-md rounded-tr-md">
                @include('match')
            </div>
            @endforeach
            @endforeach
        </div>
    </div>
</section> --}}
@endsection
