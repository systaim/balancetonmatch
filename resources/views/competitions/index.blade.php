@extends('layout')
@section('content')


@foreach ($competitions as $competition)
    <h2>{{$competition->name}}</h2>
@endforeach

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
            <div class="p-4 md:w-1/3">
                <div class="h-full border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden bg-primary">
                    <img class="lg:h-48 md:h-36 w-full object-cover object-center" src="{{ asset('images/championnat-region.jpg') }}"
                        alt="blog">
                    <div class="p-6">
                        <h1 class="title-font text-lg font-medium mb-3">CHAMPIONNAT RÉGIONAL</h1>
                        <p class="leading-relaxed mb-3">Début championnat le 12/09/2021 pour les équipes de R1, R2, et R3.</p>
                    </div>
                </div>
            </div>
            {{-- <div class="p-4 md:w-1/3">
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





@endsection
